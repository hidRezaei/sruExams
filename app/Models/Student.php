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
        return ($directories);
    }



}
