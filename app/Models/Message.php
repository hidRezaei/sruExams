<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function SubjectTitle(){
        /*if($this->Subject == 1) return 'سوال یک آزمون';
        if($this->Subject == 2) return 'سوال دو آزمون';
        if($this->Subject == 3) return 'سوال سه آزمون';*/
        return '';
    }

    public function ReceiverTitle(){
        if($this->ReceiverID == -10001)
            return 'مدیر';
        if($this->ReceiverID == auth('student')->id())
            return 'شما';
        return '';
    }

    public function SenderTitle(){
        if($this->SenderID == auth()->id() )
            return 'شما';
        if($this->SenderID == -10001)
            return 'مدیر';
        return '';
    }

    public function Jalali(){
        return verta($this->created_at)->format('H:i  -  Y/m/d ');
    }

}
