<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogArticleCommentReplyRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_article_comment_reply_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_article_comment_reply_id')->index('idx_blog_article_comment_reply_id');
            $table->string('full_name')->nullable(false);
            $table->string('email')->nullable(false);
            $table->longText('reply_to_comment_reply');
            $table->string('comment_reply_is_public', 3);
            $table->string('privacy_policy', 3);
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
        Schema::dropIfExists('blog_article_comment_reply_replies');
    }
}