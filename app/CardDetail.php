<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardDetail extends Model
{
    protected  $table='card_details';

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
