<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempData extends Model
{
    public $table = 'temporary_data';
    protected $fillable = ['email','code'];
}
