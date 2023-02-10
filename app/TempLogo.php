<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempLogo extends Model
{
    // this migration is for storing temporary logo images for qr codes and properties at their creation time
    // when a user click on "Attach Selected logo" button from create qr code form (page) page url (http://managersqr.managershq.com.au/createQrcode)
    // after click on apply button we take logo from here (this table) and attach with new qr code which is being created.
    // after attaching this logo image to qrcode we no more need this record for further use, that's way we called this is
    // temporary logos table

    public $table = 'temporary_logos';

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    protected $fillable = ['userId','image'];
}
