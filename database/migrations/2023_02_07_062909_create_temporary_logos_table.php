<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemporaryLogosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // this migration is for storing temporary logo images for qr codes and properties at their creation time
        // when a user click on "Attach Selected logo" button from create qr code form (page) page url (http://managersqr.managershq.com.au/createQrcode)
        // after click on apply button we take logo from here (this table) and attach with new qr code which is being created.
        // after attaching this logo image to qrcode we no more need this record for further use, that's way we called this is
        // temporary logos table
        Schema::create('temporary_logos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('userId')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temporary_logos');
    }
}
