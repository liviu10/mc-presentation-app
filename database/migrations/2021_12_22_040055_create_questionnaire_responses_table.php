<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateQuestionnaireResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaire_responses', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->foreignId('questionnaire_answer_id')->index('idx_questionnaire_answer_id');
            $table->string('response_1')->nullable();
            $table->string('response_2')->nullable();
            $table->string('response_3')->nullable();
            $table->string('response_4')->nullable();
            $table->string('response_5')->nullable();
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
        Schema::dropIfExists('questionnaire_responses');
    }
}
