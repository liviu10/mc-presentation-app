<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMcPageSectionFooterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mc_page_section_footer', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->foreignId('mc_page_section_id')->index('idx_mc_page_section_id');
            $table->string('footer_facebook_url')->nullable(false);
            $table->string('footer_instagram_url')->nullable(false);
            $table->string('footer_youtube_url')->nullable(false);
            $table->timestamps();
        });

        DB::unprepared(
            'ALTER TABLE `mc_presentation_app_db`.`mc_page_section_footer` 
            ADD CONSTRAINT `fk_mc_page_section_id`
                FOREIGN KEY (`mc_page_section_id`)
                REFERENCES `mc_presentation_app_db`.`mc_page_sections` (`id`)
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
        Schema::dropIfExists('mc_page_section_footer');
    }
}
