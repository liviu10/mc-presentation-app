<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateNewsletterCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsletter_campaigns', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->string('campaign_name')->nullable(false);
            $table->string('campaign_description');
            $table->string('campaign_is_active', 3)->default('0');
            $table->string('valid_from')->nullable(false);
            $table->string('valid_to')->nullable(false);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        DB::unprepared(
            'ALTER TABLE `mc_presentation_app_db`.`newsletter_subscribers`
            ADD CONSTRAINT `fk_newsletter_campaigns_id`
                FOREIGN KEY (`newsletter_campaigns_id`)
                REFERENCES `mc_presentation_app_db`.`newsletter_campaigns` (`id`)
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
        Schema::dropIfExists('newsletter_campaigns');
    }
}
