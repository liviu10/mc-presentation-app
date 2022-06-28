<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePageSectionContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_section_contact', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_section_id')->index('idx_page_section_id');
            $table->string('title')->nullable(false);
            $table->string('paragraph_1')->nullable(false);
            $table->string('paragraph_2')->nullable(false);
            $table->string('paragraph_3')->nullable(false);
            $table->string('paragraph_4')->nullable(false);
            $table->string('image_url')->nullable(false);
            $table->timestamps();
        });

        DB::unprepared(
            'ALTER TABLE `page_section_contact` 
            ADD CONSTRAINT `fk_page_section_contact_id`
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
        Schema::dropIfExists('page_section_contact');
    }
}
