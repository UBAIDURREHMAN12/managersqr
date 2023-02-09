<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyQuestion extends Model
{
    public $table = 'survey_questions';
    protected $fillable = ['u_id','question'];
}
