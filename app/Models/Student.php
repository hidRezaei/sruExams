<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = "student";
    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /*protected $fillable = [
        'name',
        'mobile',
        'email',
        'password',
        'role',
    ];*/

    public function Jalali(){
        return '';//verta($this->created_at)->format('Y/m/d');
    }

    public function getValidExams()
    {
        /*$path = storage_path().'\app\resultFiles2\100041\1\1.jpg';
        echo ($path);
        //dd($path);
        if (!File::exists($path)) {
            dd(1);
        }
        else
            dd(2);*/

        $resultArr = array();
        for( $k=1;$k<=18;$k++)
        {
            $path = 'resultFiles/1401/M2/'. $k .'/' . auth('student')->user()->CandidID ;
            if(Storage::exists($path))
                $resultArr[] = $k;
        }
        //dd($resultArr);
        return ($resultArr);
    }

    public function getValidExamsForKarname()
    {
        $resultArr = array();
        for( $k=1;$k<=15;$k++)
        {
            $path = 'resultFiles/1401/M2/20/'. $k .'/' . auth('student')->user()->CandidID .'.pdf';
            if(Storage::exists($path))
                $resultArr[] = $k;
        }
        return ($resultArr);
    }


    public function getQuestionCount($lessonNumber)
    {

        /*$path = storage_path().'\app\resultFiles2\100041\1\1.jpg';
        echo ($path);
        //dd($path);
        if (!File::exists($path)) {
            dd(1);
        }
        else
            dd(2);*/



        $path = 'resultFiles/1401/M2/' .$lessonNumber.'/' . auth('student')->user()->CandidID ;
        //$path = 'resultFiles/100041' ;
        $directories = Storage::Directories($path);
        //dd($directories);
        $resultArr = array();
        foreach ($directories as $directory)
            if($strArr = explode('/',$directory) )
                if(isset($strArr[5]) && !empty($strArr[5]))
                    $resultArr[] = $strArr[5];

        return ($resultArr);
    }

    public function getAnswerPagesOfQuestion($lessonNumber,$QuestionNumber)
    {
        //$lessonNumber=1;$QuestionNumber=2;
        $path = 'resultFiles/1401/M2/'. $lessonNumber .'/' . auth('student')->user()->CandidID .'/'. $QuestionNumber;
        $AnswerPages = Storage::Files($path);
        ////dd($AnswerPages);
        $resultArr = array();
        foreach ($AnswerPages as $Page)
            if($strArr = explode('/',$Page) )
                if(isset($strArr[6]) && !empty($strArr[6]))
                    $resultArr[] = $strArr[6];
        //dd($resultArr);
        return ($resultArr);
    }


    public function displayImage22($lessonNumber,$QN, $filename)
    {
        //return '***';
        //$dd2=  storage::download('resultFiles/100041/1/' . $filename);
        //dd('22');
        //$path=  storage::get('resultFiles/100041/1/' . $filename);

        //$path = storage_path().'\app\resultFiles2\100041\1\1.jpg';
        $path = storage_path().'\app\resultFiles\1401\M2\\'. $lessonNumber .'\\' . auth('student')->user()->CandidID . '/' . $QN . '/' . $filename;
        //dd($path);
        if (!File::exists($path)) {

            abort(404);
        }
        /*else
            dd($path);*/

        $file = File::get($path);

        $type = File::mimeType($path);

        $response = Response::make($file, 200);

        $response->header("Content-Type", $type);
        //dd($response);
        return $response;
    }


}
