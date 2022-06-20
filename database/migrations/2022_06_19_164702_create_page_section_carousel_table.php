<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePageSectionCarouselTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_section_carousel', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->foreignId('page_section_id')->index('idx_page_section_id');
            $table->string('image_path')->nullable(false);
            $table->string('title')->nullable(false);
            $table->longText('caption_text_1')->nullable();
            $table->longText('caption_text_2')->nullable();
            $table->longText('caption_text_3')->nullable();
            $table->longText('caption_text_4')->nullable();
            $table->longText('button_label')->nullable(false);
            $table->string('link_to_blog_article')->nullable(false);
            $table->timestamps();
        });

        DB::unprepared(
            'ALTER TABLE `page_section_carousel` 
            ADD CONSTRAINT `fk_page_section_carousel_id`
                FOREIGN KEY (`page_section_id`)
                REFERENCES `page_sections` (`id`)
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
        Schema::dropIfExists('page_section_carousel');
    }
}
