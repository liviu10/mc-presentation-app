<?php

namespace App\Http\Controllers\User\BlogPage;

use App\Http\Controllers\Controller;
use App\Models\BlogSubcategory;

class BlogSubcategoryController extends Controller
{
    protected $modelNameBlogSubcategories;

    /**
     * Instantiate the variables that will be used to get the model.
     * 
     * @return Collection
     */
    public function __construct()
    {
        $this->modelNameBlogSubcategories      = new BlogSubcategory();
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
     * Display a list of all blog written articles for a given blog subcategory.
     *
     * @param  int  $id
     * @return Illuminate\Http\JsonResponse
     */
    public function getAllBlogSubcategoryWrittenArticles($id)
    {
        $allWrittenArticlesForSubcategory = $this->modelNameBlogSubcategories::select(
            'id',
            'blog_category_id',
            'blog_subcategory_title',
        )
        ->where('id', '=', $id)
        ->IsWrittenArticle()
        ->IsActive()
        ->with([
            // TODO: How do you load a parent through the belongsTo method (many to one relationship)
            'blog_articles' => function ($query) {
                $query->select(
                        'blog_subcategory_id',
                        'id',
                        'blog_article_title',
                        'blog_article_time',
                        'created_at',
                        'updated_at',
                        'blog_article_short_description',
                    )
                    ->IsActive();
            },
        ])
        ->get();

        return ($allWrittenArticlesForSubcategory->isEmpty()) ? response([], 404)->json() : response()->json($allWrittenArticlesForSubcategory);
    }

    /**
     * Display a list of all blog audio articles for a given blog subcategory.
     *
     * @param  int  $id
     * @return Illuminate\Http\JsonResponse
     */
    public function getAllBlogSubcategoryAudioArticles($id)
    {
        $allAudioArticlesForSubcategory = $this->modelNameBlogSubcategories::select(
            'id',
            'blog_category_id',
            'blog_subcategory_title',
        )
        ->where('id', '=', $id)
        ->IsAudioArticle()
        ->IsActive()
        ->with([
            // TODO: How do you load a parent through the belongsTo method (many to one relationship)
            'blog_articles' => function ($query) {
                $query->select(
                        'blog_subcategory_id',
                        'id',
                        'blog_article_title',
                        'blog_article_time',
                        'created_at',
                        'updated_at',
                        'blog_article_short_description',
                    )
                    ->IsActive();
            },
        ])
        ->get();

        return ($allAudioArticlesForSubcategory->isEmpty()) ? response([], 404)->json() : response()->json($allAudioArticlesForSubcategory);
    }

    /**
     * Display a list of all blog video articles for a given blog subcategory.
     *
     * @param  int  $id
     * @return Illuminate\Http\JsonResponse
     */
    public function getAllBlogSubcategoryVideoArticles($id)
    {
        $allVideoArticlesForSubcategory = $this->modelNameBlogSubcategories::select(
            'id',
            'blog_category_id',
            'blog_subcategory_title',
        )
        ->where('id', '=', $id)
        ->IsVideoArticle()
        ->IsActive()
        ->with([
            // TODO: How do you load a parent through the belongsTo method (many to one relationship)
            'blog_articles' => function ($query) {
                $query->select(
                        'blog_subcategory_id',
                        'id',
                        'blog_article_title',
                        'blog_article_time',
                        'created_at',
                        'updated_at',
                        'blog_article_short_description',
                    )
                    ->IsActive();
            },
        ])
        ->get();

        return ($allVideoArticlesForSubcategory->isEmpty()) ? response([], 404)->json() : response()->json($allVideoArticlesForSubcategory);
    }

    /**
     * Display a listing of all written blog articles.
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function getAllWrittenBlogArticles()
    {
        $allWrittenBlogArticles = $this->modelNameBlogSubcategories::select('id')
        ->IsWrittenArticle()
        ->IsActive()
        ->with([
            // TODO: How do you load a parent through the belongsTo method (many to one relationship)
            'blog_articles' => function ($query) {
                $query->select(
                    'blog_subcategory_id',
                    'id',
                    'blog_article_title',
                    'blog_article_time',
                    'created_at',
                    'blog_article_short_description',
                    'blog_article_path',
                )
                ->IsActive()
                ->orderBy('created_at', 'DESC');
            },
        ])
        ->get();

        return ($allWrittenBlogArticles->isEmpty()) ? response([], 404)->json() : response()->json($allWrittenBlogArticles);
    }

    /**
     * Display a listing of all audio blog articles.
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function getAllAudioBlogArticles()
    {
        $allAudioBlogArticles = $this->modelNameBlogSubcategories::select('id')
        ->IsAudioArticle()
        ->IsActive()
        ->with([
            // TODO: How do you load a parent through the belongsTo method (many to one relationship)
            'blog_articles' => function ($query) {
                $query->select(
                    'blog_subcategory_id',
                    'id',
                    'blog_article_title',
                    'blog_article_time',
                    'created_at',
                    'blog_article_short_description',
                    'blog_article_path',
                )
                ->IsActive()
                ->orderBy('created_at', 'DESC');
            },
        ])
        ->get();

        return ($allAudioBlogArticles->isEmpty()) ? response([], 404)->json() : response()->json($allAudioBlogArticles);
    }

    /**
     * Display a listing of all video blog articles.
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function getAllVideoBlogArticles()
    {
        $allVideoBlogArticles = $this->modelNameBlogSubcategories::select('id')
        ->IsVideoArticle()
        ->IsActive()
        ->with([
            // TODO: How do you load a parent through the belongsTo method (many to one relationship)
            'blog_articles' => function ($query) {
                $query->select(
                    'blog_subcategory_id',
                    'id',
                    'blog_article_title',
                    'blog_article_time',
                    'created_at',
                    'blog_article_short_description',
                    'blog_article_path',
                )
                ->IsActive()
                ->orderBy('created_at', 'DESC');
            },
        ])
        ->get();

        return ($allVideoBlogArticles->isEmpty()) ? response([], 404)->json() : response()->json($allVideoBlogArticles);
    }
}
