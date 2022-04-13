<?php

namespace App\Http\Controllers\Admin\BlogSystem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BlogCategory;
use App\Models\BlogSubcategory;
use App\Models\ErrorAndNotificationSystem;

class BlogCategoryAndSubcategorySystemController extends Controller
{
    protected $modelNameBlogCategory;
    protected $modelNameBlogSubcategory;
    protected $modelNameErrorSystem;

    protected $tableNameBlogCategory;
    protected $tableNameBlogSubcategory;
    protected $tableNameErrorSystem;

    /**
     * Instantiate the variables that will be used to get the model and table name as well as the table's columns.
     *
     * @return Collection|String
     */
    public function __construct()
    {
        $this->modelNameBlogCategory    = new BlogCategory();
        $this->modelNameBlogSubcategory = new BlogSubcategory();
        $this->modelNameErrorSystem     = new ErrorAndNotificationSystem();

        $this->tableNameBlogCategory    = $this->modelNameBlogCategory->getTable();
        $this->tableNameBlogSubcategory = $this->modelNameBlogSubcategory->getTable();
        $this->tableNameErrorSystem     = $this->modelNameErrorSystem->getTable();
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
    public function displayBlogCategories()
    {
        try
        {
            $apiDisplayAllRecords = $this->modelNameBlogCategory->select(
                                        'id',
                                        'blog_category_title',
                                        'blog_category_short_description',
                                        'blog_category_is_active',
                                        'blog_image_card_url',
                                        'blog_category_path',
                                        'created_at',
                                    )
                                    ->get();
            if ($apiDisplayAllRecords->isEmpty())
            {
                return response([
                    'title'              => __('error_and_notification_system.index.war_00001_notify.user_has_rights.message_title'),
                    'notify_code'        => 'WAR_00001',
                    'description'        => __('error_and_notification_system.index.war_00001_notify.user_has_rights.message_super_admin', [
                        'methodName'     => $_SERVER['REQUEST_METHOD'],
                        'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                        'serviceName' => __NAMESPACE__ . '\\' . basename(BlogCategorySystemController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => $this->tableNameBlogCategory
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
                        'tableName'      => $this->tableNameBlogCategory
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
                        'serviceName' => __NAMESPACE__ . '\\' . basename(BlogCategorySystemController::class) . '.php',
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editCategory(Request $request, $id)
    {
        try
        {
            $request->validate([
                'blog_category_title'             => 'required|regex:/^[a-zA-Z_ ]+$/u|max:255',
                'blog_category_short_description' => 'required|max:255',
                'blog_category_is_active'         => 'required',
                // 'blog_image_card_url'             => 'mimes:jpeg',
                // 'blog_category_path'              => 'required|max:255',
            ]);
            $getFile = $request->file('blog_image_card_url');
            $getFileName = $request->file('blog_image_card_url')->getClientOriginalName();
            $getDestinationPath = '/images/pages/blog/main_categories/';
    
            $apiUpdateSingleRecord = $this->modelNameBlogCategory->find($id);
            $apiUpdateSingleRecord->update([
                'blog_category_title'             => $request->get('blog_category_title'),
                'blog_category_short_description' => $request->get('blog_category_short_description'),
                'blog_category_is_active'         => $request->get('blog_category_is_active'),
                'blog_image_card_url'             => $getFile->move($getDestinationPath, $getFileName),
            ]);
            return response([
                'title'              => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_title'),
                'notify_code'        => 'INFO_00002',
                'description'        => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_super_admin', [
                    'record'         => $apiUpdateSingleRecord['blog_category_title'],
                    'databaseName'   => config('database.connections.mysql.database'),
                    'tableName'      => $this->tableNameBlogCategory
                ]),
                'reference'          => $this->modelNameErrorSystem::where('notify_code', '=', 'INFO_00002')->pluck('notify_reference')[0],
                'api_endpoint'       => $_SERVER['REQUEST_URI'],
                'http_response'      => [
                    'code'           => 201,
                    'general_message'=> 'The HTTP 201 Created success status response code indicates that the request has succeeded and has led to the creation of a resource.',
                    'url'            => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/201',
                ],
                'records'            => $apiUpdateSingleRecord,
            ], 201);
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02')
            {
                return response([
                    'title'              => __('error_and_notification_system.update.err_00001_notify.user_has_rights.message_title'),
                    'notify_code'        => 'ERR_00001',
                    'description'        => __('error_and_notification_system.update.err_00001_notify.user_has_rights.message_super_admin', [
                        'methodName'     => $_SERVER['REQUEST_METHOD'],
                        'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                        'serviceName' => __NAMESPACE__ . '\\' . basename(BlogCategorySystemController::class) . '.php',
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function displayBlogSubcategories()
    {
        try
        {
            $apiDisplayAllRecords = $this->modelNameBlogSubcategory->select(
                                        'id',
                                        'blog_category_id',
                                        'blog_subcategory_title',
                                        'blog_subcategory_is_active',
                                        'blog_subcategory_path',
                                        'created_at',
                                    )
                                    ->with([
                                        'blog_category' => function ($query) {
                                            $query->select('id', 'blog_category_title');
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
                        'serviceName' => __NAMESPACE__ . '\\' . basename(BlogCategorySystemController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => $this->tableNameBlogCategory
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
                        'tableName'      => $this->tableNameBlogCategory
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
                        'serviceName' => __NAMESPACE__ . '\\' . basename(BlogCategorySystemController::class) . '.php',
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
    public function createSubcategory(Request $request)
    {
        try
        {
            $request->validate([
                'blog_category_id'                   => 'required',
                'blog_subcategory_title'             => 'required|regex:/^[a-zA-Z_ ]+$/u|max:255',
                'blog_subcategory_is_active'         => 'required',
                // 'blog_subcategory_path'              => 'required|max:255',
            ]);
            $getLastInsertedRecord = $this->modelNameBlogSubcategory->select('id')->get()->last()->toArray()['id'];
            if ($request->get('blog_category_id') === 1)
            {
                $apiInsertSingleRecord = $this->modelNameBlogSubcategory->create([
                    'blog_category_id'                   => $request->get('blog_category_id'),
                    'blog_subcategory_title'             => $request->get('blog_subcategory_title'),
                    'blog_subcategory_short_description' => $request->get('blog_subcategory_short_description'),
                    'blog_subcategory_is_active'         => $request->get('blog_subcategory_is_active'),
                    'blog_subcategory_path'              => '/blog/subcategory/' . ($getLastInsertedRecord + 1) . '/all-written-articles',
                ]);
            }
            elseif ($request->get('blog_category_id') === 2)
            {
                $apiInsertSingleRecord = $this->modelNameBlogSubcategory->create([
                    'blog_category_id'                   => $request->get('blog_category_id'),
                    'blog_subcategory_title'             => $request->get('blog_subcategory_title'),
                    'blog_subcategory_short_description' => $request->get('blog_subcategory_short_description'),
                    'blog_subcategory_is_active'         => $request->get('blog_subcategory_is_active'),
                    'blog_subcategory_path'              => '/blog/subcategory/' . ($getLastInsertedRecord + 1) . '/all-audio-articles',
                ]);
            }
            else
            {
                $apiInsertSingleRecord = $this->modelNameBlogSubcategory->create([
                    'blog_category_id'                   => $request->get('blog_category_id'),
                    'blog_subcategory_title'             => $request->get('blog_subcategory_title'),
                    'blog_subcategory_short_description' => $request->get('blog_subcategory_short_description'),
                    'blog_subcategory_is_active'         => $request->get('blog_subcategory_is_active'),
                    'blog_subcategory_path'              => '/blog/subcategory/' . ($getLastInsertedRecord + 1) . '/all-video-articles',
                ]);
            }
            return response([
                'title'              => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_title'),
                'notify_code'        => 'INFO_00002',
                'description'        => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_super_admin', [
                    'record'         => $apiInsertSingleRecord['blog_subcategory_title'],
                    'databaseName'   => config('database.connections.mysql.database'),
                    'tableName'      => $this->tableNameBlogSubcategory
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
                        'tableName'      => 'blog_subcategories',
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editSubcategory(Request $request, $id)
    {
        try
        {
            $request->validate([
                'blog_category_id'                   => 'required',
                'blog_subcategory_title'             => 'required|regex:/^[a-zA-Z_ ]+$/u|max:255',
                'blog_subcategory_is_active'         => 'required',
                // 'blog_subcategory_path'              => 'required|max:255',
            ]);
            $apiDisplaySingleRecord = $this->modelNameBlogSubcategory->find($id);
            if ($request->get('blog_category_id') === 1)
            {
                $apiUpdateSingleRecord = $this->modelNameBlogSubcategory->where('id', '=', $apiDisplaySingleRecord->id)->update([
                    'blog_category_id'                   => $request->get('blog_category_id'),
                    'blog_subcategory_title'             => $request->get('blog_subcategory_title'),
                    'blog_subcategory_short_description' => $request->get('blog_subcategory_short_description'),
                    'blog_subcategory_is_active'         => $request->get('blog_subcategory_is_active'),
                    'blog_subcategory_path'              => '/blog/subcategory/' . $apiDisplaySingleRecord->id . '/all-written-articles',
                ]);
            }
            elseif ($request->get('blog_category_id') === 2)
            {
                $apiUpdateSingleRecord = $this->modelNameBlogSubcategory->where('id', '=', $apiDisplaySingleRecord->id)->update([
                    'blog_category_id'                   => $request->get('blog_category_id'),
                    'blog_subcategory_title'             => $request->get('blog_subcategory_title'),
                    'blog_subcategory_short_description' => $request->get('blog_subcategory_short_description'),
                    'blog_subcategory_is_active'         => $request->get('blog_subcategory_is_active'),
                    'blog_subcategory_path'              => '/blog/subcategory/' . $apiDisplaySingleRecord->id . '/all-audio-articles',
                ]);
            }
            else
            {
                $apiUpdateSingleRecord = $this->modelNameBlogSubcategory->where('id', '=', $apiDisplaySingleRecord->id)->update([
                    'blog_category_id'                   => $request->get('blog_category_id'),
                    'blog_subcategory_title'             => $request->get('blog_subcategory_title'),
                    'blog_subcategory_short_description' => $request->get('blog_subcategory_short_description'),
                    'blog_subcategory_is_active'         => $request->get('blog_subcategory_is_active'),
                    'blog_subcategory_path'              => '/blog/subcategory/' . $apiDisplaySingleRecord->id . '/all-video-articles',
                ]);
            }
            return response([
                'title'              => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_title'),
                'notify_code'        => 'INFO_00002',
                'description'        => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_super_admin', [
                    'record'         => $apiDisplaySingleRecord->blog_subcategory_title,
                    'databaseName'   => config('database.connections.mysql.database'),
                    'tableName'      => $this->tableNameBlogSubcategory
                ]),
                'reference'          => $this->modelNameErrorSystem::where('notify_code', '=', 'INFO_00002')->pluck('notify_reference')[0],
                'api_endpoint'       => $_SERVER['REQUEST_URI'],
                'http_response'      => [
                    'code'           => 201,
                    'general_message'=> 'The HTTP 201 Created success status response code indicates that the request has succeeded and has led to the creation of a resource.',
                    'url'            => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/201',
                ],
                'records'            => [],
            ], 201);
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02')
            {
                return response([
                    'title'              => __('error_and_notification_system.update.err_00001_notify.user_has_rights.message_title'),
                    'notify_code'        => 'ERR_00001',
                    'description'        => __('error_and_notification_system.update.err_00001_notify.user_has_rights.message_super_admin', [
                        'methodName'     => $_SERVER['REQUEST_METHOD'],
                        'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                        'serviceName' => __NAMESPACE__ . '\\' . basename(BlogCategorySystemController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => 'blog_subcategories',
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteSubcategory($id)
    {
        try
        {
            $apiDisplayAllRecords = $this->modelNameBlogSubcategory->select('id')->get();
            $apiDisplaySingleRecord = $this->modelNameBlogSubcategory->find($id);
            if ($apiDisplayAllRecords->isEmpty())
            {
                return response([
                    'title'              => __('error_and_notification_system.delete.war_00001_notify.user_has_rights.message_title'),
                    'notify_code'        => 'WAR_00001',
                    'description'        => __('error_and_notification_system.delete.war_00001_notify.user_has_rights.message_super_admin', [
                        'methodName'     => $_SERVER['REQUEST_METHOD'],
                        'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                        'serviceName' => __NAMESPACE__ . '\\' . basename(BlogCategorySystemController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => $this->tableNameBlogSubcategory
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
                if (is_null($apiDisplaySingleRecord))
                {
                    return response([
                        'title'              => __('error_and_notification_system.delete.info_00006_notify.user_has_rights.message_title'),
                        'notify_code'        => 'INFO_00006',
                        'description'        => __('error_and_notification_system.delete.info_00006_notify.user_has_rights.message_super_admin', [
                            'methodName'     => $_SERVER['REQUEST_METHOD'],
                            'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                            'serviceName' => __NAMESPACE__ . '\\' . basename(BlogCategorySystemController::class) . '.php',
                            'databaseName'   => config('database.connections.mysql.database'),
                            'tableName'      => $this->tableNameBlogSubcategory,
                            'lookupRecord'   => $id,
                        ]),
                        'reference'          => $this->modelNameErrorSystem::where('notify_code', '=', 'INFO_00006')->pluck('notify_reference')[0],
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
                    $apiDeleteSingleRecord = $this->modelNameBlogSubcategory->find($id)->delete();
                    return response([
                        'title'              => __('error_and_notification_system.delete.info_00002_notify.user_has_rights.message_title'),
                        'notify_code'        => 'INFO_00002',
                        'description'        => __('error_and_notification_system.delete.info_00002_notify.user_has_rights.message_super_admin', [
                            'record'         => $apiDisplaySingleRecord['blog_subcategory_title'],
                            'databaseName'   => config('database.connections.mysql.database'),
                            'tableName'      => $this->tableNameBlogSubcategory
                        ]),
                        'reference'          => $this->modelNameErrorSystem::where('notify_code', '=', 'INFO_00002')->pluck('notify_reference')[0],
                        'api_endpoint'       => $_SERVER['REQUEST_URI'],
                        'http_response'      => [
                            'code'           => 200,
                            'general_message'=> 'The HTTP 200 OK success status response code indicates that the request has succeeded. A 200 response is cacheable by default.',
                            'url'            => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/200',
                        ],
                        'records'            => $apiDisplaySingleRecord,
                    ], 200);
                }
            }
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02')
            {
                return response([
                    'title'              => __('error_and_notification_system.delete.err_00001_notify.user_has_rights.message_title'),
                    'notify_code'        => 'ERR_00001',
                    'description'        => __('error_and_notification_system.delete.err_00001_notify.user_has_rights.message_super_admin', [
                        'methodName'     => $_SERVER['REQUEST_METHOD'],
                        'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                        'serviceName' => __NAMESPACE__ . '\\' . basename(BlogCategorySystemController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => 'blog_subcategories',
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
