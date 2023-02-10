<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorCategory extends Model
{
    public $table = 'vendor_categories';

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
