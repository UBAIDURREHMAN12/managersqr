<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemporaryDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // this migration is for storing temporary data code and email for email confirmation
        // after user registration we need to confirm the provided email account so we save that code
        // here in this table along with email and once the code confirmed the we remove record from
        // this table because we no more need this record for further use, that's way we called this is
        // temporary data table

        Schema::create('temporary_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            // following code is a code that user receives in email that is provided at registration time
            $table->string('code');
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
        Schema::dropIfExists('temporary_data');
    }
}
