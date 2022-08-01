<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lesson extends Model
{
    use HasFactory;
    //protected $table = 'Doreh';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function getLessonsOfActiveDorehStep()
    {
        $result = DB::select('select Lessons.*,DorehStepLessons.QCount from Lessons
                                    INNER JOIN DorehStepLessons ON  DorehStepLessons.LessonID = Lessons.ID
                                    INNER JOIN DorehSteps ON (DorehSteps.ID = DorehStepLessons.StepID AND DorehSteps.Status='. config('constants.Status.ACTIVE') .')
                                    INNER JOIN Doreh ON (Doreh.ID = DorehSteps.DorehID AND Doreh.Status = '. config('constants.Status.ACTIVE') .')');
        return $result;
    }


}
