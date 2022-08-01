<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DorehStep extends Model
{
    use HasFactory;
    protected $table = 'DorehSteps';
    protected $guarded = ['id'];
    public $timestamps = false;

}
