<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateBlogArticleCommentReplyDislikeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_article_comment_reply_dislike', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->foreignId('user_id')->index('idx_user_id');
            $table->foreignId('blog_article_comment_reply_id')->index('idx_blog_article_comment_reply_id');
            $table->integer('blog_article_comment_reply_dislikes');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        DB::unprepared(
            'ALTER TABLE `mc_presentation_app_db`.`blog_article_comment_reply_dislike` 
            ADD CONSTRAINT `fk_user_blog_article_comment_reply_dislike_id`
                FOREIGN KEY (`user_id`)
                REFERENCES `mc_presentation_app_db`.`users` (`id`)
                ON DELETE CASCADE
                ON UPDATE CASCADE,
            ADD CONSTRAINT `fk_blog_article_comment_reply_dislike_id`
                FOREIGN KEY (`blog_article_comment_reply_id`)
                REFERENCES `mc_presentation_app_db`.`blog_article_comment_replies` (`id`)
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
        Schema::dropIfExists('blog_article_comment_reply_dislike');
    }
}
