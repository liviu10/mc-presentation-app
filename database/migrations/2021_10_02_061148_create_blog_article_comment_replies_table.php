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
            $table->id();
            $table->foreignId('blog_category_id');
            $table->foreignId('blog_subcategory_id');
            $table->foreignId('blog_article_id');
            $table->foreignId('blog_article_comment_id');
            $table->string('full_name', 255)->nullable(false);
            $table->string('email', 255)->nullable(false)->unique();
            $table->text('comment_reply');
            $table->string('comment_reply_is_public', 3);
            $table->string('privacy_policy', 3);
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
        Schema::dropIfExists('blog_article_comment_replies');
    }
}
