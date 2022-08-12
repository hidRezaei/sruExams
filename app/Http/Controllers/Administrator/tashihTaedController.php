<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class tashihTaedController extends Controller
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

        $data = DB::select('select Distinct Students.id As StudentID,Students.FName+\' \'+Students.LName AS StName,Students.CandidID AS StCode,Tashih.LessonID,Lessons.Title,Tashih.QNumber from Tashih
                                  inner join users on users.id = Tashih.MosahehID
                                  inner join Students on Students.id = Tashih.StudentID
                                  inner join Lessons on Lessons.id = Tashih.LessonID
                                  where
                                    Tashih.DorehID = ?
                                    and Tashih.StepID = ?
                                    and EXISTS(Select * From ComiteRaesLessons Where ComiteRaesLessons.DorehID = Tashih.DorehID AND ComiteRaesLessons.StepID = Tashih.StepID AND ComiteRaesLessons.LessonID = Tashih.LessonID AND ComiteRaesLessons.UserID=?) '. $searchSTR .' Order By Students.id,QNumber ', [$did,$sid,auth()->id()]);

        $data = $this->arrayPaginator($data, $request);

        return view('admin.tashihTaed.index')->with('data', $data);

    }

    public function arrayPaginator($array, $request)
    {
        $page = $request->input('page',1);
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;

        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);
    }

    public function edit($stid,$lid,$qid)
    {
        //$data = Student::findOrFail($id);

        $dorehClass = new \App\Models\Doreh();
        $activeDorehInfo = $dorehClass->getActiveDorehStep();
        $did = $activeDorehInfo->DorehID;
        $sid = $activeDorehInfo->StepID ;

        $markData = DB::select('select Tashih.id,Students.id AS StudentID,Students.CandidID,Students.FName+\' \'+Students.LName+N\' - کد \'+ CAST(Students.CandidID AS NVARCHAR) AS StName,\'-\' AS StCode,Tashih.LessonID,Lessons.Title+N\' - سوال \'+CAST(Tashih.QNumber AS NVARCHAR) AS Title,Tashih.QNumber,
                                    Tashih.DorehID,Tashih.StepID,Tashih.Mark,users.name+\' \'+users.lname AS Name,Tashih.Description,Tashih.created_at,Tashih.updated_at  from Tashih
                                  inner join Students on Students.id = Tashih.StudentID
                                  inner join Lessons on Lessons.id = Tashih.LessonID
                                  INNER JOIN users ON users.ID = Tashih.MosahehID
                                  where
                                    Tashih.DorehID = ?
                                    and Tashih.StepID = ?
                                    and Tashih.StudentID = ?
                                    and Tashih.LessonID = ?
                                    and Tashih.QNumber = ?
                                    and EXISTS(Select * From ComiteRaesLessons Where ComiteRaesLessons.DorehID = Tashih.DorehID AND ComiteRaesLessons.StepID = Tashih.StepID AND ComiteRaesLessons.LessonID = Tashih.LessonID AND ComiteRaesLessons.UserID=?)' , [$did,$sid,$stid,$lid,$qid,auth()->id()]);

        $tashihIDArr = array();
        $marksTanaghoz = false;

        if(count($markData)<2)
            $marksTanaghoz = true;

        foreach($markData AS $item)
        {
            $tashihIDArr[] = $item->id;
            if($item->Mark != $markData[0]->Mark )
                $marksTanaghoz = true;
        }

        $data = $markData[0];
        $data->otherMosahehMark = $markData ;
        $data->marksTanaghoz = $marksTanaghoz;
        $data->TashihIDArr = json_encode($tashihIDArr);
        //-------------------------------------------------

        $data->Status = false;
        $data->TaedDate = '';
        $data->Description='';
        if($oldTashihTaedData = DB::select('select *  from TashihTaed
                                  where TashihID in ('. implode(',',$tashihIDArr) .')
                                    and ComiteRaesID = ?' , [auth()->id() ]))
        {
            $data->Status = $oldTashihTaedData[0]->Status;
            $data->TaedDate = verta($oldTashihTaedData[0]->created_at)->format('H:i  -  Y/m/d ') ;
            $data->Description=$oldTashihTaedData[0]->Description;
        }
        //-------------------------------------------------
        $examClass = new \App\Models\Exam();
        $answerPagesData = $examClass->getAnswerPageCount($activeDorehInfo->DorehTitle,$activeDorehInfo->StepTitle,$data->CandidID,$data->LessonID,$data->QNumber);
        $data->answerPagesData = $answerPagesData;
        //dd($data);
        return view('admin.tashihTaed.edit', compact('data'));
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


    public function store_update(Request $request)
    {
        //dd($request);
        $tashihIDArr = json_decode($request->hidTashihIDArr);
        if($tashihIDArr)
            foreach ($tashihIDArr AS $tashihID)
            {
                DB::table('TashihTaed')->where('TashihID', $tashihID)->where('ComiteRaesID', $request->ComiteRaesID)->delete();
                if($request->Status == "on")
                    DB::insert('insert into TashihTaed (TashihID,ComiteRaesID,Status, Description,created_at) values (?,?,?,?,?)', [$tashihID,$request->ComiteRaesID,true,$request->Description,date('Y-m-d H:i:s')]);
            }
        //------------------------------------------------------
        $request->session()->flash('update');
        return redirect()->route('tashihTaedEdit',['sid'=> $request->StudentID,'lid'=>$request->LessonID ,'qid'=>$request->QNumber]);
    }


}
