<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsletterLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsletter_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('newsletter_campaign_id')->index('idx_newsletter_campaign_id');
            $table->string('full_name')->nullable(false);
            $table->string('email')->nullable(false);
            $table->string('status')->nullable(false);
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
        Schema::dropIfExists('newsletter_logs');
    }
}
