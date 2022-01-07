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
     * @return Illuminate\Http\Response
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

        if ($allWrittenArticlesForSubcategory->isEmpty()) 
        {
            return response([
                'title'              => 'Resource(s) not found!',
                'notify_code'        => 'WAR_00001',
                'description'        => 'The blog resource(s) does not exist! Please try again later!',
                'http_response_code' => 404,
                'records'            => [],
            ], 404);
        }
        else 
        {
            return response([
                'title'              => 'Success!',
                'notify_code'        => 'INFO_00001',
                'description'        => 'The blog resource(s) was(were) successfully fetched!',
                'http_response_code' => 200,
                'records'            => $allWrittenArticlesForSubcategory,
            ], 200);
        }
    }

    /**
     * Display a list of all blog audio articles for a given blog subcategory.
     *
     * @param  int  $id
     * @return Illuminate\Http\Response
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

        if ($allAudioArticlesForSubcategory->isEmpty()) 
        {
            return response([
                'title'              => 'Resource(s) not found!',
                'notify_code'        => 'WAR_00001',
                'description'        => 'The blog resource(s) does not exist! Please try again later!',
                'http_response_code' => 404,
                'records'            => [],
            ], 404);
        }
        else 
        {
            return response([
                'title'              => 'Success!',
                'notify_code'        => 'INFO_00001',
                'description'        => 'The blog resource(s) was(were) successfully fetched!',
                'http_response_code' => 200,
                'records'            => $allAudioArticlesForSubcategory,
            ], 200);
        }
    }

    /**
     * Display a list of all blog video articles for a given blog subcategory.
     *
     * @param  int  $id
     * @return Illuminate\Http\Response
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

        if ($allVideoArticlesForSubcategory->isEmpty()) 
        {
            return response([
                'title'              => 'Resource(s) not found!',
                'notify_code'        => 'WAR_00001',
                'description'        => 'The blog resource(s) does not exist! Please try again later!',
                'http_response_code' => 404,
                'records'            => [],
            ], 404);
        }
        else 
        {
            return response([
                'title'              => 'Success!',
                'notify_code'        => 'INFO_00001',
                'description'        => 'The blog resource(s) was(were) successfully fetched!',
                'http_response_code' => 200,
                'records'            => $allVideoArticlesForSubcategory,
            ], 200);
        }
    }

    /**
     * Display a listing of all written blog articles.
     *
     * @return Illuminate\Http\Response
     */
    public function getAllWrittenBlogArticles()
    {
        $allWrittenBlogArticles = $this->modelNameBlogSubcategories::select(
            'id',
            'blog_subcategory_title'
        )
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
                    'blog_article_path',
                )
                ->IsActive()
                ->orderBy('created_at', 'DESC');
            },
        ])
        ->get();

        if ($allWrittenBlogArticles->isEmpty()) 
        {
            return response([
                'title'              => 'Resource(s) not found!',
                'notify_code'        => 'WAR_00001',
                'description'        => 'The blog resource(s) does not exist! Please try again later!',
                'http_response_code' => 404,
                'records'            => [],
            ], 404);
        }
        else 
        {
            return response([
                'title'              => 'Success!',
                'notify_code'        => 'INFO_00001',
                'description'        => 'The blog resource(s) was(were) successfully fetched!',
                'http_response_code' => 200,
                'records'            => $allWrittenBlogArticles,
            ], 200);
        }
    }

    /**
     * Display a listing of all audio blog articles.
     *
     * @return Illuminate\Http\Response
     */
    public function getAllAudioBlogArticles()
    {
        $allAudioBlogArticles = $this->modelNameBlogSubcategories::select(
            'id',
            'blog_subcategory_title'
        )
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
                    'blog_article_path',
                )
                ->IsActive()
                ->orderBy('created_at', 'DESC');
            },
        ])
        ->get();

        if ($allAudioBlogArticles->isEmpty()) 
        {
            return response([
                'title'              => 'Resource(s) not found!',
                'notify_code'        => 'WAR_00001',
                'description'        => 'The blog resource(s) does not exist! Please try again later!',
                'http_response_code' => 404,
                'records'            => [],
            ], 404);
        }
        else 
        {
            return response([
                'title'              => 'Success!',
                'notify_code'        => 'INFO_00001',
                'description'        => 'The blog resource(s) was(were) successfully fetched!',
                'http_response_code' => 200,
                'records'            => $allAudioBlogArticles,
            ], 200);
        }
    }

    /**
     * Display a listing of all video blog articles.
     *
     * @return Illuminate\Http\Response
     */
    public function getAllVideoBlogArticles()
    {
        $allVideoBlogArticles = $this->modelNameBlogSubcategories::select(
            'id',
            'blog_subcategory_title'
        )
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
                    'blog_article_path',
                )
                ->IsActive()
                ->orderBy('created_at', 'DESC');
            },
        ])
        ->get();

        if ($allVideoBlogArticles->isEmpty()) 
        {
            return response([
                'title'              => 'Resource(s) not found!',
                'notify_code'        => 'WAR_00001',
                'description'        => 'The blog resource(s) does not exist! Please try again later!',
                'http_response_code' => 404,
                'records'            => [],
            ], 404);
        }
        else 
        {
            return response([
                'title'              => 'Success!',
                'notify_code'        => 'INFO_00001',
                'description'        => 'The blog resource(s) was(were) successfully fetched!',
                'http_response_code' => 200,
                'records'            => $allVideoBlogArticles,
            ], 200);
        }
    }
}
