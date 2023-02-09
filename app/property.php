<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class property extends Model
{
    protected $fillable = [
        'title', 'des', 'location','user_id','image','floors','defaultProperty','qrcodeLink2'
    ];
}
