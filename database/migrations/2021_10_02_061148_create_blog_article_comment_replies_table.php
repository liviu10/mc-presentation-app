<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateBlogArticleCommentRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_article_comment_replies', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->foreignId('blog_article_comment_id')->index('idx_blog_article_comment_id');
            $table->string('full_name')->nullable(false);
            $table->string('email')->nullable(false);
            $table->longText('comment_reply');
            $table->string('comment_reply_is_public', 3);
            $table->string('privacy_policy', 3);
            $table->timestamps();
        });

        DB::unprepared(
            'ALTER TABLE `mc_presentation_app_db`.`blog_article_comment_replies` 
            ADD CONSTRAINT `fk_blog_article_comment_reply_id`
                FOREIGN KEY (`blog_article_comment_id`)
                REFERENCES `mc_presentation_app_db`.`blog_article_comments` (`id`)
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
        Schema::dropIfExists('blog_article_comment_replies');
    }
}
