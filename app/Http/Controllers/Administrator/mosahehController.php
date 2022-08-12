<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Mosaheh;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
class mosahehController extends Controller
{
    public function index(Request $request)
    {
        //$students = Student::all();

        //$students = Student::paginate(10);
        $result = User::where([
            ['Role','=',config('constants.Role.MOSAHEH')],
            [function($query) use ($request){
                if(($term=$request->term)){
                    $query->orWhere('name','LIKE','%'. $term .'%')->get();
                    $query->orWhere('lname','LIKE','%'. $term .'%')->get();
                    $query->orWhere('email','LIKE','%'. $term .'%')->get();
                    $query->orWhere('code','LIKE','%'. $term .'%')->get();
                }
            }]
        ])->orderBy('id','desc')
            ->paginate(10);
        $result->appends(['term' => $request->term]);
        return view('admin.mosaheh.index', compact('result'))
            ->with('i',(request()->input('page',1)-1)*10);
    }

    public function create()
    {
        $result = array();
        $dorehClass = new \App\Models\Doreh();
        $activeDorehInfo = $dorehClass->getActiveDorehStep();

        $result['DorehTitle'] = $activeDorehInfo->DorehTitle;
        $result['StepTitle'] = $activeDorehInfo->StepTitle;

        $lessonClass = new \App\Models\Lesson();
        $result['allLesons'] = $lessonClass->getLessonsOfActiveDorehStep();

        $result['hidQNumbers'] = '';
        $result['LessonData'] = array();
        //dd($result);
        return view('admin.mosaheh.create', compact('result'));
    }

    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            //'name'=>'required|string|max:255',
            'email'=> ['required','string','min:4', Rule::unique('Users') /*->ignore($user->id)*/],
            'password'=>['required','string','min:6', /*->ignore($user->id)*/],
            'code'=>['numeric'],
            //'role'=>'required|max:255'
        ]);

        $userID = Mosaheh::create([
            'name'=>$request->name,
            'lname'=>$request->lname,
            'code'=>$request->code,
            'Role'=> config('constants.Role.MOSAHEH'),
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ])->id;

        if(isset($request->chk_LessonQNAssign) && ($request->chk_LessonQNAssign=='on'))
        {
            $dorehClass = new \App\Models\Doreh();
            $activeDorehInfo = $dorehClass->getActiveDorehStep();
            $did = $activeDorehInfo->DorehID;
            $sid = $activeDorehInfo->StepID ;

            DB::table('MosahehLessonQNumbers')->where('DorehID', $did)
                ->where('StepID', $sid)
                ->where('UserID', $userID)
                ->delete();
            $lessonID = $request->LessonID ;
            if($lessonID != 0)
            {
                if(isset($request->rdoQNType) && ($request->rdoQNType==1))
                    DB::insert('insert into MosahehLessonQNumbers(DorehID, StepID,UserID,LessonID,QNumber) values (?, ?,?,?,?)', [$did,$sid,$userID, $lessonID,config('constants.General.ALL')]);
                else if(isset($request->rdoQNType) && ($request->rdoQNType==2))
                {
                    $StrQNArr = explode('_',$request->hidQNumbers);
                    //dd($StrQNArr);
                    if($StrQNArr && count($StrQNArr)>0)
                        foreach ($StrQNArr as $value)
                            if((((int)$value)-0)>0)
                                DB::insert('insert into MosahehLessonQNumbers(DorehID, StepID,UserID,LessonID,QNumber) values (?, ?,?,?,?)', [$did,$sid,$userID, $lessonID,$value]);

                }
            }
        }

        $request->session()->flash('create');
        return redirect()->route('mosaheh.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $result = User::findOrFail($id);

        $dorehClass = new \App\Models\Doreh();
        $activeDorehInfo = $dorehClass->getActiveDorehStep();
        $did = $activeDorehInfo->DorehID;
        $sid = $activeDorehInfo->StepID ;

        $lessonData = DB::select('select MosahehLessonQNumbers.* from MosahehLessonQNumbers
                                    Where DorehID =? AND StepID=? AND UserID=?',[$did,$sid,$id]);
        $QNStrForHidden = '';
        foreach($lessonData AS $item)
            $QNStrForHidden .= $item->QNumber .'_';

        //$result['LessonID'] = $lessonData[0]['LessonID'];
        $result['DorehTitle'] = $activeDorehInfo->DorehTitle;
        $result['StepTitle'] = $activeDorehInfo->StepTitle;

        $lessonClass = new \App\Models\Lesson();
        $result['allLesons'] = $lessonClass->getLessonsOfActiveDorehStep();

        $result['hidQNumbers'] = $QNStrForHidden;
        $result['LessonData'] = $lessonData;
        return view('admin.mosaheh.edit', compact('result'));
    }

    public function update(Request $request, $id)
    {
        //dd($request);
        $data = Mosaheh::findOrFail($id);
        if($request->password == null)
        {
            $request->validate([
                'email'=> ['required','string','min:4', Rule::unique('Users')->ignore($data->id)],
                'code'=>['numeric'],
                //'password'=>['required','string','min:6'],
            ]);

            $data->update([
                'name'=>$request->name,
                'lname'=>$request->lname,
                'code'=>$request->code,
                //'Role'=> config('constants.Role.MOSAHEH'),
                'email'=>$request->email,
            ]);
        }
        else
        {
            $request->validate([
                'email'=> ['required','string','min:4', Rule::unique('Users')->ignore($data->id)],
                'password'=>['required','string','min:6'],
                'code'=>['numeric'],
            ]);

            $data->update([
                'name'=>$request->name,
                'lname'=>$request->lname,
                'code'=>$request->code,
                //'Role'=> config('constants.Role.MOSAHEH'),
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
            ]);
        }

        if(isset($request->chk_LessonQNAssign) && ($request->chk_LessonQNAssign=='on'))
        {
            $dorehClass = new \App\Models\Doreh();
            $activeDorehInfo = $dorehClass->getActiveDorehStep();
            $did = $activeDorehInfo->DorehID;
            $sid = $activeDorehInfo->StepID ;

            DB::table('MosahehLessonQNumbers')->where('DorehID', $did)
                ->where('StepID', $sid)
                ->where('UserID', $data->id)
                ->delete();
            $lessonID = $request->LessonID ;
            if($lessonID != 0)
            {
                if(isset($request->rdoQNType) && ($request->rdoQNType==1))
                    DB::insert('insert into MosahehLessonQNumbers(DorehID, StepID,UserID,LessonID,QNumber) values (?, ?,?,?,?)', [$did,$sid,$data->id, $lessonID,config('constants.General.ALL')]);
                else if(isset($request->rdoQNType) && ($request->rdoQNType==2))
                {
                    $StrQNArr = explode('_',$request->hidQNumbers);
                    //dd($StrQNArr);
                    if($StrQNArr && count($StrQNArr)>0)
                        foreach ($StrQNArr as $value)
                            if((((int)$value)-0)>0)
                                DB::insert('insert into MosahehLessonQNumbers(DorehID, StepID,UserID,LessonID,QNumber) values (?, ?,?,?,?)', [$did,$sid,$data->id, $lessonID,$value]);

                }
            }
        }



        $request->session()->flash('update');
        return redirect()->route('mosaheh.index');
    }

    public function destroy($id)
    {
        $data = Mosaheh::findOrFail($id);
        $data->destroy($id);
        return redirect()->route('mosaheh.index');
    }
}
