<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->foreignId('blog_subcategory_id')->index('idx_blog_subcategory_id');
            $table->string('blog_article_author');
            $table->integer('blog_article_time');
            $table->string('blog_article_title');
            $table->string('blog_article_short_description');
            $table->longText('blog_article_content');
            $table->string('blog_article_path');
            $table->string('blog_article_is_active', 3)->default('0');
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
        Schema::dropIfExists('blog_articles');
    }
}
