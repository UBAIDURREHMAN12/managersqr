<?php

namespace App;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Vendor extends Authenticatable
{
    use Notifiable;

     protected $guard="vendor";
     protected $table="vendors";

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    protected $fillable = [
        'name', 'email', 'address','category','user_id','report_id','vendor_id','password'
    ];

}
