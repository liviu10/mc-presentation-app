<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // TODO: Can add reminders directly from the web application
        Schema::create('events', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->string('event_name');
            $table->longText('event_description');
            $table->timestamp('event_start_at')->nullable();
            $table->timestamp('event_end_at')->nullable();
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
        Schema::dropIfExists('events');
    }
}
