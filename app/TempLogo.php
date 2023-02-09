<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempLogo extends Model
{
    public $table = 'temporary_logos';
    protected $fillable = ['userId','image'];
}
