<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedbackSendHistory extends Model
{
    protected  $table='feedback_send_history';

    protected $fillable = ['feedback_id','admin_note', 'receiver_email', 'date'];

    public function users()
    {
        return $this->belongsTo(FeedbackType::class, 'feedback_id', 'id');
    }
}
