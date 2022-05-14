<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMcPageSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mc_page_sections', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->foreignId('mc_page_id')->index('idx_mc_page_id');
            $table->string('section_name');
            $table->timestamps();
        });

        DB::unprepared(
            'ALTER TABLE `mc_page_sections` 
            ADD CONSTRAINT `fk_mc_page_sections_id`
                FOREIGN KEY (`mc_page_id`)
                REFERENCES `mc_pages` (`id`)
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
        Schema::dropIfExists('mc_page_sections');
    }
}
