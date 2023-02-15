<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedbackImage extends Model
{
    protected  $table='feedbac_images';

    public function users()
    {
        return $this->belongsTo(FeedbackType::class, 'feedback_id', 'id');
    }

}
