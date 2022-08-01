<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tashih extends Model
{
    use HasFactory;
    protected $table = 'Tashih';
    protected $guarded = ['id'];
    public $timestamps = false;

}
