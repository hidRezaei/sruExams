<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    public function ExamLessons()
    {
        return array(
            1 => 'فیزیک',
            2 => 'سلول های بنیادی و پزشکی بازساختی',
            3 =>'کامپیوتر روز اول',
            4 =>'کامپیوتر روز دوم',
            5 =>'ادبی',
            6 =>'شیمی - تستی',
            7 =>'ریاضی روز اول',
            8 =>'جغرافیا',
            9 =>'زیست شناسی',
            10 =>'ریاضی روز دوم',
            11 =>'نجوم و اختر فیزیک',
            12 =>'علوم زمین',
            13 =>'اقتصاد و مدیریت',
            14 =>'تفکر و کارآفرینی - تشریحی',
            15 =>'تفکر و کارآفرینی - تستی',
            16 =>'علوم و نانو فناوری - تستی',
            17 =>'علوم و نانو فناوری - تشریحی',
            18 =>'شیمی - تشریحی'
        );
    }

    public function getExamLessonTitle($lessonNumber)
    {
        $tmpArr = self::ExamLessons();
        return $tmpArr[$lessonNumber];
    }

    public function getMessageSubjectOptions()
    {
        $tmpArr = self::ExamLessons();
        $studentclass = new Student();
        $exArr = $studentclass->getValidExams();
        $resultArr = array();
        foreach($exArr As $ex )
            $resultArr[] = $tmpArr[$ex];
        return array_merge(
            array(0 => 'انتخاب کنید'),
            $resultArr,
            array(19 => 'پاسخنامه تستی',
                20 => 'کارنامه'));
    }

    /*public function RoleFarsi(){
        if($this->role === 'user') return 'کاربر عادی';
        if($this->role === 'author') return 'نویسنده';
        if($this->role === 'admin') return 'مدیر سایت';
    }*/

    /*public function Jalali(){
        return verta($this->created_at)->format('Y/m/d');
    }*/

}
