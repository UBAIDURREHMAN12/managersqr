<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    public $table = 'version';

    protected $fillable = ['version_no'];


}
