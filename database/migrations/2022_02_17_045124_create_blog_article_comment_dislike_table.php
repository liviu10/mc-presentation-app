<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateBlogArticleCommentDislikeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_article_comment_dislike', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->foreignId('user_id')->index('idx_user_id');
            $table->foreignId('blog_article_comment_id')->index('idx_blog_article_comment_id');
            $table->integer('blog_article_comment_dislikes');
            $table->timestamps();
        });

        DB::unprepared(
            'ALTER TABLE `blog_article_comment_dislike` 
            ADD CONSTRAINT `fk_user_blog_article_comment_dislike_id`
                FOREIGN KEY (`user_id`)
                REFERENCES `users` (`id`)
                ON DELETE CASCADE
                ON UPDATE CASCADE,
            ADD CONSTRAINT `fk_blog_article_comment_dislike_id`
                FOREIGN KEY (`blog_article_comment_id`)
                REFERENCES `blog_article_comments` (`id`)
                ON DELETE CASCADE
                ON UPDATE CASCADE;'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_article_comment_dislike');
    }
}
