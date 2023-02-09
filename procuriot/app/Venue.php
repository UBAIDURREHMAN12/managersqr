<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $table = 'venues';

    protected $fillable = ['vendor_id', 'name', 'description', 'place_name' , 'organization', 'latitude', 'longitude'];

    public function users()
    {
        return $this->belongsTo(User::class, 'vendor_id', 'id');
    }

}