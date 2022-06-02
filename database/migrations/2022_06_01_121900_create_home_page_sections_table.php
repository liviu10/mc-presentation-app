<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateHomePageSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_page_sections', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->foreignId('home_page_id')->index('idx_home_page_id');
            $table->string('section_name');
            $table->string('section_description');
            $table->string('section_slug_name');
            $table->timestamps();
        });

        DB::unprepared(
            'ALTER TABLE `home_page_sections` 
            ADD CONSTRAINT `fk_home_page_id`
                FOREIGN KEY (`home_page_id`)
                REFERENCES `home_page` (`id`)
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
        Schema::dropIfExists('home_page_sections');
    }
}
