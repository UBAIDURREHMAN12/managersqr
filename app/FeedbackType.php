<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedbackType extends Model
{
    protected  $table='feedback_type';

    protected $fillable = ['feedback', 'user_id', 'password'];


    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function sendFeedbackHistory()
    {
        return $this->hasMany(FeedbackSendHistory::class, 'feedback_id', 'id');
    }

    public function feedbackImages()
    {
        return $this->hasMany(FeedbackImage::class, 'feedback_id', 'id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'feedback_id', 'id');
    }
}
