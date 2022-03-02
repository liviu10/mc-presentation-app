<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->string('blog_category_title')->unique();
            $table->string('blog_category_short_description');
            $table->longText('blog_category_description');
            $table->string('blog_category_is_active', 3)->default('0');
            $table->string('blog_image_card_url');
            $table->string('blog_category_path');
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
        Schema::dropIfExists('blog_categories');
    }
}
