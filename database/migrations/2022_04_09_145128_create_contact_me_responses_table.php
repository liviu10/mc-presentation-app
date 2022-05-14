<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateContactMeResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_me_responses', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->foreignId('contact_me_id')->index('idx_contact_me_id');
            $table->longText('message_response');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::unprepared(
            'ALTER TABLE `contact_me_responses`
            ADD CONSTRAINT `fk_contact_me_responses`
                FOREIGN KEY (`contact_me_id`)
                REFERENCES `contact_me_responses` (`id`)
                ON DELETE CASCADE
                ON UPDATE CASCADE'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_me_responses');
    }
}
