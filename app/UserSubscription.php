<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    public $table = 'user_subscriptions';

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
