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
            $table->id()->index('idx_id');
            $table->foreignId('newsletter_campaign_id')->index('idx_newsletter_campaign_id');
            $table->foreignId('newsletter_subscriber_id')->index('idx_newsletter_subscriber_id');
            $table->string('subscriber_full_name');
            $table->string('subscriber_email_address');
            $table->string('email_status');
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
