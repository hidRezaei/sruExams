<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\ComiteRaes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class comiteRaesController extends Controller
{
    public function index(Request $request)
    {
        $result = User::where([
            ['Role','=',config('constants.Role.NAZER')],
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
        return view('admin.comiteRaes.index', compact('result'))
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

        $result['LessonData'] = array();
        //dd($result);
        return view('admin.comiteRaes.create', compact('result'));
    }

    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            //'name'=>'required|string|max:255',
            'email'=> ['required','string','min:4', Rule::unique('Users') /*->ignore($user->id)*/],
            'password'=>['required','string','min:6', /*->ignore($user->id)*/],
            'code'=>['numeric'],
        ]);

        $userID = ComiteRaes::create([
            'name'=>$request->name,
            'lname'=>$request->lname,
            'code'=>$request->code,
            'Role'=> config('constants.Role.NAZER'),
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ])->id;

        $dorehClass = new \App\Models\Doreh();
        $activeDorehInfo = $dorehClass->getActiveDorehStep();
        $did = $activeDorehInfo->DorehID;
        $sid = $activeDorehInfo->StepID ;

        DB::table('ComiteRaesLessons')->where('DorehID', $did)
            ->where('StepID', $sid)
            ->where('UserID', $userID)
            ->delete();
        $lessonID = $request->LessonID ;
        if($lessonID != 0)
            DB::insert('insert into ComiteRaesLessons(DorehID, StepID,UserID,LessonID) values (?, ?,?,?)', [$did,$sid,$userID, $lessonID]);

        $request->session()->flash('create');
        return redirect()->route('comiteRaes.index');
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

        $lessonData = DB::select('select * from ComiteRaesLessons Where DorehID =? AND StepID=? AND UserID=?',[$did,$sid,$id]);

        //$result['LessonID'] = $lessonData[0]['LessonID'];
        $result['DorehTitle'] = $activeDorehInfo->DorehTitle;
        $result['StepTitle'] = $activeDorehInfo->StepTitle;

        $lessonClass = new \App\Models\Lesson();
        $result['allLesons'] = $lessonClass->getLessonsOfActiveDorehStep();

        $result['LessonID'] = $lessonData[0]->LessonID;
        return view('admin.comiteRaes.edit', compact('result'));
    }

    public function update(Request $request, $id)
    {
        //dd($request);
        $data = ComiteRaes::findOrFail($id);
        if($request->password == null)
        {
            $request->validate([
                'email'=> ['required','string','min:4', Rule::unique('Users')->ignore($data->id)],
                'code'=>['numeric'],
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

        $dorehClass = new \App\Models\Doreh();
        $activeDorehInfo = $dorehClass->getActiveDorehStep();
        $did = $activeDorehInfo->DorehID;
        $sid = $activeDorehInfo->StepID ;

        DB::table('ComiteRaesLessons')->where('DorehID', $did)->where('StepID', $sid)->where('UserID', $data->id)->delete();
        $lessonID = $request->LessonID ;
        if($lessonID != 0)
            DB::insert('insert into ComiteRaesLessons(DorehID, StepID,UserID,LessonID) values (?, ?,?,?)', [$did,$sid,$data->id, $lessonID]);

        $request->session()->flash('update');
        return redirect()->route('comiteRaes.index');
    }

    public function destroy($id)
    {
        $data = ComiteRaes::findOrFail($id);
        $data->destroy($id);
        return redirect()->route('comiteRaes.index');
    }
}
