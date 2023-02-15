<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QrProperty extends Model
{
    protected $table = 'qr_property';

    protected  $fillable=['name','floors'];



}
