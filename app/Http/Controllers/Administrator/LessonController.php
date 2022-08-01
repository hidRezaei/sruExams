<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index()
    {
        $data = Lesson::paginate(10);
        return view('admin.lesson.index', compact('data'));
    }

    public function create()
    {
        return view('admin.lesson.create');
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

        Lesson::create([
            //'SenderID'=>auth('student')->id() ,
            //'ReceiverID'=>-10001,
            'Title'=>$request->Title ,
            'Code'=>$request->Code ,
            'Description'=>$request->Description ,
        ]);

        $request->session()->flash('create');
        return redirect()->route('lesson.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Lesson::findOrFail($id);
        return view('admin.lesson.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Lesson::findOrFail($id);
        //dd($request);
        $request->validate([
            'Title' => ['required', 'string', 'max:1500'],
        ]);

        $data->update([
            'Title'=>$request->Title ,
            'Code'=>$request->Code ,
            'Description'=>$request->Description ,
        ]);

        $request->session()->flash('update');
        return redirect()->route('lesson.index');
    }

    public function destroy($id)
    {
        $data = Lesson::findOrFail($id);
        $data->destroy($id);
        return redirect()->route('lesson.index');
    }
}
