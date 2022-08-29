<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class Exam extends Model
{
    public function ExamLessons()
    {
        return array(
            1 => 'فیزیک',
            2 =>'سلول های بنیادی و پزشکی بازساختی',
            3 =>'کامپیوتر- روز اول',
            4 =>'کامپیوتر - روز دوم',
            5 =>'ادبی',
            6 =>'شیمی - تستی',
            7 =>'ریاضی - روز اول',
            8 =>'جغرافیا',
            9 =>'زیست شناسی',
            10 =>'ریاضی - روز دوم',
            11 =>'نجوم و اختر فیزیک',
            12 =>'علوم زمین',
            13 =>'اقتصاد و مدیریت',
            14 =>'تفکر و کارآفرینی - تشریحی',
            15 =>'تفکر و کارآفرینی - تستی',
            16 =>'علوم و نانو فناوری - تستی',
            17 =>'علوم و نانو فناوری - تشریحی',
            18 =>'شیمی - تشریحی',
            //14 =>'14',
            //15 =>'15'
        );
    }

    public function ExamLessonsForKarname()
    {
        return array(
            1 => 'فیزیک',
            2 =>'ریاضی',
            3 =>'شیمی',
            4 =>'نجوم و اختر فیزیک',
            5 =>'کامپیوتر',
            6 =>'زیست شناسی',
            7 =>'ادبی',
            8 => 'سلول های بنیادی و پزشکی بازساختی',
            9 =>'جغرافیا',
            10 =>'علوم زمین',
            11 =>'اقتصاد و مدیریت',
            12 =>'تفکر و کارآفرینی',
            13 =>'علوم و نانو فناوری',
            //14 =>'14',
            //15 =>'15'
        );
    }

    public function ExamLessonsForSubject()
    {
        return array(
            1 => 'فیزیک',
            2 =>'سلول های بنیادی و پزشکی بازساختی',
            3 =>'کامپیوتر- روز اول',
            4 =>'کامپیوتر - روز دوم',
            5 =>'ادبی',
            6 =>'شیمی - تستی',
            7 =>'ریاضی',
            8 =>'جغرافیا',
            9 =>'زیست شناسی',
            10 =>'ریاضی',
            11 =>'نجوم و اختر فیزیک',
            12 =>'علوم زمین',
            13 =>'اقتصاد و مدیریت',
            14 =>'تفکر و کارآفرینی - تشریحی',
            15 =>'تفکر و کارآفرینی - تستی',
            16 =>'علوم و نانو فناوری - تستی',
            17 =>'علوم و نانو فناوری - تشریحی',
            18 =>'شیمی - تشریحی',
        );
    }

    public function getExamLessonTitle($lessonNumber)
    {
        $tmpArr = self::ExamLessons();
        return $tmpArr[$lessonNumber];
    }

    public function getExamLessonTitleForkarname($lessonNumber)
    {
        $tmpArr = self::ExamLessonsForKarname();
        return $tmpArr[$lessonNumber];
    }

    public function getMessageSubjectOptions()
    {
        $tmpArr = self::ExamLessonsForSubject();
        $studentclass = new Student();
        $exArr = $studentclass->getValidExams();
        $resultArr = array(0=>'انتخاب کنید');
        foreach($exArr As $ex )
            if($ex == 10 && in_array(7,$exArr))
                continue;
            else
                $resultArr[$ex] = $tmpArr[$ex];
        return($resultArr);
        /*return array_merge(
            array(0 => 'انتخاب کنید'),
            $resultArr /*,
            array(19 => 'پاسخنامه تستی',
                20 => 'کارنامه')*//*
        );*/
    }

    public function getMessageSubjectOptionsForAdmin()
    {
        //$tmpArr = self::ExamLessons();
        $tmpArr = array(
            1 => 'فیزیک',
            2 =>'سلول های بنیادی و پزشکی بازساختی',
            3 =>'کامپیوتر- روز اول',
            4 =>'کامپیوتر - روز دوم',
            5 =>'ادبی',
            6 =>'شیمی - تستی',
            7 =>'ریاضی',
            8 =>'جغرافیا',
            9 =>'زیست شناسی',
            10 =>'ریاضی',
            11 =>'نجوم و اختر فیزیک',
            12 =>'علوم زمین',
            13 =>'اقتصاد و مدیریت',
            14 =>'تفکر و کارآفرینی - تشریحی',
            15 =>'تفکر و کارآفرینی - تستی',
            16 =>'علوم و نانو فناوری - تستی',
            17 =>'علوم و نانو فناوری - تشریحی',
            18 =>'شیمی - تشریحی',
        );

        return array_merge(
            array(0 => 'انتخاب کنید'),
            $tmpArr /*,
            array(19 => 'پاسخنامه تستی',
                20 => 'کارنامه')*/
        );
    }

    /*public function RoleFarsi(){
        if($this->role === 'user') return 'کاربر عادی';
        if($this->role === 'author') return 'نویسنده';
        if($this->role === 'admin') return 'مدیر سایت';
    }*/

    /*public function Jalali(){
        return verta($this->created_at)->format('Y/m/d');
    }*/



    public function displayExamQAnswer($did,$sid,$stCode,$lessonNumber,$QN)
    {
        $path = 'resultFiles/'. $did .'/'. $sid .'/'. $lessonNumber .'/' . $stCode .'/'. $QN ;
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

    public function getAnswerPageCount($did,$sid,$stCode,$lessonNumber,$QN)
    {
        $path = 'resultFiles/'. $did .'/M'. $sid .'/'. $lessonNumber .'/' . $stCode .'/'. $QN ;
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

    public function displayExamPageImage($did,$sid,$stCode,$lessonNumber,$QN, $filename)
    {
        //$path = storage_path().'\app\resultFiles2\100041\1\1.jpg';
        $path = storage_path().'\app\resultFiles\\'. $did .'\M'. $sid.'\\'. $lessonNumber .'\\' . $stCode . '/' . $QN . '/' . $filename;
        //$path = storage_path().'\app\resultFiles\\'. $did .'\M'. $sid.'\\'. $lessonNumber .'\100043/' . $QN . '/' . $filename;
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
