<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QrcodeInfo extends Model
{
    protected $table = 'qrocde_info';

    protected  $fillable=['property_id','floor_no', 'room_no', 'area'];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'id');
    }

    public function customWebsites()
    {
        return $this->hasMany(CustomWeb::class, 'qr_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'qrCode_id', 'id');
    }

}
