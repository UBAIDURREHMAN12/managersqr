<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyRoomInfo extends Model
{
    public $table = 'property_room_info';

    protected $fillable = ['rooms', 'prefix', 'floorNo', 'property_id' ];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'id');
    }

}
