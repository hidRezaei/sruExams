<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class profileController extends Controller
{
    public function getStudentData($id)
    {
        $student = Student::findOrFail($id);
        return view('student.profile', compact('student'));
    }

    public function updateStudentProfile(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        if($request->password == null)
        {
            $request->validate([
                //'name'=>'required|string|max:255',
                //'NIN'=> ['required','string','max:10', Rule::unique('students') ->ignore($student->id)],
                //'password'=>['required','string','min:6', Rule::unique('students')/*->ignore($user->id)*/],
                //'role'=>'required|max:255'
            ]);

            //dd($request);
            /*$student->update([
                'FName'=>$request->FName,
                'LName'=>$request->LName,
                'FatherName'=>$request->FatherName,
                //'NIN'=>$request->CodeMeli,
                //'Password'=>Hash::make('111111111'),
            ]);*/
        }
        else
        {
            $request->validate([
                //'name'=>'required|string|max:255',
                //'NIN'=> ['required','string','max:10', Rule::unique('students') ->ignore($student->id)],
                'password'=>['required','string','min:6', Rule::unique('students')/*->ignore($user->id)*/],
                //'role'=>'required|max:255'
            ]);

            $student->update([
                /*'FName'=>$request->FName,
                'LName'=>$request->LName,
                'FatherName'=>$request->FatherName,
                //'NIN'=>$request->CodeMeli,*/
                'Password'=>Hash::make($request->password),
            ]);

        }

        //$request->session()->flash('update');
        return redirect()->route('student.profile',$id);
    }

}
