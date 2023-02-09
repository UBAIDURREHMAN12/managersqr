<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomWebTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_web', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('company_name_or_title');
            $table->string('title')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('qr_id')->references('id')->on('qrocde_info')->onUpdate('cascade')->onDelete('cascade');
            $table->string('logo')->nullable();
            $table->string('bg_color')->nullable();
            $table->string('btn_txt_color')->nullable();
            $table->string('header_color')->nullable();
            $table->string('heading_color')->nullable();

            $table->string('footer_bgcolor')->nullable();
            $table->string('footer_txt_color')->nullable();
            $table->string('fb_link')->nullable();
            $table->string('insta_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('home')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_web');
    }
}
