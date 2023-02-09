<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beacon extends Model
{
    protected $table = 'beacons';

    protected $fillable = ['mac_address', 'gateway_id', 'user_id', 'organization', 'title', 'tagline', 'description', 'distance', 'image'];

    public function gateways()
    {
        return $this->belongsTo(Gateway::class, 'gateway_id', 'id');
    }

}