<?php

namespace App\Http\Controllers\User\BlogPage;

use App\Http\Controllers\Controller;
use App\Models\BlogArticle;

class BlogArticleController extends Controller
{
    protected $modelNameBlogArticles;

    /**
     * Instantiate the variables that will be used to get the model.
     * 
     * @return Collection
     */
    public function __construct()
    {
        $this->modelNameBlogArticles = new BlogArticle();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
    }

    /**
     * Display a listing of all written blog articles.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllWrittenBlogArticles()
    {
        $allWrittenBlogArticles = $this->modelNameBlogArticles::select(
            'id',
            'blog_article_title',
            'blog_article_time',
            'created_at',
            'blog_article_short_description',
            'blog_article_slug',
        )
        ->where('blog_category_id', '=', '1')
        ->where('blog_article_is_active', '<>', '0')
        ->orderBy('created_at', 'DESC')
        ->get();

        return ($allWrittenBlogArticles->isEmpty()) ? response([], 404)->json() : response()->json($allWrittenBlogArticles);
    }

    /**
     * Display a listing of all audio blog articles.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllAudioBlogArticles()
    {
        $allAudioBlogArticles = $this->modelNameBlogArticles::select(
            'id',
            'blog_article_title',
            'blog_article_time',
            'created_at',
            'updated_at',
            'blog_article_short_description',
            'blog_article_slug',
        )
        ->where('blog_category_id', '=', '2')
        ->where('blog_article_is_audio', '=', '1')
        ->where('blog_article_is_active', '<>', '0')
        ->orderBy('created_at', 'DESC')
        ->get();

        return ($allAudioBlogArticles->isEmpty()) ? response([], 404)->json() : response()->json($allAudioBlogArticles);
    }

    /**
     * Display a listing of all video blog articles.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllVideoBlogArticles()
    {
        $allVideoBlogArticles = $this->modelNameBlogArticles::select(
            'id',
            'blog_article_title',
            'blog_article_time',
            'created_at',
            'updated_at',
            'blog_article_short_description',
            'blog_article_slug',
        )
        ->where('blog_category_id', '=', '3')
        ->where('blog_article_is_video', '=', '1')
        ->where('blog_article_is_active', '<>', '0')
        ->orderBy('created_at', 'DESC')
        ->get();

        return ($allVideoBlogArticles->isEmpty()) ? response([], 404)->json() : response()->json($allVideoBlogArticles);
    }

    /**
     * Display a listing of all video blog articles.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function displaySingleBlogArticle($id)
    {
        $displayBlogArticle = $this->modelNameBlogArticles::select(
            'id',
            'blog_article_title',
            'blog_article_author',
            'created_at',
            'blog_article_time',
            'blog_article_short_description',
            'blog_article_content',
            'blog_article_rating_system',
            'blog_article_likes',
            'blog_article_dislikes',
            'created_at',
            'updated_at',
        )
        ->where('id', '=', $id)->where('blog_article_is_active', '<>', '0')
        ->with([
            // TODO: How do you load a parent through the belongsTo method (many to one relationship)
            'blog_article_comments' => function ($query) {
                $query->select('blog_article_id', 'id', 'full_name', 'email', 'comment', 'created_at', 'updated_at')
                      ->where('comment_is_public', '<>', '0');
            },
            'blog_article_comments.blog_article_comment_replies' => function ($query) {
                $query->select('blog_article_comment_id', 'id', 'full_name', 'email', 'comment_reply', 'created_at', 'updated_at')
                      ->where('comment_reply_is_public', '<>', '0');
            }
        ])
        ->get();
        
        return ($displayBlogArticle->isEmpty()) ? response([], 404)->json() : response()->json($displayBlogArticle);
    }
}
