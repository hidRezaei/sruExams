<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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

    public function getQuestionCount()
    {
        $path = 'resultFiles/' . auth('student')->user()->CandidID ;
        $directories = Storage::Directories($path);
        //dd($direcssstories);
        $resultArr = array();
        foreach ($directories as $directory)
            if($strArr = explode('/',$directory) )
                if(isset($strArr[2]) && !empty($strArr[2]))
                    $resultArr[] = $strArr[2];

        return ($resultArr);
    }

    public function getAnswerPagesOfQuestion($QuestionNumber)
    {
        $path = 'resultFiles/' . auth('student')->user()->CandidID .'/'. $QuestionNumber;
        $AnswerPages = Storage::Files($path);
        //dd($AnswerPages);
        $resultArr = array();
        foreach ($AnswerPages as $Page)
            if($strArr = explode('/',$Page) )
                if(isset($strArr[3]) && !empty($strArr[3]))
                    $resultArr[] = $strArr[3];

        return ($resultArr);
    }

}
