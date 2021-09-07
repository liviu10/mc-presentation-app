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
            $table->id();
            $table->string('blog_category_code', 6);
            $table->string('blog_subcategory_description', 255);
            $table->string('blog_subcategory_is_active', 3);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('deleted_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
        DB::unprepared(
            'ALTER TABLE `mc_presentation_app_db`.`blog_subcategories` 
            ADD CONSTRAINT `BlogCategoryCode` FOREIGN KEY (`blog_category_code`)
            REFERENCES `mc_presentation_app_db`.`blog_categories` (`blog_category_code`) ON DELETE RESTRICT ON UPDATE CASCADE;'
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
