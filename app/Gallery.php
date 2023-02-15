<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     public $table = 'gallery';
     protected $fillable = [
        'web_id',
        'image'
     ];

    public function customWeb()
    {
        return $this->belongsTo(CustomWeb::class, 'web_id', 'id');
    }

   protected $hidden = [
         'created_at', 'updated_at'
    ];


}
