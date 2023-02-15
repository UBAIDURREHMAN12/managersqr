<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = 'Notifications';

    public function users()
    {
        return $this->belongsTo(User::class, 'org_id', 'id');
    }
    public function feedbacks()
    {
        return $this->belongsTo(FeedbackType::class, 'feedback_id', 'id');
    }

}
