<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            // following u_id is random generated id at answer creation time through php code
            $table->string('u_id');
            // following question_form_iu_d is a  id used in 'survey_questions' table.
            $table->string('question_form_iu_d');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('question_id')->references('id')->on('survey_questions')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('answer');
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
        Schema::dropIfExists('survey_answers');
    }
}
