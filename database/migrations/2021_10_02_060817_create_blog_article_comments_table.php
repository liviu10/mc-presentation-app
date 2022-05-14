<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateBlogArticleCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_article_comments', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->foreignId('blog_article_id')->index('idx_blog_article_id');
            $table->string('full_name')->nullable(false);
            $table->string('email')->nullable(false);
            $table->longText('comment');
            $table->string('comment_is_public', 3)->default('0');
            $table->string('privacy_policy', 3)->default('0');
            $table->timestamps();
        });

        DB::unprepared(
            'ALTER TABLE `blog_article_comments` 
            ADD CONSTRAINT `fk_blog_article_comment_id`
                FOREIGN KEY (`blog_article_id`)
                REFERENCES `blog_articles` (`id`)
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
        Schema::dropIfExists('blog_article_comments');
    }
}
