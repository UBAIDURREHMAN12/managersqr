<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order')->references('id')
                ->on('categories')->onUpdate('cascade')->onDelete('cascade')->default(null)->nullable();
            $table->text('note')->nullable();
            $table->unsignedBigInteger('property_id')->references('id')->on('properties')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('room_id')->references('id')
                ->on('property_room_info')->onUpdate('cascade')->onDelete('cascade')->default(null)->nullable();
            $table->integer('floor_id')->default(null)->nullable();
            $table->unsignedBigInteger('qrCode_id')->references('id')->on('qrocde_info')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->boolean('active')->default(0)->nullable();
            $table->string('area')->default(null)->nullable();
            $table->string('user')->default(null)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
