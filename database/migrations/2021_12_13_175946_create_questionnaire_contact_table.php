<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateQuestionnaireContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaire_contact', function (Blueprint $table) {
            $table->id();
            $table->foreignId('questionnaire_id');
            $table->string('full_name', 255)->nullable(false);
            $table->string('email', 255)->nullable(false);
            $table->string('telephone_number', 255)->nullable(false);
            $table->string('privacy_policy', 3);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questionnaire_contact');
    }
}
