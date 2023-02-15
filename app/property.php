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

    public function qrcodesinfo()
    {
        return $this->hasMany(QrcodeInfo::class, 'property_id', 'id');
    }

    public function customWebsites()
    {
        return $this->hasMany(CustomWeb::class, 'property_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(order::class, 'property_id', 'id');
    }

    public function propertyRoomInfo()
    {
        return $this->hasMany(PropertyRoomInfo::class, 'property_id', 'id');
    }

    protected $fillable = [
        'title', 'des', 'location','user_id','image','floors','defaultProperty','qrcodeLink2'
    ];
}
