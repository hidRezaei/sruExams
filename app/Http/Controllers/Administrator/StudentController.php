<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index()
    {
        //$students = Student::all();

        $students = Student::paginate(10);
        /*set_time_limit(360);
        $students = DB::select('select * from students where id >= ? and id < ?',[0,1000]);
        //$students = DB::select('select * from students where password like ?',[Hash::make('123456')]);
        foreach ($students AS $student)
            DB::update('update Students set password = ? where id = ?',[Hash::make($student->NIN),$student->id]);

        dd(  count($students));*/
        return view('admin.student.index', compact('students'));
    }

    public function create()
    {
        return view('admin.student.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            //'name'=>'required|string|max:255',
            'codemeli'=> ['required','string','max:10', Rule::unique('students') /*->ignore($user->id)*/],
            'password'=>['required','string','min:6', Rule::unique('students')/*->ignore($user->id)*/],
            //'role'=>'required|max:255'
        ]);

        Student::create([
            'FName'=>$request->fname,
            'LName'=>$request->lname,
            'FatherName'=>$request->fathername,
            'CodeMeli'=>$request->codemeli,
            'Password'=>Hash::make($request->password),
        ]);

        $request->session()->flash('create');
        return redirect()->route('student.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('admin.student.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        if($request->password == null)
        {
            $request->validate([
                //'name'=>'required|string|max:255',
                'NIN'=> ['required','string','max:10', Rule::unique('students') ->ignore($student->id)],
                'CandidID'=> ['required','string','max:10', Rule::unique('students') ->ignore($student->id)],
                //'password'=>['required','string','min:6', Rule::unique('students')/*->ignore($user->id)*/],
                //'role'=>'required|max:255'
            ]);

            //dd($request);
            $student->update([
                'FName'=>$request->FName,
                'LName'=>$request->LName,
                'FatherName'=>$request->FatherName,
                'NIN'=>$request->NIN,
                'CandidID'=>$request->CandidID,
                'Tel'=>$request->Tel,
                //'Password'=>Hash::make('111111111'),
            ]);
        }
        else
        {
            $request->validate([
                //'name'=>'required|string|max:255',
                'NIN'=> ['required','string','max:10', Rule::unique('students') ->ignore($student->id)],
                'CandidID'=> ['required','string','max:10', Rule::unique('students') ->ignore($student->id)],
                'password'=>['required','string','min:6', Rule::unique('students')/*->ignore($user->id)*/],
                //'role'=>'required|max:255'
            ]);

            $student->update([
                'FName'=>$request->FName,
                'LName'=>$request->LName,
                'FatherName'=>$request->FatherName,
                'NIN'=>$request->NIN,
                'CandidID'=>$request->CandidID,
                'Tel'=>$request->Tel,
                'Password'=>Hash::make($request->password),
            ]);

        }

        $request->session()->flash('update');
        return redirect()->route('student.index');
    }

    public function destroy($id)
    {
        /*$seo = Seo::findOrFail($id);
        $seo->destroy($id);
        return redirect()->route('seo.index');**/
    }
}
