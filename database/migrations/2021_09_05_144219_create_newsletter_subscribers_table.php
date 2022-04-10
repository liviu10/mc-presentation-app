<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsletterSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsletter_subscribers', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->foreignId('newsletter_campaign_id')->index('idx_newsletter_campaign_id');
            $table->string('full_name')->nullable(false);
            $table->string('email')->nullable(false)->unique();
            $table->string('privacy_policy', 3);
            $table->string('valid_email', 3);
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
        Schema::dropIfExists('newsletter_subscribers');
    }
}
