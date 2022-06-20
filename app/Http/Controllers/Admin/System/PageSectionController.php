<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PageSection;
use App\Models\PageSectionCarousel;
use App\Models\PageSectionJumbotron;
use App\Models\PageSectionTestimonial;
use App\Models\PageSectionFooter;
use App\Models\ErrorAndNotificationSystem;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class PageSectionController extends Controller
{
    protected $modelNamePageSection;
    protected $tableNamePageSection;
    protected $modelNamePageCarouselSection;
    protected $tableNamePageCarouselSection;
    protected $modelNamePageJumbotronSection;
    protected $tableNamePageJumbotronSection;
    protected $modelNamePageTestimonialSection;
    protected $tableNamePageTestimonialSection;
    protected $modelNamePageFooterSection;
    protected $tableNamePageFooterSection;
    protected $modelNameErrorSystem;
    protected $modelNameLog;
    protected $tableNameErrorSystem;

    /**
     * Instantiate the variables that will be used to get the model and table name as well as the table's columns.
     *
     * @return Collection|String
     */
    public function __construct()
    {
        $this->modelNamePageSection            = new PageSection();
        $this->modelNamePageCarouselSection    = new PageSectionCarousel();
        $this->modelNamePageJumbotronSection   = new PageSectionJumbotron();
        $this->modelNamePageTestimonialSection = new PageSectionTestimonial();
        $this->modelNamePageFooterSection      = new PageSectionFooter();
        $this->modelNameErrorSystem            = new ErrorAndNotificationSystem();
        $this->modelNameLog                    = new Log();
        $this->tableNamePageSection            = $this->modelNamePageSection->getTable();
        $this->tableNamePageCarouselSection    = $this->modelNamePageCarouselSection->getTable();
        $this->tableNamePageJumbotronSection   = $this->modelNamePageJumbotronSection->getTable();
        $this->tableNamePageTestimonialSection = $this->modelNamePageTestimonialSection->getTable();
        $this->tableNamePageFooterSection      = $this->modelNamePageFooterSection->getTable();
        $this->tableNameErrorSystem            = $this->modelNameErrorSystem->getTable();
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
     * Display the carousel section.
     *
     * @return \Illuminate\Http\Response
     */
    public function displayCarouselSection()
    {
        try
        {
            $apiDisplayAllRecords = $this->modelNamePageSection->select('id', 'section_name', 'section_slug')
                                    ->with([
                                        'page_section_carousel' => function ($query) {
                                            $query->select(
                                                'id',
                                                'page_section_id',
                                                'image_path',
                                                'caption_text_1',
                                                'caption_text_2',
                                                'caption_text_3',
                                                'caption_text_4',
                                                'button_label',
                                                'link_to_blog_article'
                                            );
                                        },
                                    ])
                                    ->where('id', '=', 1)
                                    ->get();
            if ($apiDisplayAllRecords->isEmpty())
            {
                return response([
                    'title'              => __('error_and_notification_system.index.war_00001_notify.user_has_rights.message_title'),
                    'notify_code'        => 'WAR_00001',
                    'description'        => __('error_and_notification_system.index.war_00001_notify.user_has_rights.message_super_admin', [
                        'methodName'     => $_SERVER['REQUEST_METHOD'],
                        'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                        'serviceName' => __NAMESPACE__ . '\\' . basename(PageSectionController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => $this->tableNamePageSection
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
                        'tableName'      => $this->tableNamePageSection
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
                        'serviceName' => __NAMESPACE__ . '\\' . basename(PageSectionController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => 'newsletter_campaigns',
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
     * Create a new carousel section.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createCarouselSection(Request $request)
    {
        try
        {
            $request->validate([
                'image_path'           => 'required|max:255',
                'caption_text_1'       => 'required',
                'caption_text_2'       => 'required',
                'caption_text_3'       => 'required',
                'caption_text_4'       => 'required',
                'button_label'         => 'required|max:50',
                'link_to_blog_article' => 'required|max:255',
            ]);
            $apiInsertSingleRecord = $this->modelNamePageCarouselSection
                                        ->create([
                                            'page_section_id'      => 1,
                                            'image_path'           => $request->get('image_path'),
                                            'caption_text_1'       => $request->get('caption_text_1'),
                                            'caption_text_2'       => $request->get('caption_text_2'),
                                            'caption_text_3'       => $request->get('caption_text_3'),
                                            'caption_text_4'       => $request->get('caption_text_4'),
                                            'button_label'         => $request->get('button_label'),
                                            'link_to_blog_article' => $request->get('link_to_blog_article'),
                                        ]);
            $this->modelNamePageCarouselSection->find($apiInsertSingleRecord->id)->log()->create([
                'status'             => 'Create',
                'status_description' => Auth::user()->name . ' has just created a new user carousel section. To view this please go to user home page.',
                'request_details'    => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_super_admin', [
                    'record'         => $apiInsertSingleRecord->id,
                    'databaseName'   => config('database.connections.mysql.database'),
                    'tableName'      => $this->tableNamePageCarouselSection,
                ]),
                'response_details'   => 'The HTTP 201 Created success status response code indicates that the request has succeeded and has led to the creation of a resource.',
            ]);

            return response([
                'title'              => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_title'),
                'notify_code'        => 'INFO_00002',
                'description'        => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_super_admin', [
                    'record'         => $request->get('campaign_name'),
                    'databaseName'   => config('database.connections.mysql.database'),
                    'tableName'      => $this->tableNamePageCarouselSection
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
                        'serviceName' => __NAMESPACE__ . '\\' . basename(PageSectionController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => 'newsletter_campaigns',
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
     * Update the carousel section.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCarouselSection(Request $request, $id)
    {
        try
        {
            $request->validate([
                'image_path'           => 'required|max:255',
                'caption_text_1'       => 'required',
                'caption_text_2'       => 'required',
                'caption_text_3'       => 'required',
                'caption_text_4'       => 'required',
                'button_label'         => 'required|max:50',
                'link_to_blog_article' => 'required|max:255',
            ]);
            $apiUpdateSingleRecord = $this->modelNamePageCarouselSection->find($id);
            $apiUpdateSingleRecord->update([
                'page_section_id'      => 1,
                'image_path'           => $request->get('image_path'),
                'caption_text_1'       => $request->get('caption_text_1'),
                'caption_text_2'       => $request->get('caption_text_2'),
                'caption_text_3'       => $request->get('caption_text_3'),
                'caption_text_4'       => $request->get('caption_text_4'),
                'button_label'         => $request->get('button_label'),
                'link_to_blog_article' => $request->get('link_to_blog_article'),
            ]);
            $this->modelNamePageCarouselSection->find($apiUpdateSingleRecord->id)->log()->create([
                'status'             => 'Update',
                'status_description' => Auth::user()->name . ' has just updated the user carousel section. To view this please go to user home page.',
                'request_details'    => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_super_admin', [
                    'record'         => $apiUpdateSingleRecord->id,
                    'databaseName'   => config('database.connections.mysql.database'),
                    'tableName'      => $this->tableNamePageCarouselSection,
                ]),
                'response_details'   => 'The HTTP 201 Created success status response code indicates that the request has succeeded and has led to the creation of a resource.',
            ]);

            return response([
                'title'              => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_title'),
                'notify_code'        => 'INFO_00002',
                'description'        => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_super_admin', [
                    'record'         => $request->get('campaign_name'),
                    'databaseName'   => config('database.connections.mysql.database'),
                    'tableName'      => $this->tableNamePageCarouselSection
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
                        'serviceName' => __NAMESPACE__ . '\\' . basename(PageSectionController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => 'error_and_notification_system',
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
     * Display the jumbotron section.
     *
     * @return \Illuminate\Http\Response
     */
    public function displayJumbotronSection()
    {
        try
        {
            $apiDisplayAllRecords = $this->modelNamePageSection->select('id', 'section_name', 'section_slug')
                                    ->with([
                                        'page_section_jumbotron' => function ($query) {
                                            $query->select(
                                                'id',
                                                'page_section_id',
                                                'description',
                                                'button_label',
                                                'button_url',
                                                'label_for_social_media_1',
                                                'link_to_social_media_1',
                                                'label_for_social_media_2',
                                                'button_label',
                                                'link_to_social_media_2'
                                            );
                                        },
                                    ])
                                    ->where('id', '=', 2)
                                    ->get();
            if ($apiDisplayAllRecords->isEmpty())
            {
                return response([
                    'title'              => __('error_and_notification_system.index.war_00001_notify.user_has_rights.message_title'),
                    'notify_code'        => 'WAR_00001',
                    'description'        => __('error_and_notification_system.index.war_00001_notify.user_has_rights.message_super_admin', [
                        'methodName'     => $_SERVER['REQUEST_METHOD'],
                        'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                        'serviceName' => __NAMESPACE__ . '\\' . basename(PageSectionController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => $this->tableNamePageCarouselSection
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
                        'tableName'      => $this->tableNamePageCarouselSection
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
                        'serviceName' => __NAMESPACE__ . '\\' . basename(PageSectionController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => 'newsletter_campaigns',
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
     * Create a new jumbotron section.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createJumbotronSection(Request $request)
    {
        try
        {
            $request->validate([
                'description'              => 'required',
                'button_label'             => 'required|max:50',
                'button_url'               => 'required|max:255',
                'label_for_social_media_1' => 'required|max:255',
                'link_to_social_media_1'   => 'required|max:255',
                'label_for_social_media_2' => 'required|max:255',
                'link_to_social_media_2'   => 'required|max:255',
            ]);
            $apiInsertSingleRecord = $this->modelNamePageJumbotronSection
                                        ->create([
                                            'page_section_id'          => 2,
                                            'description'              => $request->get('description'),
                                            'button_label'             => $request->get('button_label'),
                                            'button_url'               => $request->get('button_url'),
                                            'label_for_social_media_1' => $request->get('label_for_social_media_1'),
                                            'link_to_social_media_1'   => $request->get('link_to_social_media_1'),
                                            'label_for_social_media_2' => $request->get('label_for_social_media_2'),
                                            'link_to_social_media_2'   => $request->get('link_to_social_media_2'),
                                        ]);
            $this->modelNamePageJumbotronSection->find($apiInsertSingleRecord->id)->log()->create([
                'status'             => 'Create',
                'status_description' => Auth::user()->name . ' has just created a new user jumbotron section. To view this please go to user home page.',
                'request_details'    => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_super_admin', [
                    'record'         => $apiInsertSingleRecord->id,
                    'databaseName'   => config('database.connections.mysql.database'),
                    'tableName'      => $this->tableNameJumbotronSection,
                ]),
                'response_details'   => 'The HTTP 201 Created success status response code indicates that the request has succeeded and has led to the creation of a resource.',
            ]);

            return response([
                'title'              => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_title'),
                'notify_code'        => 'INFO_00002',
                'description'        => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_super_admin', [
                    'record'         => $request->get('campaign_name'),
                    'databaseName'   => config('database.connections.mysql.database'),
                    'tableName'      => $this->tableNameJumbotronSection
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
                        'serviceName' => __NAMESPACE__ . '\\' . basename(PageSectionController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => 'newsletter_campaigns',
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
     * Update the jumbotron section.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateJumbotronSection(Request $request, $id)
    {
        try
        {
            $request->validate([
                'description'              => 'required',
                'button_label'             => 'required|max:50',
                'button_url'               => 'required|max:255',
                'label_for_social_media_1' => 'required|max:255',
                'link_to_social_media_1'   => 'required|max:255',
                'label_for_social_media_2' => 'required|max:255',
                'link_to_social_media_2'   => 'required|max:255',
            ]);
            $apiUpdateSingleRecord = $this->modelNamePageJumbotronSection->find($id);
            $apiUpdateSingleRecord->update([
                'page_section_id'          => 2,
                'description'              => $request->get('description'),
                'button_label'             => $request->get('button_label'),
                'button_url'               => $request->get('button_url'),
                'label_for_social_media_1' => $request->get('label_for_social_media_1'),
                'link_to_social_media_1'   => $request->get('link_to_social_media_1'),
                'label_for_social_media_2' => $request->get('label_for_social_media_2'),
                'link_to_social_media_2'   => $request->get('link_to_social_media_2'),
            ]);
            $this->modelNamePageJumbotronSection->find($apiUpdateSingleRecord->id)->log()->create([
                'status'             => 'Update',
                'status_description' => Auth::user()->name . ' has just updated the user jumbotron section. To view this please go to user home page.',
                'request_details'    => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_super_admin', [
                    'record'         => $apiUpdateSingleRecord->id,
                    'databaseName'   => config('database.connections.mysql.database'),
                    'tableName'      => $this->tableNamePageJumbotronSection,
                ]),
                'response_details'   => 'The HTTP 201 Created success status response code indicates that the request has succeeded and has led to the creation of a resource.',
            ]);

            return response([
                'title'              => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_title'),
                'notify_code'        => 'INFO_00002',
                'description'        => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_super_admin', [
                    'record'         => $request->get('campaign_name'),
                    'databaseName'   => config('database.connections.mysql.database'),
                    'tableName'      => $this->tableNamePageJumbotronSection
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
                        'serviceName' => __NAMESPACE__ . '\\' . basename(PageSectionController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => 'error_and_notification_system',
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
     * Display the testimonial section.
     *
     * @return \Illuminate\Http\Response
     */
    public function displayTestimonialSection()
    {
        try
        {
            $apiDisplayAllRecords = $this->modelNamePageSection->select('id', 'section_name', 'section_slug')
                                    ->with([
                                        'page_section_testimonials' => function ($query) {
                                            $query->select(
                                                'id',
                                                'page_section_id',
                                                'name',
                                                'occupation',
                                                'description',
                                            );
                                        },
                                    ])
                                    ->where('id', '=', 3)
                                    ->get();
            if ($apiDisplayAllRecords->isEmpty())
            {
                return response([
                    'title'              => __('error_and_notification_system.index.war_00001_notify.user_has_rights.message_title'),
                    'notify_code'        => 'WAR_00001',
                    'description'        => __('error_and_notification_system.index.war_00001_notify.user_has_rights.message_super_admin', [
                        'methodName'     => $_SERVER['REQUEST_METHOD'],
                        'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                        'serviceName' => __NAMESPACE__ . '\\' . basename(PageSectionController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => $this->tableNamePageTestimonialSection
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
                        'tableName'      => $this->tableNamePageTestimonialSection
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
                        'serviceName' => __NAMESPACE__ . '\\' . basename(PageSectionController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => 'newsletter_campaigns',
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
     * Create a new testimonial section.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createTestimonialSection(Request $request)
    {
        try
        {
            $request->validate([
                'name'        => 'required|max:255',
                'occupation'  => 'required|max:255',
                'description' => 'required',
            ]);
            $apiInsertSingleRecord = $this->modelNamePageTestimonialSection
                                        ->create([
                                            'page_section_id' => 3,
                                            'name'            => $request->get('name'),
                                            'occupation'      => $request->get('occupation'),
                                            'description'     => $request->get('description'),
                                        ]);
            $this->modelNamePageTestimonialSection->find($apiInsertSingleRecord->id)->log()->create([
                'status'             => 'Create',
                'status_description' => Auth::user()->name . ' has just created a new user testimonial section. To view this please go to user home page.',
                'request_details'    => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_super_admin', [
                    'record'         => $apiInsertSingleRecord->id,
                    'databaseName'   => config('database.connections.mysql.database'),
                    'tableName'      => $this->tableNameTestimonialSection,
                ]),
                'response_details'   => 'The HTTP 201 Created success status response code indicates that the request has succeeded and has led to the creation of a resource.',
            ]);

            return response([
                'title'              => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_title'),
                'notify_code'        => 'INFO_00002',
                'description'        => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_super_admin', [
                    'record'         => $request->get('campaign_name'),
                    'databaseName'   => config('database.connections.mysql.database'),
                    'tableName'      => $this->tableNameTestimonialSection
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
                        'serviceName' => __NAMESPACE__ . '\\' . basename(PageSectionController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => 'newsletter_campaigns',
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
     * Update the testimonials section.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateTestimonialSection(Request $request, $id)
    {
        try
        {
            $request->validate([
                'name'        => 'required|max:255',
                'occupation'  => 'required|max:255',
                'description' => 'required',
            ]);
            $apiUpdateSingleRecord = $this->modelNamePageTestimonialSection->find($id);
            $apiUpdateSingleRecord->update([
                'page_section_id' => 3,
                'name'            => $request->get('name'),
                'occupation'      => $request->get('occupation'),
                'description'     => $request->get('description'),
            ]);
            $this->modelNamePageTestimonialSection->find($apiUpdateSingleRecord->id)->log()->create([
                'status'             => 'Update',
                'status_description' => Auth::user()->name . ' has just updated the user testimonial section. To view this please go to user home page.',
                'request_details'    => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_super_admin', [
                    'record'         => $apiUpdateSingleRecord->id,
                    'databaseName'   => config('database.connections.mysql.database'),
                    'tableName'      => $this->tableNamePageTestimonialSection,
                ]),
                'response_details'   => 'The HTTP 201 Created success status response code indicates that the request has succeeded and has led to the creation of a resource.',
            ]);

            return response([
                'title'              => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_title'),
                'notify_code'        => 'INFO_00002',
                'description'        => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_super_admin', [
                    'record'         => $request->get('campaign_name'),
                    'databaseName'   => config('database.connections.mysql.database'),
                    'tableName'      => $this->tableNamePageTestimonialSection
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
                        'serviceName' => __NAMESPACE__ . '\\' . basename(PageSectionController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => 'error_and_notification_system',
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
     * Display the footer section.
     *
     * @return \Illuminate\Http\Response
     */
    public function displayFooterSection()
    {
        try
        {
            $apiDisplayAllRecords = $this->modelNamePageSection->select('id', 'section_name', 'section_slug')
                                    ->with([
                                        'page_section_footer' => function ($query) {
                                            $query->select(
                                                'id',
                                                'page_section_id',
                                                'label_for_menu_1',
                                                'link_for_menu_1',
                                                'label_for_menu_2',
                                                'link_for_menu_2',
                                                'contact_email_address',
                                                'label_for_social_media',
                                                'label_for_social_media_1',
                                                'link_to_social_media_1',
                                                'label_for_social_media_2',
                                                'link_to_social_media_2',
                                                'copyright_caption',
                                                'copyright_caption_url',
                                            );
                                        },
                                    ])
                                    ->where('id', '=', 5)
                                    ->get();
            if ($apiDisplayAllRecords->isEmpty())
            {
                return response([
                    'title'              => __('error_and_notification_system.index.war_00001_notify.user_has_rights.message_title'),
                    'notify_code'        => 'WAR_00001',
                    'description'        => __('error_and_notification_system.index.war_00001_notify.user_has_rights.message_super_admin', [
                        'methodName'     => $_SERVER['REQUEST_METHOD'],
                        'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                        'serviceName' => __NAMESPACE__ . '\\' . basename(PageSectionController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => $this->tableNamePageFooterSection
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
                        'tableName'      => $this->tableNamePageFooterSection
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
                        'serviceName' => __NAMESPACE__ . '\\' . basename(PageSectionController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => 'newsletter_campaigns',
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
     * Create a new footer section.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createFooterSection(Request $request)
    {
        try
        {
            $request->validate([
                'label_for_menu_1'         => 'required|max:255',
                'link_for_menu_1'          => 'required|max:255',
                'label_for_menu_2'         => 'required|max:255',
                'link_for_menu_2'          => 'required|max:255',
                'contact_email_address'    => 'required|max:255',
                'label_for_social_media'   => 'required|max:255',
                'label_for_social_media_1' => 'required|max:255',
                'link_to_social_media_1'   => 'required|max:255',
                'label_for_social_media_2' => 'required|max:255',
                'link_to_social_media_2'   => 'required|max:255',
                'copyright_caption'        => 'required|max:255',
                'copyright_caption_url'    => 'required|max:255',
            ]);
            $apiInsertSingleRecord = $this->modelNamePageFooterSection
                                        ->create([
                                            'page_section_id' => 5,
                                            'label_for_menu_1'         => $request->get('label_for_menu_1'),
                                            'link_for_menu_1'          => $request->get('link_for_menu_1'),
                                            'label_for_menu_2'         => $request->get('label_for_menu_2'),
                                            'link_for_menu_2'          => $request->get('link_for_menu_2'),
                                            'contact_email_address'    => $request->get('contact_email_address'),
                                            'label_for_social_media'   => $request->get('label_for_social_media'),
                                            'label_for_social_media_1' => $request->get('label_for_social_media_1'),
                                            'link_to_social_media_1'   => $request->get('link_to_social_media_1'),
                                            'label_for_social_media_2' => $request->get('label_for_social_media_2'),
                                            'link_to_social_media_2'   => $request->get('link_to_social_media_2'),
                                            'copyright_caption'        => $request->get('copyright_caption'),
                                            'copyright_caption_url'    => $request->get('copyright_caption_url'),
                                        ]);
            $this->modelNamePageFooterSection->find($apiInsertSingleRecord->id)->log()->create([
                'status'             => 'Create',
                'status_description' => Auth::user()->name . ' has just created a new user footer section. To view this please go to user home page.',
                'request_details'    => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_super_admin', [
                    'record'         => $apiInsertSingleRecord->id,
                    'databaseName'   => config('database.connections.mysql.database'),
                    'tableName'      => $this->tableNameFooterSection,
                ]),
                'response_details'   => 'The HTTP 201 Created success status response code indicates that the request has succeeded and has led to the creation of a resource.',
            ]);

            return response([
                'title'              => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_title'),
                'notify_code'        => 'INFO_00002',
                'description'        => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_super_admin', [
                    'record'         => $request->get('campaign_name'),
                    'databaseName'   => config('database.connections.mysql.database'),
                    'tableName'      => $this->tableNameFooterSection
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
                        'serviceName' => __NAMESPACE__ . '\\' . basename(PageSectionController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => 'newsletter_campaigns',
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
     * Update the footer section.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateFooterSection(Request $request, $id)
    {
        try
        {
            $request->validate([
                'label_for_menu_1'         => 'required|max:255',
                'link_for_menu_1'          => 'required|max:255',
                'label_for_menu_2'         => 'required|max:255',
                'link_for_menu_2'          => 'required|max:255',
                'contact_email_address'    => 'required|max:255',
                'label_for_social_media'   => 'required|max:255',
                'label_for_social_media_1' => 'required|max:255',
                'link_to_social_media_1'   => 'required|max:255',
                'label_for_social_media_2' => 'required|max:255',
                'link_to_social_media_2'   => 'required|max:255',
                'copyright_caption'        => 'required|max:255',
                'copyright_caption_url'    => 'required|max:255',
            ]);
            $apiUpdateSingleRecord = $this->modelNamePageFooterSection->find($id);
            $apiUpdateSingleRecord->update([
                'page_section_id' => 5,
                'label_for_menu_1'         => $request->get('label_for_menu_1'),
                'link_for_menu_1'          => $request->get('link_for_menu_1'),
                'label_for_menu_2'         => $request->get('label_for_menu_2'),
                'link_for_menu_2'          => $request->get('link_for_menu_2'),
                'contact_email_address'    => $request->get('contact_email_address'),
                'label_for_social_media'   => $request->get('label_for_social_media'),
                'label_for_social_media_1' => $request->get('label_for_social_media_1'),
                'link_to_social_media_1'   => $request->get('link_to_social_media_1'),
                'label_for_social_media_2' => $request->get('label_for_social_media_2'),
                'link_to_social_media_2'   => $request->get('link_to_social_media_2'),
                'copyright_caption'        => $request->get('copyright_caption'),
                'copyright_caption_url'    => $request->get('copyright_caption_url'),
            ]);
            $this->modelNamePageFooterSection->find($apiUpdateSingleRecord->id)->log()->create([
                'status'             => 'Update',
                'status_description' => Auth::user()->name . ' has just updated the user footer section. To view this please go to user home page.',
                'request_details'    => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_super_admin', [
                    'record'         => $apiUpdateSingleRecord->id,
                    'databaseName'   => config('database.connections.mysql.database'),
                    'tableName'      => $this->tableNamePageFooterSection,
                ]),
                'response_details'   => 'The HTTP 201 Created success status response code indicates that the request has succeeded and has led to the creation of a resource.',
            ]);

            return response([
                'title'              => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_title'),
                'notify_code'        => 'INFO_00002',
                'description'        => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_super_admin', [
                    'record'         => $request->get('campaign_name'),
                    'databaseName'   => config('database.connections.mysql.database'),
                    'tableName'      => $this->tableNamePageFooterSection
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
                        'serviceName' => __NAMESPACE__ . '\\' . basename(PageSectionController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => 'error_and_notification_system',
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
}
