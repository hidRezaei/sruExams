<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

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


}
