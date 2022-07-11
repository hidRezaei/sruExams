<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Message;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class messageController extends Controller
{
    public function index($aID,Request $request)
    {
        /*auth('student')->id()*/
        //dd($studentID);
        //$messages = Message::where('SenderID', '=',$aID)->orWhere('ReceiverID', '=',$aID)->paginate(10);

        //$messages = DB::select('select Messages.*,SenderArr.SenderName from Messages Left Join (Select ID,FName+\' \'+ LName AS SenderName From Students)SenderArr ON SenderArr.ID = SenderID where SenderID = ? Or ReceiverID=? ', [-10001,-10001]);

        //$messages = DB::table('Messages')
        $messages = DB::table('Messages')
            //->leftJoin('Students', 'Students.ID', '=', 'SenderID')
            //->leftJoin('Students AS Rec', 'Rec.ID', '=', 'ReceiverID')
            ->leftJoinSub('(Select ID,FName+\' \'+LName AS Sender  From Students UNION Select -10001 AS ID,N\'مدیر\' AS Sender)','SenderArr', 'SenderArr.ID', '=', 'SenderID')
            ->leftJoinSub('(Select ID,FName+\' \'+LName AS Receiver  From Students UNION Select -10001 AS ID,N\'مدیر\' AS Receiver)','ReceiverArr', 'ReceiverArr.ID', '=', 'ReceiverID')
            ->where('SenderID', '=',$aID)->orWhere('ReceiverID', '=',$aID)
            ->select('Messages.*', 'SenderArr.Sender', 'ReceiverArr.Receiver')
            ->paginate(10);
        //dd($messages);
        //foreach($messages['items'] as $message)

            //$message['created_at'] = verta($this->created_at)->format('H:i  -  Y/m/d ');
        return view('admin.message.index', compact('messages'));
    }

    public function create($studentID)
    {
        //return view('admin.message.create',compact('studentID'));
    }

    public function store(Request $request)
    {
        /*//dd($request);
        $request->validate([
            //'name'=>'required|string|max:255',
            'Message'=> ['required','string','max:3000' ],
            //'Subject2'=> ['integer'],
            //'role'=>'required|max:255'
        ]);

        Message::create([
            'SenderID'=>auth('student')->id() ,
            'ReceiverID'=>-10001,
            'Subject'=>$request->Subject ,
            'Subject2'=>$request->Subject2 ,
            'Message'=>$request->Message,
            'ReplyFor'=>0 ,
            'View'=> false
        ]);

        $request->session()->flash('create');
        return redirect()->route('admin.message.index',auth('student')->id());*/
    }

    public function show($id)
    {
        //
    }

    public function edit($aid,$mid)
    {
        //$message = Message::findOrFail($mid)->where('SenderID', '=',$sid)->orWhere('ReceiverID', '=',$sid);
        //$message = Message::where('SenderID', '=',$sid)->orWhere('ReceiverID', '=',$sid)->findOrFail($mid);
        //$message = Message::findOrFail($mid);

        $examClass = new Exam();
        //$AllSubject = $examClass->ExamLessons();
        $AllSubject = $examClass->ExamLessonsForSubject();
        $tmpSTR = '(Select 0 AS ID,N\'-\' AS Title ';
        foreach($AllSubject AS $key=>$value)
            $tmpSTR .= 'UNION Select '. $key .' AS ID , N\''. $value .' \' AS Title ';
        $tmpSTR .= ')';

        $message = DB::table('Messages')
            ->leftJoinSub('(Select ID,FName+\' \'+LName AS Sender  From Students UNION Select -10001 AS ID,N\'مدیر\' AS Sender)','SenderArr', 'SenderArr.ID', '=', 'SenderID')
            ->leftJoinSub('(Select ID,FName+\' \'+LName AS Receiver  From Students UNION Select -10001 AS ID,N\'مدیر\' AS Receiver)','ReceiverArr', 'ReceiverArr.ID', '=', 'ReceiverID')
            ->leftJoinSub($tmpSTR ,'SubjectArr', 'SubjectArr.ID', '=', 'Subject')
            ->where('Messages.ID', '=',$mid)
            //->where('SenderID', '=',$aid)
            ->where('ReceiverID', '=',$aid)
            ->select('Messages.*', 'SenderArr.Sender', 'ReceiverArr.Receiver','SubjectArr.Title AS Subject')->first();
        //dd($message);
        return view('admin.message.edit', compact('message'));
    }

    public function update(Request $request, $aid,$mid)
    {
        //dd($id);

        $message = Message::findOrFail($mid);
        //dd($request);
        $request->validate([
            //'name'=>'required|string|max:255',
            'Reply'=> ['required','string','max:3000' /*->ignore($user->id)*/],
            //'Subject2'=> ['integer'],
            //'role'=>'required|max:255'
        ]);

        $message->update([
            //'SenderID'=>auth('student')->id() /*$request->SenderID*/ ,
            //'ReceiverID'=>-10001,
            //'Subject'=>$request->Subject ,
            'Reply'=>$request->Reply,
            //'ReplyFor'=>0 ,
            'View'=> true
        ]);

        $request->session()->flash('update');
        return redirect()->route('admin.message.index',$aid);
    }

    public function destroy($sid , $mid)
    {
        $message = Message::findOrFail($mid);
        $message->destroy($mid);
        return redirect()->route('admin.message.index',$sid);
    }
}
