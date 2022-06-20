<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePageSectionTestimonialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_section_testimonials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_section_id')->index('idx_page_section_id');
            $table->string('name')->nullable(false);
            $table->string('occupation')->nullable(false);
            $table->longText('description')->nullable(false);
            $table->timestamps();
        });

        DB::unprepared(
            'ALTER TABLE `page_section_testimonials` 
            ADD CONSTRAINT `fk_page_section_testimonials_id`
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
        Schema::dropIfExists('page_section_testimonials');
    }
}
