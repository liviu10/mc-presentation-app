<?php

namespace App\Http\Controllers\Admin\BlogSystem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BlogArticle;
use App\Models\ErrorAndNotificationSystem;
use Illuminate\Support\Facades\Auth;

class BlogArticleAndCommentSystemController extends Controller
{
    protected $modelNameBlogArticle;
    protected $modelNameErrorSystem;
    protected $tableNameBlogArticle;
    protected $tableNameErrorSystem;

    /**
     * Instantiate the variables that will be used to get the model and table name as well as the table's columns.
     *
     * @return Collection|String
     */
    public function __construct()
    {
        $this->modelNameBlogArticle = new BlogArticle();
        $this->modelNameErrorSystem = new ErrorAndNotificationSystem();
        $this->tableNameBlogArticle = $this->modelNameBlogArticle->getTable();
        $this->tableNameErrorSystem = $this->modelNameErrorSystem->getTable();
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function displayArticles()
    {
        try
        {
            $apiDisplayAllRecords = $this->modelNameBlogArticle->select('*')
                                    ->with([
                                        'blog_subcategory' => function ($query) {
                                            $query->select('id', 'blog_category_id', 'blog_subcategory_title', 'blog_subcategory_path')->with([
                                                'blog_category' => function ($query) {
                                                    $query->select('id', 'blog_category_title', 'blog_category_path');
                                                }
                                            ]);
                                        },
                                        'blog_article_like' => function ($query) {
                                            $query->select('id', 'user_id', 'blog_article_id', 'blog_article_likes');
                                        },
                                        'blog_article_dislike' => function ($query) {
                                            $query->select('id', 'user_id', 'blog_article_id', 'blog_article_dislikes');
                                        },
                                        'blog_article_rate' => function ($query) {
                                            $query->select('id', 'user_id', 'blog_article_id', 'blog_article_rating_system');
                                        },
                                        'blog_article_comments' => function ($query) {
                                            $query->select('id', 'blog_article_id', 'full_name', 'email', 'comment', 'comment_is_public', 'privacy_policy', 'created_at')->with([
                                                'blog_article_comment_like' => function($query) {
                                                    $query->select('id', 'user_id', 'blog_article_comment_id', 'blog_article_comment_likes');
                                                },
                                                'blog_article_comment_dislike' => function($query) {
                                                    $query->select('id', 'user_id', 'blog_article_comment_id', 'blog_article_comment_dislikes');
                                                },
                                                'blog_article_comment_replies' => function($query) {
                                                    $query->select('id', 'blog_article_comment_id', 'full_name', 'email', 'comment_reply', 'comment_reply_is_public', 'privacy_policy', 'created_at')->with([
                                                        'blog_article_comment_reply_like' => function ($query) {
                                                            $query->select('id', 'user_id', 'blog_article_comment_reply_id', 'blog_article_comment_reply_likes');
                                                        },
                                                        'blog_article_comment_reply_dislike' => function ($query) {
                                                            $query->select('id', 'user_id', 'blog_article_comment_reply_id', 'blog_article_comment_reply_dislikes');
                                                        }
                                                    ]);
                                                }
                                            ]);
                                        }
                                    ])
                                    ->get();
            if ($apiDisplayAllRecords->isEmpty())
            {
                return response([
                    'title'              => __('error_and_notification_system.index.war_00001_notify.user_has_rights.message_title'),
                    'notify_code'        => 'WAR_00001',
                    'description'        => __('error_and_notification_system.index.war_00001_notify.user_has_rights.message_super_admin', [
                        'methodName'     => $_SERVER['REQUEST_METHOD'],
                        'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                        'serviceName' => __NAMESPACE__ . '\\' . basename(BlogArticleAndCommentSystemController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => $this->tableNameBlogArticle
                    ]),
                    'reference'          => config('app.url') . '/documentation/warning#WAR_00001',
                    'api_endpoint'       => $_SERVER['REQUEST_URI'],
                    'http_response'      => [
                        'code'           => 404,
                        'general_message'=> 'The HTTP 404 Not Found client error response code indicates that the server can\'t find the requested resource.',
                        'url'            => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/404',
                    ],
                    'records'            => [],
                ], 404);
            }
            else
            {
                return response([
                    'title'              => __('error_and_notification_system.index.info_00001_notify.user_has_rights.message_title'),
                    'notify_code'        => 'INFO_00001',
                    'description'        => __('error_and_notification_system.index.info_00001_notify.user_has_rights.message_super_admin', [
                        'numberOfRecords'=> $apiDisplayAllRecords->count(),
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => $this->tableNameBlogArticle
                    ]),
                    'reference'          => $this->modelNameErrorSystem::where('notify_code', '=', 'INFO_00001')->pluck('notify_reference')[0],
                    'api_endpoint'       => $_SERVER['REQUEST_URI'],
                    'http_response'      => [
                        'code'           => 200,
                        'general_message'=> 'The HTTP 200 OK success status response code indicates that the request has succeeded. A 200 response is cacheable by default.',
                        'url'            => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/200',
                    ],
                    'records'            => $apiDisplayAllRecords,
                ], 200);
            }
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02')
            {
                return response([
                    'title'              => __('error_and_notification_system.index.err_00001_notify.user_has_rights.message_title'),
                    'notify_code'        => 'ERR_00001',
                    'description'        => __('error_and_notification_system.index.err_00001_notify.user_has_rights.message_super_admin', [
                        'methodName'     => $_SERVER['REQUEST_METHOD'],
                        'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                        'serviceName' => __NAMESPACE__ . '\\' . basename(BlogArticleAndCommentSystemController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => 'blog_categories',
                    ]),
                    'reference'          => config('app.url') . '/documentation/error#ERR_00001',
                    'api_endpoint'       => $_SERVER['REQUEST_URI'],
                    'http_response'      => [
                        'code'           => 500,
                        'general_message'=> 'The HyperText Transfer Protocol (HTTP) 500 Internal Server Error server error response code indicates that the server encountered an unexpected condition that prevented it from fulfilling the request.',
                        'url'            => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/500',
                    ],
                    'sql_response'       => [
                        'sql_err_code'   => $mysqlError->getCode(),
                        'sql_err_message'=> $mysqlError->getMessage(),
                        'sql_err_url'    => 'https://dev.mysql.com/doc/refman/8.0/en/cannot-find-table.html'
                    ],
                    'records'            => [],
                ], 500);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createArticle(Request $request)
    {
        try
        {
            $request->validate([
                'blog_article_title'             => 'required|regex:/^[a-zA-Z_ ]+$/u|max:255',
                'blog_article_short_description' => 'required|max:255',
                'blog_article_is_active'         => 'required',
            ]);

            $readWordsPerMinute = 200;
            $blogArticleSections = $request->get('blog_article_content');
            $totalNumberOfWords = 0;
            $totalReadingTime = 0;
            foreach ($blogArticleSections as $section)
            {
                $totalNumberOfWords += str_word_count(strip_tags($section));
            }
            $totalReadingTime = $totalNumberOfWords / $readWordsPerMinute;

            if ($request->get('blog_subcategory')['blog_category_id'] === 1)
            {
                $apiInsertSingleRecord = $this->modelNameBlogArticle->create([
                    'blog_subcategory_id'            => $request->get('blog_subcategory')['id'],
                    'blog_article_author'            => Auth::user()->name,
                    'blog_article_time'              => $totalReadingTime,
                    'blog_article_title'             => $request->get('blog_article_title'),
                    'blog_article_short_description' => $request->get('blog_article_short_description'),
                    'blog_article_content_section_1' => $request->get('blog_article_content')['section_1'],
                    'blog_article_content_section_2' => $request->get('blog_article_content')['section_2'],
                    'blog_article_content_section_3' => $request->get('blog_article_content')['section_3'],
                    'blog_article_content_section_4' => $request->get('blog_article_content')['section_4'],
                    'blog_article_content_section_5' => $request->get('blog_article_content')['section_5'],
                    'blog_article_media_url'         => 'test',// $request->get('blog_article_media_url'),
                    'blog_article_path'              => '/blog/article/view',
                    'blog_article_is_active'         => $request->get('blog_article_is_active'),
                ]);
            }
            else if ($request->get('blog_subcategory')['blog_category_id'] === 2)
            {
                $apiInsertSingleRecord = $this->modelNameBlogArticle->create([
                    'blog_subcategory_id'            => $request->get('blog_subcategory')['id'],
                    'blog_article_author'            => Auth::user()->name,
                    'blog_article_time'              => $totalReadingTime,
                    'blog_article_title'             => $request->get('blog_article_title'),
                    'blog_article_short_description' => $request->get('blog_article_short_description'),
                    'blog_article_content_section_1' => $request->get('blog_article_content')['section_1'],
                    'blog_article_content_section_2' => $request->get('blog_article_content')['section_2'],
                    'blog_article_content_section_3' => $request->get('blog_article_content')['section_3'],
                    'blog_article_content_section_4' => $request->get('blog_article_content')['section_4'],
                    'blog_article_content_section_5' => $request->get('blog_article_content')['section_5'],
                    'blog_article_media_url'         => 'test',// $request->get('blog_article_media_url'),
                    'blog_article_path'              => '/blog/audio/view',
                    'blog_article_is_active'         => $request->get('blog_article_is_active'),
                ]);
            }
            else
            {
                $apiInsertSingleRecord = $this->modelNameBlogArticle->create([
                    'blog_subcategory_id'            => $request->get('blog_subcategory')['id'],
                    'blog_article_author'            => Auth::user()->name,
                    'blog_article_time'              => $totalReadingTime,
                    'blog_article_title'             => $request->get('blog_article_title'),
                    'blog_article_short_description' => $request->get('blog_article_short_description'),
                    'blog_article_content_section_1' => $request->get('blog_article_content')['section_1'],
                    'blog_article_content_section_2' => $request->get('blog_article_content')['section_2'],
                    'blog_article_content_section_3' => $request->get('blog_article_content')['section_3'],
                    'blog_article_content_section_4' => $request->get('blog_article_content')['section_4'],
                    'blog_article_content_section_5' => $request->get('blog_article_content')['section_5'],
                    'blog_article_media_url'         => 'test',// $request->get('blog_article_media_url'),
                    'blog_article_path'              => '/blog/video/view',
                    'blog_article_is_active'         => $request->get('blog_article_is_active'),
                ]);
            }
            return response([
                'title'              => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_title'),
                'notify_code'        => 'INFO_00002',
                'description'        => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_super_admin', [
                    'record'         => $apiInsertSingleRecord['blog_article_title'],
                    'databaseName'   => config('database.connections.mysql.database'),
                    'tableName'      => $this->tableNameBlogArticle
                ]),
                'reference'          => $this->modelNameErrorSystem::where('notify_code', '=', 'INFO_00002')->pluck('notify_reference')[0],
                'api_endpoint'       => $_SERVER['REQUEST_URI'],
                'http_response'      => [
                    'code'           => 201,
                    'general_message'=> 'The HTTP 201 Created success status response code indicates that the request has succeeded and has led to the creation of a resource.',
                    'url'            => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/201',
                ],
                'records'            => $apiInsertSingleRecord,
            ], 201);
        }
        catch  (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02')
            {
                return response([
                    'title'              => __('error_and_notification_system.store.err_00001_notify.user_has_rights.message_title'),
                    'notify_code'        => 'ERR_00001',
                    'description'        => __('error_and_notification_system.store.err_00001_notify.user_has_rights.message_super_admin', [
                        'methodName'     => $_SERVER['REQUEST_METHOD'],
                        'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                        'serviceName' => __NAMESPACE__ . '\\' . basename(BlogCategorySystemController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => 'blog_articles',
                    ]),
                    'reference'          => config('app.url') . '/documentation/error#ERR_00001',
                    'api_endpoint'       => $_SERVER['REQUEST_URI'],
                    'http_response'      => [
                        'code'           => 500,
                        'general_message'=> 'The HyperText Transfer Protocol (HTTP) 500 Internal Server Error server error response code indicates that the server encountered an unexpected condition that prevented it from fulfilling the request.',
                        'url'            => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/500',
                    ],
                    'sql_response'       => [
                        'sql_err_code'   => $mysqlError->getCode(),
                        'sql_err_message'=> $mysqlError->getMessage(),
                        'sql_err_url'    => 'https://dev.mysql.com/doc/refman/8.0/en/cannot-find-table.html'
                    ],
                    'records'            => [],
                ], 500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteAllArticles()
    {
        try
        {
            $apiDisplayAllRecords = $this->modelNameBlogArticle->all();
            if ($apiDisplayAllRecords->isEmpty())
                {
                    return response([
                        'title'              => __('error_and_notification_system.delete_all.war_00001_notify.user_has_rights.message_title'),
                        'notify_code'        => 'WAR_00001',
                        'description'        => __('error_and_notification_system.delete_all.war_00001_notify.user_has_rights.message_super_admin', [
                            'methodName'     => $_SERVER['REQUEST_METHOD'],
                            'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                            'serviceName' => __NAMESPACE__ . '\\' . basename(BlogArticleSystemController::class) . '.php',
                            'databaseName'   => config('database.connections.mysql.database'),
                            'tableName'      => $this->tableNameBlogArticle
                        ]),
                        'reference'          => $this->modelNameErrorSystem::where('notify_code', '=', 'WAR_00001')->pluck('notify_reference')[0],
                        'api_endpoint'       => $_SERVER['REQUEST_URI'],
                        'http_response'      => [
                            'code'           => 404,
                            'general_message'=> 'The HTTP 404 Not Found client error response code indicates that the server can\'t find the requested resource.',
                            'url'            => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/404',
                        ],
                        'records'            => [],
                    ], 404);
                }
                else
                {
                    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                    $apiDeleteSingleRecord = $this->modelNameBlogArticle->truncate();
                    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                    return response([
                        'title'              => __('error_and_notification_system.delete_all.info_00004_notify.user_has_rights.message_title'),
                        'notify_code'        => 'INFO_00004',
                        'description'        => __('error_and_notification_system.delete_all.info_00004_notify.user_has_rights.message_super_admin', [
                            'databaseName'   => config('database.connections.mysql.database'),
                            'tableName'      => $this->tableNameBlogArticle
                        ]),
                        'reference'          => $this->modelNameErrorSystem::where('notify_code', '=', 'INFO_00004')->pluck('notify_reference')[0],
                        'api_endpoint'       => $_SERVER['REQUEST_URI'],
                        'http_response'      => [
                            'code'           => 200,
                            'general_message'=> 'The HTTP 200 OK success status response code indicates that the request has succeeded. A 200 response is cacheable by default.',
                            'url'            => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/200',
                        ],
                        'records'            => $apiDisplayAllRecords,
                    ], 200);
                }
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02')
            {
                return response([
                    'title'              => __('error_and_notification_system.delete_all.err_00001_notify.user_has_rights.message_title'),
                    'notify_code'        => 'ERR_00001',
                    'description'        => __('error_and_notification_system.delete_all.err_00001_notify.user_has_rights.message_super_admin', [
                        'methodName'     => $_SERVER['REQUEST_METHOD'],
                        'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                        'serviceName' => __NAMESPACE__ . '\\' . basename(BlogArticleSystemController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => 'blog_articles',
                    ]),
                    'reference'          => $this->modelNameErrorSystem::where('notify_code', '=', 'ERR_00001')->pluck('notify_reference')[0],
                    'api_endpoint'       => $_SERVER['REQUEST_URI'],
                    'http_response'      => [
                        'code'           => 500,
                        'general_message'=> 'The HyperText Transfer Protocol (HTTP) 500 Internal Server Error server error response code indicates that the server encountered an unexpected condition that prevented it from fulfilling the request.',
                        'url'            => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/500',
                    ],
                    'sql_response'       => [
                        'sql_err_code'   => $mysqlError->getCode(),
                        'sql_err_message'=> $mysqlError->getMessage(),
                        'sql_err_url'    => 'https://dev.mysql.com/doc/refman/8.0/en/cannot-find-table.html'
                    ],
                    'records'            => [],
                ], 500);
            }
        }
    }
}
