<?php

namespace App\Http\Controllers\User\BlogPage;

use App\Http\Controllers\Controller;
use App\Models\BlogSubcategory;
use App\Models\BlogArticle;

class BlogSubcategoryController extends Controller
{
    protected $modelNameBlogSubcategories;
    protected $modelNameBlogArticles;

    /**
     * Instantiate the variables that will be used to get the model.
     * 
     * @return Collection
     */
    public function __construct()
    {
        $this->modelNameBlogSubcategories      = new BlogSubcategory();
        $this->modelNameBlogArticles           = new BlogArticle();
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
            'blog_subcategory_path'
        )
        ->where('id', '=', $id)
        ->IsWrittenArticle()
        ->IsActive()
        ->with([
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
            'blog_subcategory_path'
        )
        ->where('id', '=', $id)
        ->IsAudioArticle()
        ->IsActive()
        ->with([
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
            'blog_subcategory_path'
        )
        ->where('id', '=', $id)
        ->IsVideoArticle()
        ->IsActive()
        ->with([
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
            'blog_subcategory_title',
            'blog_subcategory_path'
        )
        ->IsWrittenArticle()
        ->IsActive()
        ->with([
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
            'blog_subcategory_title',
            'blog_subcategory_path'
        )
        ->IsAudioArticle()
        ->IsActive()
        ->with([
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
            'blog_subcategory_title',
            'blog_subcategory_path'
        )
        ->IsVideoArticle()
        ->IsActive()
        ->with([
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

    /**
     * Display a single blog article together with it's comments.
     *
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function displaySingleBlogArticle($id)
    {
        $getSubcategoryId = $this->modelNameBlogArticles::select('id', 'blog_subcategory_id')->where('id', '=', $id)->pluck('blog_subcategory_id');
        $displayBlogArticle = $this->modelNameBlogSubcategories::select(
            'id',
            'blog_subcategory_title',
            'blog_subcategory_path'
        )
        ->where('id', '=', $getSubcategoryId)
        ->IsActive()
        ->with([
            'blog_articles' => function ($query) use ($id) {
                $query->select(
                    'blog_subcategory_id',
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
                    'blog_article_comments' => function ($query) {
                        $query->select(
                            'blog_article_id',
                            'id',
                            'full_name',
                            'email',
                            'comment',
                            'created_at'
                        )
                        ->IsCommentPublic()
                        ->with([
                            'blog_article_comment_replies' => function ($query) {
                                $query->select(
                                    'blog_article_comment_id',
                                    'id',
                                    'full_name',
                                    'email',
                                    'comment_reply',
                                    'created_at'
                                )
                                ->IsCommentReplyPublic()
                                ->with([
                                    'blog_article_comment_reply_replies' => function ($query) {
                                        $query->select(
                                            'blog_article_comment_reply_id',
                                            'id',
                                            'full_name',
                                            'email',
                                            'reply_to_comment_reply',
                                            'created_at'
                                        )
                                        ->isCommentReplyPublic();
                                    }
                                ]);
                            }
                        ]);
                    }
                ]);
            }
        ])
        ->get();
        
        if ($displayBlogArticle->isEmpty()) 
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
                'records'            => $displayBlogArticle,
            ], 200);
        }
    }
}
