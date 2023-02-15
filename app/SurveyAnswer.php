<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyAnswer extends Model
{
    public $table = 'survey_answers';
    protected $fillable = ['u_id','question_form_iu_d','question_id','answer'];

    public function questions()
    {
        return $this->belongsTo(SurveyQuestion::class, 'question_id', 'id');
    }

}
