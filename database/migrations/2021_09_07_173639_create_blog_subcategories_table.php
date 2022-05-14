<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateBlogSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_subcategories', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->foreignId('blog_category_id')->index('idx_blog_category_id');
            $table->string('blog_subcategory_title');
            $table->string('blog_subcategory_short_description')->nullable();
            $table->string('blog_subcategory_is_active', 3)->default('0');
            $table->string('blog_subcategory_path');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::unprepared(
            'ALTER TABLE `blog_subcategories` 
            ADD CONSTRAINT `fk_blog_subcategory_id`
                FOREIGN KEY (`blog_category_id`)
                REFERENCES `blog_categories` (`id`)
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
        Schema::dropIfExists('blog_subcategories');
    }
}
