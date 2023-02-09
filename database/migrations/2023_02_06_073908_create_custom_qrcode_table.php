<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomQrcodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_qrcode', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('web_id')->nullable();
            $table->longText('survey_data')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('company_name_or_title');
            $table->boolean('is_plain_text')->default(0);
            $table->boolean('is_address')->default(0);
            $table->longText('property_id')->nullable();
            $table->boolean('is_web')->default(0);
            $table->longText('web_link')->nullable();
            $table->string('title');
            $table->string('qrCodelink')->nullable();
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
        Schema::dropIfExists('custom_qrcode');
    }
}
