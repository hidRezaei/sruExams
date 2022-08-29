<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Doreh extends Model
{
    use HasFactory;
    protected $table = 'Doreh';
    protected $guarded = ['id'];
    public $timestamps = false;

    public $dorehID = 0;

    public function Doreh($dID= 0)
    {
        $this->dorehID = $dID;
    }

    public function getActiveDoreh()
    {
        $result = DB::select('select TOP(1)* from Doreh where Status = 1');
        return $result[0];
    }

    public function getActiveStep($dorehID)
    {
        $result = DB::select('select TOP(1)* from DorehSteps where DorehID=? AND Status = 1',[$dorehID]);
        return $result[0];
    }

    public function getActiveDorehStep()
    {
        if($result = DB::select('select DorehID,Doreh.Title AS DorehTitle,DorehSteps.ID As StepID,DorehSteps.Title AS StepTitle,AnswerView,ResultView from Doreh INNER JOIN DorehSteps ON (Doreh.ID = DorehSteps.DorehID AND DorehSteps.Status=1) where Doreh.Status = 1'))
            return $result[0];

        return array();
    }
    //-----------------------------------
    public function getAllDorehStep()
    {
        if($result = DB::select('select DorehID,Doreh.Title AS DorehTitle,DorehSteps.ID As StepID,DorehSteps.Title AS StepTitle,Doreh.Status AS dorehStatus,DorehSteps.Status AS stepStatus,AnswerView,ResultView from Doreh INNER JOIN DorehSteps ON (Doreh.ID = DorehSteps.DorehID)'))
            return $result;

        return array();
    }

}
