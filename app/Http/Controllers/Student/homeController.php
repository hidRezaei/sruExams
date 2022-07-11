<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;


use App\Models\Elanat;
use App\Models\Student;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;



class homeController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        //dd('hhjj');
    }

    public function getHomeData()
    {
        $compactData = array();
        $elanats = Elanat::all();
        //return view('student.home')->with($compactData);
        return view('student.home',compact('elanats'));
    }

    public function getResultPageData()
    {
        $studentClass = new Student();
        $compactData=array('validExams'=>$studentClass->getValidExams(),'validExamsForKaname'=>$studentClass->getValidExamsForKarname() /*,'questionNumber'=>$studentClass->getQuestionCount(1)  *//*, 'answerPages'=>getAnswerPagesOfQuestion()*/ );
        //$data=array('questionNumber'=>$students, 'instructors'=>$instructors, 'instituitions'=>$instituitions);
        //dd($compactData);
        //return view('admin.student.index', compact($compactData));
        return view('student.result')->with($compactData);
    }

    public function displayImage($lessonNumber,$QN, $filename)
    {
        /*
        //return '***';
        //$dd2=  storage::download('resultFiles/100041/1/' . $filename);
        //dd('22');
        //$path=  storage::get('resultFiles/100041/1/' . $filename);

        $path = 'resultFiles2/' . auth('student')->user()->CandidID . '/' . $QN . '/' . $filename;
        //dd($path);
        if (!File::exists($path)) {

            abort(404);
        }

        $file = File::get($path);

        $type = File::mimeType($path);

        $response = Response::make($file, 200);

        $response->header("Content-Type", $type);
        //dd($response);
        return $response;*/

        $studentClass = new Student();
        return $studentClass->displayImage22($lessonNumber,$QN,$filename);
    }


    public function getKarname($lessonNumber)
    {
        $path = 'resultFiles/1401/M2/20/'. $lessonNumber .'/' . auth('student')->user()->CandidID.'.pdf' ;
        //dd($path);
        if (!storage::exists($path)) {

            abort(404);
        }
        return storage::download($path);
    }



}
