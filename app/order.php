<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected  $table='Orders';

    protected $fillable = ['order','note', 'property_id', 'room_id', 'floor_id', 'qrCode_id', 'active',
        'area', 'user'];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'id');
    }
    public function categories()
    {
        return $this->belongsTo(Category::class, 'order', 'id');
    }
    public function PropertiesRoomInfo()
    {
        return $this->belongsTo(PropertyRoomInfo::class, 'room_id', 'id');
    }
    public function qrCodeInfo()
    {
        return $this->belongsTo(QrcodeInfo::class, 'qrCode_id', 'id');
    }

}
