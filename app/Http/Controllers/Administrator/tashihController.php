<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Tashih;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class tashihController extends Controller
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
        $searchSTR = ' AND (2>1)';
        if($search)
            $searchSTR .=" AND (MosahehLessonQNumbers.QNumber=". $numSearch .")" ;
            /*$searchSTR .=" AND (Students.NIN LIKE '%". $search ."%'
                                    OR Students.FName LIKE N'%". $search ."%'
                                    OR MosahehLessonQNumbers.QNumber=". $numSearch .")" ;*/

        $data = DB::select('select Students.id As StudentID,Students.FName+\' \'+Students.LName AS StName,DorehStepLessonStudents.Code AS StCode,MosahehLessonQNumbers.LessonID,Lessons.Title,MosahehLessonQNumbers.QNumber from MosahehLessonQNumbers
                                  inner join DorehStepLessonStudents on DorehStepLessonStudents.DorehID = MosahehLessonQNumbers.DorehID
                                    and DorehStepLessonStudents.StepID = MosahehLessonQNumbers.StepID
                                    and DorehStepLessonStudents.LessonID = MosahehLessonQNumbers.LessonID
                                  inner join Students on Students.id = DorehStepLessonStudents.StudentID
                                  inner join Lessons on Lessons.id = MosahehLessonQNumbers.LessonID
                                  where
                                    MosahehLessonQNumbers.DorehID = ?
                                    and MosahehLessonQNumbers.StepID = ?
                                    and MosahehLessonQNumbers.UserID = ? '. $searchSTR , [$did,$sid,auth()->id()]);

        $assignedLessonInfo = array();
        if($data)
        {
            $assignedLessonInfo = DB::select('select * from DorehStepLessons
                                      where
                                        DorehStepLessons.DorehID = ?
                                        and DorehStepLessons.StepID = ?
                                        and DorehStepLessons.LessonID = ? ', [$did,$sid,$data[0]->LessonID]);

            $newData = array();
            foreach($data as $item)
                if($item->QNumber == config('constants.General.ALL'))
                    for($i=1;$i<=$assignedLessonInfo[0]->QCount;$i++)
                    {
                        $newItem = (array)$item;
                        $newItem['QNumber'] = $i;
                        //array_push($data,(object)($newItem));
                        $newData[] = (object)$newItem;
                    }
                else
                    $newData[] = (object)$item;
            $data = $newData;
        }

        //dd($data);

        $data = $this->arrayPaginator($data, $request);

        /*$data = DB::table('MosahehLessonQNumbers')->join('DorehStepLessonStudents',function ($join) {
            $join->on('DorehStepLessonStudents.DorehID', '=', 'MosahehLessonQNumbers.DorehID')
                ->where('DorehStepLessonStudents.StepID', '=', 'MosahehLessonQNumbers.StepID')
                ->where('DorehStepLessonStudents.LessonID', '=', 'MosahehLessonQNumbers.LessonID');
        })
            ->join('Students','Students.id', '=', 'DorehStepLessonStudents.StudentID')
            ->where('MosahehLessonQNumbers.DorehID', '=',$did)
            ->Where('MosahehLessonQNumbers.StepID', '=',$sid)
            ->Where('MosahehLessonQNumbers.UserID', '=',auth()->id())
            ->select('Students.id', 'Students.FName', 'Students.LName')->get();
            //->paginate(10);*/

        //return view('admin.tashih.index', compact('data'));
        return view('admin.tashih.index')->with('data', $data);

    }
    public function arrayPaginator($array, $request)
    {
        $page = $request->input('page',1);
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;

        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($stid,$lid,$qid)
    {
        //$data = Student::findOrFail($id);

        $dorehClass = new \App\Models\Doreh();
        $activeDorehInfo = $dorehClass->getActiveDorehStep();
        $did = $activeDorehInfo->DorehID;
        $sid = $activeDorehInfo->StepID ;

        $data = DB::select('select Students.id AS StudentID,Students.CandidID,Students.FName+\' \'+Students.LName+N\' - کد \'+ CAST(Students.CandidID AS NVARCHAR) AS StName,DorehStepLessonStudents.Code AS StCode,MosahehLessonQNumbers.LessonID,Lessons.Title+N\' - سوال \'+CAST(MosahehLessonQNumbers.QNumber AS NVARCHAR) AS Title,MosahehLessonQNumbers.QNumber,DorehStepLessons.QCount,
                                    MosahehLessonQNumbers.DorehID,MosahehLessonQNumbers.StepID,MosahehLessonQNumbers.UserID AS MosahehID  from MosahehLessonQNumbers
                                  inner join DorehStepLessonStudents on DorehStepLessonStudents.DorehID = MosahehLessonQNumbers.DorehID
                                    and DorehStepLessonStudents.StepID = MosahehLessonQNumbers.StepID
                                    and DorehStepLessonStudents.LessonID = MosahehLessonQNumbers.LessonID
                                  inner join Students on Students.id = DorehStepLessonStudents.StudentID
                                  inner join Lessons on Lessons.id = MosahehLessonQNumbers.LessonID
                                  inner join DorehStepLessons ON (DorehStepLessons.DorehID = MosahehLessonQNumbers.DorehID AND DorehStepLessons.StepID = MosahehLessonQNumbers.StepID AND  DorehStepLessons.LessonID = MosahehLessonQNumbers.LessonID)
                                  where
                                    MosahehLessonQNumbers.DorehID = ?
                                    and MosahehLessonQNumbers.StepID = ?
                                    and MosahehLessonQNumbers.UserID = ?
                                    and Students.id = ?
                                    and MosahehLessonQNumbers.LessonID = ?
                                    and (MosahehLessonQNumbers.QNumber = ? OR MosahehLessonQNumbers.QNumber = ?)' , [$did,$sid,auth()->id(),$stid,$lid,$qid,config('constants.General.ALL')]);
        $data = $data[0];

        if($data->QNumber == config('constants.General.ALL'))
            $data->QNumber = $qid;
        //-------------------------------------------------
        $data->MarkID = -1;
        $data->Description='';
        $data->OldDataID=-1;
        $data->Mark = null;
        $data->taedTashih = false ;
            //dd(auth()->id());
        if($oldTashihData = DB::select('select *  from Tashih
                                  where Tashih.DorehID = ?
                                    and Tashih.StepID = ?
                                    and Tashih.StudentID = ?
                                    and Tashih.LessonID = ?
                                    and Tashih.QNumber = ?
                                    and Tashih.MosahehID=?' , [$did,$sid,$stid,$lid,$qid,auth()->id() ]))
        {
            $data->OldDataID = $oldTashihData[0]->id;
            $data->Mark = $oldTashihData[0]->Mark;
            $data->Description=$oldTashihData[0]->Description;
        }
        //------------------------------------------------
        if($tashihTaedData = DB::select('select *  from TashihTaed where TashihID = ?' , [$data->OldDataID]))
        {
            $data->taedTashih = true;
        }
        //------------------------------------------------
        $data->otherMosahehMark= null;
        //dd(auth()->id());
        if($otherMarkData = DB::select('select users.name+\' \'+lname AS Name,Tashih.Mark,Tashih.Description,Tashih.created_at,Tashih.updated_at  from Tashih
                                 INNER JOIN users ON users.ID = Tashih.MosahehID
                                  where Tashih.DorehID = ?
                                    and Tashih.StepID = ?
                                    and Tashih.StudentID = ?
                                    and Tashih.LessonID = ?
                                    and Tashih.QNumber = ?
                                    and Tashih.MosahehID !=?' , [$did,$sid,$stid,$lid,$qid,auth()->id() ]))
        {
            foreach($otherMarkData AS $key=>$value)
                if(($data->Mark != null) && ($data->Mark != $value->Mark))
                    $otherMarkData[$key]->Tanaghoz = 'تناقض با نمره ثبت شده شما';
                else
                    $otherMarkData[$key]->Tanaghoz = null;


            $data->otherMosahehMark = $otherMarkData ;
        }
        //-------------------------------------------------
        $data->markItems= null;
        $hidSTR = '';
        //dd(auth()->id());
        if($markItems = DB::select('select * from TashihMarkItems  where TashihID = ?' , [$data->OldDataID]))
        {
            $data->markItems = $markItems ;

            foreach($markItems AS $item)
                $hidSTR .= $item->MarkItem .'_';
        }

        $data->hidMarkSection = $hidSTR;
        //------------------------------------------------
        $data->markLogs= null;
        //dd(auth()->id());
        if($markLogs = DB::select('select * from TashihLog  where TashihID = ?' , [$data->OldDataID]))
        {
            $data->markLogs = $markLogs ;
        }
        //------------------------------------------------
        $examClass = new \App\Models\Exam();
        $answerPagesData = $examClass->getAnswerPageCount($activeDorehInfo->DorehTitle,$activeDorehInfo->StepTitle,$data->CandidID,$data->LessonID,$data->QNumber);
        $data->answerPagesData = $answerPagesData;
        //dd($data);
        return view('admin.tashih.edit', compact('data'));
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
        $request->validate([
            'Mark'=> ['required','numeric','min:0'],
        ]);

        $TashihID = 0;
        if($request->OldDataID == -1)
        {
            $TashihID = Tashih::create([
                'DorehID'=>$request->DorehID,
                'StepID'=>$request->StepID,
                'StudentID'=>$request->StudentID,
                'LessonID'=>$request->LessonID,
                'QNumber'=>$request->QNumber,
                'MosahehID'=>$request->MosahehID,
                'Mark'=>$request->Mark ,
                'Description'=>$request->Description ,
            ])->id;
        }
        else
        {
            $tashih = Tashih::findOrFail($request->OldDataID);
            $tashih->update([
                'Mark'=>$request->Mark ,
                'Description'=>$request->Description ,
            ]);

            $TashihID = $request->OldDataID ;
        }
        // insert mark items -----------------------------------------------------
        DB::table('TashihMarkItems')->where('TashihID', $TashihID)->delete();

        $StrArr = explode('_',$request->hidMarkSection);
        //dd($StrArr);
        if($StrArr && count($StrArr)>0)
            foreach ($StrArr as $value)
                if(trim($value))
                    DB::insert('insert into TashihMarkItems(TashihID, MarkItem) values (?, ?)', [$TashihID,$value]);
        // insert log ----------------------------------------------------
        DB::insert('insert into TashihLog (TashihID, Mark,created_at) values (?,?,?)', [$TashihID,$request->Mark,date('Y-m-d H:i:s')]);
        //------------------------------------------------------
        $request->session()->flash('update');
        return redirect()->route('tashihEdit',['sid'=> $request->StudentID,'lid'=>$request->LessonID ,'qid'=>$request->QNumber]);

    }

    public function destroy($id)
    {
        //
    }
}
