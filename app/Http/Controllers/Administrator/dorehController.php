<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Doreh;
use App\Models\DorehStep;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dorehController extends Controller
{
    public function index()
    {
        $doreha = Doreh::paginate(10);
        return view('admin.doreh.index', compact('doreha'));
    }

    public function create()
    {
        return view('admin.doreh.create');
    }

    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            //'name'=>'required|string|max:255',
            'Title'=> ['required','string','max:1500' ],
            //'Subject2'=> ['integer'],
            //'role'=>'required|max:255'
        ]);

        $status = 0;
        if($request->Status == "on")
        {
            $status = 1;
            Doreh::where('id','!=',0)->update(['Status' => 0]);
        }

        Doreh::create([
            //'SenderID'=>auth('student')->id() ,
            //'ReceiverID'=>-10001,
            'Title'=>$request->Title ,
            'Description'=>$request->Description ,
            'Status'=>$status,
        ]);

        $request->session()->flash('create');
        return redirect()->route('doreh.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $doreh = Doreh::findOrFail($id);
        return view('admin.doreh.edit', compact('doreh'));
    }

    public function update(Request $request, $id)
    {
        $elanat = Doreh::findOrFail($id);
        //dd($request);
        $request->validate([
            //'name'=>'required|string|max:255',
            'Title' => ['required', 'string', 'max:1500'],
            //'Subject2'=> ['integer'],
            //'role'=>'required|max:255'
        ]);
        $status = 0;
        if ($request->Status == "on")
        {
            $status = 1;
            Doreh::where('id','!=',0)->update(['Status' => 0]);
        }

        $elanat->update([
            //'SenderID'=>auth('student')->id() /*$request->SenderID*/ ,
            'Title'=>$request->Title ,
            'Description'=>$request->Description ,
            'Status'=>$status
        ]);

        $request->session()->flash('update');
        return redirect()->route('doreh.index',$id);
    }

    public function destroy($id)
    {
        $doreh = Doreh::findOrFail($id);
        $doreh->destroy($id);
        return redirect()->route('doreh.index');
    }
    //------------------------------------------------------------------
    public function getdorehSteps($did)
    {
        $steps = DorehStep::where('DorehID', '=',$did)->get();
        //dd($did);
        return view('admin.doreh.dorehSteps', compact('steps'));
    }

    public function dorehStepStore(Request $request)
    {
        //dd($request);
        $request->validate([
            'Title'=> ['required','string','max:1500' ],
            'DorehID'=> ['required','numeric','min:0','not_in:0' ],
        ]);

        $status = 0;
        if($request->Status == "on") {
            $status = 1;

           DorehStep::where('DorehID', $request->DorehID)
                ->update(['Status' => 0]);
        }
        DorehStep::create([
            'DorehID'=>$request->DorehID,
            'Title'=>$request->Title ,
            'Description'=>$request->Description ,
            'Status'=>$status,
        ]);

        $request->session()->flash('create');
        return redirect()->back(); //->route('doreh.index');
    }

    public function dorehStepDestroy($id)
    {
        $doreh = DorehStep::findOrFail($id);
        $doreh->destroy($id);
        return redirect()->back();
    }
    //---------------------------------------------------------------
    public function getDorehStepLessons($did,$sid)
    {
        //$data = Lesson::where('DorehID', '=',$did)->get();
        //$data = Lesson::all();
        $data = DB::select('select Lessons.id,Lessons.Title,DorehStepLessons.LessonID,DorehStepLessons.QCount from Lessons  LEFT JOIN DorehStepLessons ON (Lessons.ID =DorehStepLessons.LessonID AND DorehID = ? and StepID = ?)  ', [$did,$sid]);
        //dd($data);
        return view('admin.doreh.dorehStepLessons', compact('data'));
    }

    public function dorehStepLessonsStore(Request $request,$did,$sid)
    {
        //dd($request);
        DB::table('DorehStepLessons')->where('DorehID', $did)->where('StepID', $sid)->delete();

        foreach ($request->Status as $key=>$value)
            if($value=='on')
               DB::insert('insert into DorehStepLessons (DorehID, StepID,LessonID,QCount) values (?, ?,?,?)', [$did,$sid,$key, $request->QCount[$key]]);
            //echo $key.'*'.$value.'***'. $request->QCount[$key] .'<br/>';

        $request->session()->flash('create');
        return redirect()->back(); //->route('doreh.index');*/
    }

}
