<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gateway extends Model
{
    protected $table = 'gateways';

    protected $fillable = ['vendor_id', 'title', 'mac_address', 'organization', 'venue_id', 'venue_name', 'venue_lat', 'venue_long'];

    public function users()
    {
        return $this->belongsTo(User::class, 'vendor_id', 'id');
    }

}