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
     * Display a single blog article together with it's comments.
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
        ->where('id', '=', $id)
        ->IsActive()
        ->with([
            // TODO: How do you load a parent through the belongsTo method (many to one relationship)
            'blog_article_comments' => function ($query) {
                $query->select(
                    'blog_article_id',
                    'id',
                    'full_name',
                    'email',
                    'comment',
                    'created_at',
                    'updated_at'
                )
                ->IsCommentPublic();
            }
        ])
        ->get();
        
        return ($displayBlogArticle->isEmpty()) ? response([], 404)->json() : response()->json($displayBlogArticle);
    }
}
