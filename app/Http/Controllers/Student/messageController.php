<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class messageController extends Controller
{
    public function index($studentID)
    {
        /*auth('student')->id()*/
        $messages = Message::where('SenderID', '=',$studentID)->orWhere('ReceiverID', '=',$studentID)->paginate(10);
        return view('student.message.index', compact('messages'));
    }

    public function create($studentID)
    {
        return view('student.message.create',compact('studentID'));
    }

    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            //'name'=>'required|string|max:255',
            'Message'=> ['required','string','max:3000' /*->ignore($user->id)*/],
            //'Subject2'=> ['integer'],
            //'role'=>'required|max:255'
        ]);

        Message::create([
            'SenderID'=>auth('student')->id() /*$request->SenderID*/ ,
            'ReceiverID'=>-10001,
            'Subject'=>$request->Subject ,
            'Subject2'=>$request->Subject2 ,
            'Message'=>$request->Message,
            //'ReplyFor'=>'' ,
            'View'=> false
        ]);

        $request->session()->flash('create');
        return redirect()->route('student.message.index',auth('student')->id());
    }

    public function show($id)
    {
        //
    }

    public function edit($sid,$mid)
    {
        //$message = Message::findOrFail($mid)->where('SenderID', '=',$sid)->orWhere('ReceiverID', '=',$sid);
        //$message = Message::where('SenderID', '=',$sid)->orWhere('ReceiverID', '=',$sid)->findOrFail($mid);
        $message = Message::findOrFail($mid);
        //dd($message);
        return view('student.message.edit', compact('message'));
    }

    public function update(Request $request, $sid,$mid)
    {
        //dd($id);

        $message = Message::findOrFail($mid);
        //dd($request);
        $request->validate([
            //'name'=>'required|string|max:255',
            'Message'=> ['required','string','max:3000' /*->ignore($user->id)*/],
            //'Subject2'=> ['integer'],
            //'role'=>'required|max:255'
        ]);

        $message->update([
            //'SenderID'=>auth('student')->id() /*$request->SenderID*/ ,
            //'ReceiverID'=>-10001,
            'Subject'=>$request->Subject ,
            'Subject2'=>$request->Subject2 ,
            'Message'=>$request->Message,
            //'ReplyFor'=>0 ,
            //'View'=> false
        ]);

        $request->session()->flash('update');
        return redirect()->route('student.message.index',$sid);
    }

    public function destroy($sid , $mid)
    {
        $message = Message::findOrFail($mid);
        $message->destroy($mid);
        return redirect()->route('student.message.index',$sid);
    }
}
