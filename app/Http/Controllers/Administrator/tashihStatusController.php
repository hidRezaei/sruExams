<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class tashihStatusController extends Controller
{
    public function index(Request $request)
    {
        //dd($request->page);
        $dorehClass = new \App\Models\Doreh();
        $activeDorehInfo = $dorehClass->getActiveDorehStep();
        $did = $activeDorehInfo->DorehID;
        $sid = $activeDorehInfo->StepID ;

        $search = $request->input('term','');
        $numSearch = (int)($search);
        $searchSTR = '';
        if($search)
            $searchSTR .=" AND (Students.NIN LIKE N'%". $search ."%' OR Students.FName LIKE N'%". $search ."%'  OR Students.LName LIKE N'%". $search ."%'   OR Students.CandidID=". $numSearch .")" ;
        /*$searchSTR .=" AND (Students.NIN LIKE '%". $search ."%'
                                OR Students.FName LIKE N'%". $search ."%'
                                OR MosahehLessonQNumbers.QNumber=". $numSearch .")" ;*/

        $data = DB::select('select Distinct Students.id As StudentID,Students.FName+\' \'+Students.LName AS StName,Students.CandidID AS StCode,Tashih.LessonID,Lessons.Title,Tashih.QNumber,TashihTaed.Status as TashihTaedStatus from Tashih
                                  inner join users on users.id = Tashih.MosahehID
                                  inner join Students on Students.id = Tashih.StudentID
                                  inner join Lessons on Lessons.id = Tashih.LessonID
                                  left join TashihTaed on TashihTaed.tashihID = Tashih.ID
                                  where
                                    Tashih.DorehID = ?
                                    and Tashih.StepID = ?
                                    and EXISTS(Select * From ComiteRaesLessons Where ComiteRaesLessons.DorehID = Tashih.DorehID AND ComiteRaesLessons.StepID = Tashih.StepID AND ComiteRaesLessons.LessonID = Tashih.LessonID) '. $searchSTR .' Order By Students.id,QNumber ', [$did,$sid]);

        $data = $this->arrayPaginator($data, $request);

        return view('admin.tashihStatus.index')->with('data', $data);

    }
    public function arrayPaginator($array, $request)
    {
        $page = $request->input('page',1);
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;

        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);
    }

    public function view($stid,$lid,$qid)
    {
        //$data = Student::findOrFail($id);

        $dorehClass = new \App\Models\Doreh();
        $activeDorehInfo = $dorehClass->getActiveDorehStep();
        $did = $activeDorehInfo->DorehID;
        $sid = $activeDorehInfo->StepID ;

        $markData = DB::select('select Tashih.id,Students.id AS StudentID,Students.CandidID,Students.FName+\' \'+Students.LName+N\' - کد \'+ CAST(Students.CandidID AS NVARCHAR) AS StName,\'-\' AS StCode,Tashih.LessonID,Lessons.Title+N\' - سوال \'+CAST(Tashih.QNumber AS NVARCHAR) AS Title,Tashih.QNumber,
                                    Tashih.DorehID,Tashih.StepID,TashihTaed.Status,TashihTaed.Description,TashihTaed.created_at  from Tashih
                                  inner join Students on Students.id = Tashih.StudentID
                                  inner join Lessons on Lessons.id = Tashih.LessonID
                                  left join TashihTaed on TashihTaed.TashihID = Tashih.id
                                  where
                                    Tashih.DorehID = ?
                                    and Tashih.StepID = ?
                                    and Tashih.StudentID = ?
                                    and Tashih.LessonID = ?
                                    and Tashih.QNumber = ?' , [$did,$sid,$stid,$lid,$qid]);

        //dd($markData);
        $data = $markData[0];

        $data->TaedDate = verta($markData[0]->created_at)->format('H:i  -  Y/m/d ') ;

        //-------------------------------------------------
        $mosahehMarksData = DB::select('select Tashih.id,Tashih.Mark,users.name+\' \'+users.lname AS Name,Tashih.Description,Tashih.created_at,Tashih.updated_at  from Tashih
                                        INNER JOIN users ON users.ID = Tashih.MosahehID
                                        where
                                            Tashih.DorehID = ?
                                            and Tashih.StepID = ?
                                            and Tashih.StudentID = ?
                                            and Tashih.LessonID = ?
                                            and Tashih.QNumber = ?' , [$did,$sid,$stid,$lid,$qid]);

        $tashihIDArr = array();
        $marksTanaghoz = false;

        if(count($mosahehMarksData)<2)
            $marksTanaghoz = true;

        foreach($mosahehMarksData AS $item)
        {
            $tashihIDArr[] = $item->id;
            if($item->Mark != $mosahehMarksData[0]->Mark )
                $marksTanaghoz = true;

            $data->markLogs[$item->id]= null;
            //dd(auth()->id());
            if($markLogs = DB::select('select * from TashihLog  where TashihID = ?' , [$item->id]))
            {
                $data->markLogs[$item->id] = $markLogs ;
            }
        }

        $data->otherMosahehMark = $mosahehMarksData ;
        $data->marksTanaghoz = $marksTanaghoz;
        $data->TashihIDArr = json_encode($tashihIDArr);
        //-------------------------------------------------
        $examClass = new \App\Models\Exam();
        $answerPagesData = $examClass->getAnswerPageCount($activeDorehInfo->DorehTitle,$activeDorehInfo->StepTitle,$data->CandidID,$data->LessonID,$data->QNumber);
        $data->answerPagesData = $answerPagesData;
        //dd($data);
        return view('admin.tashihStatus.view', compact('data'));
    }

    public function getAnswerImage($stCode,$lid,$QN,$PN)
    {
        $examClass = new Exam();
        $dorehClass = new \App\Models\Doreh();
        $activeDorehInfo = $dorehClass->getActiveDorehStep();
        $did = $activeDorehInfo->DorehTitle;
        $sid = $activeDorehInfo->StepTitle ;
        //dd($activeDorehInfo);

        return $examClass->displayExamPageImage($did,$sid,$stCode,$lid,$QN, $PN);
    }


}
