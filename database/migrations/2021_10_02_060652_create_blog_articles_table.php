<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateBlogArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_category_id');
            $table->foreignId('blog_subcategory_id');
            $table->string('blog_article_author', 255);
            $table->integer('blog_article_reading_time');
            $table->string('blog_article_title', 255);
            $table->string('blog_article_short_description', 255);
            $table->longText('blog_article_content');
            $table->string('blog_article_slug', 255);
            $table->string('blog_article_is_audio', 3);
            $table->string('blog_article_is_video', 3);
            $table->string('blog_article_is_active', 3);
            $table->integer('blog_article_rating_system');
            $table->integer('blog_article_likes');
            $table->integer('blog_article_dislikes');
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
        Schema::dropIfExists('blog_articles');
    }
}
