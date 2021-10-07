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
            $table->foreignId('blog_category_id');
            $table->string('blog_subcategory_title', 255);
            $table->string('blog_subcategory_short_description', 255);
            $table->longText('blog_subcategory_description');
            $table->string('blog_subcategory_is_active', 3);
            $table->string('blog_subcategory_slug', 255);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('deleted_at')->nullable();
        });
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
