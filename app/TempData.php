<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempData extends Model
{
    // this table is for storing temporary data code and email for email confirmation
    // after user registration we need to confirm the provided email account so we save that code
    // here in this table along with email and once the code confirmed the we remove record from
    // this table because we no more need this record for further use, that's way we called this is
    // temporary data table

    public $table = 'temporary_data';
    protected $fillable = ['email','code'];
}
