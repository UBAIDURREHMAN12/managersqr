<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class property extends Model
{
    public $table = 'properties';

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    protected $fillable = [
        'title', 'des', 'location','user_id','image','floors','defaultProperty','qrcodeLink2'
    ];
}
