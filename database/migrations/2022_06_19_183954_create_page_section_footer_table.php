<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePageSectionFooterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_section_footer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_section_id')->index('idx_page_section_id');
            $table->string('label_for_menu_1')->nullable(false);
            $table->string('link_for_menu_1')->nullable(false);
            $table->string('label_for_menu_2')->nullable(false);
            $table->string('link_for_menu_2')->nullable(false);
            $table->string('contact_email_address')->nullable(false);
            $table->string('label_for_social_media')->nullable(false);
            $table->string('label_for_social_media_1')->nullable(false);
            $table->string('link_to_social_media_1')->nullable(false);
            $table->string('label_for_social_media_2')->nullable(false);
            $table->string('link_to_social_media_2')->nullable(false);
            $table->string('copyright_caption')->nullable(false);
            $table->string('copyright_caption_url')->nullable(false);
            $table->timestamps();
        });

        DB::unprepared(
            'ALTER TABLE `page_section_footer` 
            ADD CONSTRAINT `fk_page_section_footer_id`
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
        Schema::dropIfExists('page_section_footer');
    }
}
