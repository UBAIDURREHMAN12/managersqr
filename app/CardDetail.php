<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardDetail extends Model
{
    protected  $table='card_details';

    protected  $fillable=['card_no','month', 'year', 'cvc', 'user_id'];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
