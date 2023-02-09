<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyRoomInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_room_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('rooms')->default(0)->nullable();
            $table->string('prefix')->default(00)->nullable();
            $table->integer('floorNo')->default(0);
            $table->unsignedBigInteger('property_id')->references('id')->on('properties')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('property_room_info');
    }
}
