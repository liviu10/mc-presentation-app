<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateQuestionnaireQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaire_questions', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->foreignId('questionnaire_id')->index('idx_questionnaire_id');
            $table->foreignId('question_type_id')->index('idx_question_type_id');
            $table->string('name');
            $table->string('answer_suggestion');
            $table->foreignId('questionnaire_media_type_id')->index('idx_questionnaire_media_type_id');
            $table->string('media_card_url');
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
        Schema::dropIfExists('questionnaire_questions');
    }
}
