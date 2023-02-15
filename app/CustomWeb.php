<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomWeb extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     public $table = 'custom_web';

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function properties()
    {
        return $this->belongsTo(Property::class, 'property_id', 'id');
    }

    public function qrcodeInfo()
    {
        return $this->belongsTo(QrcodeInfo::class, 'qr_id', 'id');
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'web_id', 'id');
    }

     protected $fillable = [
        'title',
         'user_id',
         'company_name_or_title',
         'property_id',
         'qr_id',
        'logo',
        'bg_color',
        'btn_color',
        'btn_txt_color',
        'header_color',
        'heading_color',
        'footer_bgcolor',
        'footer_txt_color',
        'fb_link',
        'insta_link',
        'twitter_link',
        'home',
        'contact_us',
        'name',
        'email',
        'phone',
        'address',
        'latitude',
        'longitude',
     ];

   protected $hidden = [
         'created_at', 'updated_at'
    ];


}
