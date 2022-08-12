<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComiteRaes extends Model
{
    use HasFactory;
    protected $table = 'Users';
    protected $guarded = ['id'];
    //public $timestamps = false;

}
