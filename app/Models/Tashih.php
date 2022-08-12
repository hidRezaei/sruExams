<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tashih extends Model
{
    use HasFactory;
    protected $table = 'Tashih';
    protected $guarded = ['id'];
    public $timestamps = true;

    public function JalaliCreate(){
        //return '5555';// verta($this->created_at)->format('H:i  -  Y/m/d ');
    }
    public function JalaliUpdate(){
       // return verta($this->updated_at)->format('H:i  -  Y/m/d ');
    }


}
