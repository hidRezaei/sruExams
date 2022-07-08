<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    public function ExamLessons()
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
            $resultArr /*,
            array(19 => 'پاسخنامه تستی',
                20 => 'کارنامه')*/
        );
    }

    public function getMessageSubjectOptionsForAdmin()
    {
        $tmpArr = self::ExamLessons();
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

}
