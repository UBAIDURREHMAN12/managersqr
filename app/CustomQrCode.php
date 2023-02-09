<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomQrCode extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     public $table = 'custom_qrcode';
     protected $fillable = [
        'title','web_id', 'survey_data', 'user_id', 'company_name_or_title', 'property_id',  'is_web', 'web_link','qrCodelink',
     ];

   protected $hidden = [
         'created_at', 'updated_at'
    ];


}
