<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->foreignId('blog_category_id')->index('idx_blog_category_id');
            $table->string('blog_subcategory_title');
            $table->string('blog_subcategory_short_description');
            $table->longText('blog_subcategory_description');
            $table->string('blog_subcategory_is_active', 3)->default('0');
            $table->string('blog_subcategory_path');
            $table->timestamps();
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
