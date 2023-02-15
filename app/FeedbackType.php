<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedbackType extends Model
{
    protected  $table='feedback_type';

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function sendFeedbackHistory()
    {
        return $this->hasMany(FeedbackSendHistory::class, 'feedback_id', 'id');
    }

}
