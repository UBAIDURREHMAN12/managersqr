<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyQuestion extends Model
{
    public $table = 'survey_questions';
    protected $fillable = ['u_id','question'];

    public function answers()
    {
        return $this->hasMany(SurveyAnswer::class, 'question_id', 'id');
    }

}
