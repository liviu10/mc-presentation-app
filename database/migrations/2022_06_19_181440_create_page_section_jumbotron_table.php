<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePageSectionJumbotronTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_section_jumbotron', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->foreignId('page_section_id')->index('idx_page_section_id');
            $table->longText('description')->nullable(false);
            $table->string('button_label')->nullable(false);
            $table->string('button_url')->nullable(false);
            $table->string('label_for_social_media_1')->nullable(false);
            $table->string('link_to_social_media_1')->nullable(false);
            $table->string('label_for_social_media_2')->nullable(false);
            $table->string('link_to_social_media_2')->nullable(false);
            $table->timestamps();
        });

        DB::unprepared(
            'ALTER TABLE `page_section_jumbotron` 
            ADD CONSTRAINT `fk_page_section_jumbotron_id`
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
        Schema::dropIfExists('page_section_jumbotron');
    }
}
