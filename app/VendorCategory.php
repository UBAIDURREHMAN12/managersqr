<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorCategory extends Model
{
    public $table = 'vendor_categories';

    protected $fillable = ['name','user_id'];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
