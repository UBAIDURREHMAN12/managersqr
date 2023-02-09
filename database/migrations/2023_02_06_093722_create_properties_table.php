<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('des');
            $table->text('location');
            $table->string('property_type');
            $table->unsignedBigInteger('user_id');
            $table->string('image')->nullable();
            $table->string('floors')->nullable();
            $table->boolean('defaultProperty')->default(0)->nullable();
            $table->text('formNote')->nullable();
            $table->string('qrcodeLink')->nullable();
            $table->string('qrcodeLink2')->nullable();
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
        Schema::dropIfExists('properties');
    }
}
