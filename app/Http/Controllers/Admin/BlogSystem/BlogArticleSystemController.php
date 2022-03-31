<?php

namespace App\Http\Controllers\Admin\BlogSystem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BlogArticle;
use App\Models\BlogArticleLike;
use App\Models\BlogArticleDislike;
use App\Models\BlogArticleRate;
use App\Models\BlogArticleComment;
use App\Models\BlogArticleCommentLike;
use App\Models\BlogArticleCommentDislike;
use App\Models\BlogArticleCommentReply;
use App\Models\BlogArticleCommentReplyLike;
use App\Models\BlogArticleCommentReplyDislike;
use App\Models\ErrorAndNotificationSystem;

class BlogArticleSystemController extends Controller
{
    protected $modelNameBlogArticle; // $modelNameBlogCategory
    protected $modelNameErrorSystem;

    protected $tableNameBlogArticle; // $tableNameBlogCategory
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
        try
        {
            $apiDisplayAllRecords = $this->modelNameBlogArticle->select('*')
                                    ->with([
                                        'blog_article_like' => function ($query) {
                                            $query->select('*');
                                        },
                                        'blog_article_dislike' => function ($query) {
                                            $query->select('*');
                                        },
                                        'blog_article_rate' => function ($query) {
                                            $query->select('*');
                                        },
                                        'blog_article_comments' => function ($query) {
                                            $query->select('*');
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
                        'serviceName' => __NAMESPACE__ . '\\' . basename(BlogArticleSystemController::class) . '.php',
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
                        'serviceName' => __NAMESPACE__ . '\\' . basename(BlogArticleSystemController::class) . '.php',
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
