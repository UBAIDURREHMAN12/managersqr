<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     protected  $fillable=['name','user_id'];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'order', 'id');
    }
}
