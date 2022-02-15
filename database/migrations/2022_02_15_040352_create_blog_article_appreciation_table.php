<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogArticleAppreciationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_article_appreciation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index('idx_user_id');
            $table->foreignId('blog_article_id')->index('idx_blog_article_id');
            $table->integer('blog_article_rating_system');
            $table->integer('blog_article_likes');
            $table->integer('blog_article_dislikes');
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
        Schema::dropIfExists('blog_article_appreciation');
    }
}
