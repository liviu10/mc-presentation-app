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
            $table->id()->index('idx_id');
            $table->foreignId('blog_subcategory_id')->index('idx_blog_subcategory_id');
            $table->string('blog_article_author');
            $table->integer('blog_article_time');
            $table->string('blog_article_title');
            $table->string('blog_article_short_description');
            $table->longText('blog_article_content_section_1')->nullable();
            $table->longText('blog_article_content_section_2')->nullable();
            $table->longText('blog_article_content_section_3')->nullable();
            $table->longText('blog_article_content_section_4')->nullable();
            $table->longText('blog_article_content_section_5')->nullable();
            $table->string('blog_article_media_url');
            $table->string('blog_article_path');
            $table->string('blog_article_is_active', 3)->default('0');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::unprepared(
            'ALTER TABLE `blog_articles` 
            ADD CONSTRAINT `fk_blog_article_id`
                FOREIGN KEY (`blog_subcategory_id`)
                REFERENCES `blog_subcategories` (`id`)
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
        Schema::dropIfExists('blog_articles');
    }
}
