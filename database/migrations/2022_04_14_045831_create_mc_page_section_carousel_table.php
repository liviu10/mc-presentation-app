<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMcPageSectionCarouselTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mc_page_section_carousel', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->foreignId('mc_page_section_id')->index('idx_mc_page_section_id');
            $table->string('carouse_picture_url')->nullable(false);
            $table->string('carouse_caption_title')->nullable(false);
            $table->string('carouse_caption_description')->nullable(false);
            $table->string('carouse_article_link')->nullable(false);
            $table->timestamps();
        });

        DB::unprepared(
            'ALTER TABLE `mc_page_section_carousel` 
            ADD CONSTRAINT `fk_mc_page_section_carousel_id`
                FOREIGN KEY (`mc_page_section_id`)
                REFERENCES `mc_page_sections` (`id`)
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
        Schema::dropIfExists('mc_page_section_carousel');
    }
}
