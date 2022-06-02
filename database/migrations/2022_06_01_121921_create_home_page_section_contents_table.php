<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateHomePageSectionContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_page_section_contents', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->foreignId('home_page_section_id')->index('idx_home_page_section_id');
            $table->string('content_1')->nullable();
            $table->string('content_2')->nullable();
            $table->string('content_3')->nullable();
            $table->string('content_4')->nullable();
            $table->string('media_path')->nullable();
            $table->string('blog_article_path')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->timestamps();
        });

        DB::unprepared(
            'ALTER TABLE `home_page_section_contents` 
            ADD CONSTRAINT `fk_home_page_section_id`
                FOREIGN KEY (`home_page_section_id`)
                REFERENCES `home_page_sections` (`id`)
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
        Schema::dropIfExists('home_page_section_contents');
    }
}
