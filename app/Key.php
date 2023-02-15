<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Key extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = 'keys';
    protected $fillable = ['key'];

    public function customWeb()
    {
        return $this->belongsTo(CustomWeb::class, 'web_id', 'id');
    }

    protected $hidden = [
        'created_at', 'updated_at'
    ];


}
