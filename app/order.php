<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected  $table='Orders';

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'id');
    }

}
