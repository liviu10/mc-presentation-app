<?php

namespace App\Http\Controllers\Admin\HomeSystem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\NewsletterCampaign;
use App\Models\ErrorAndNotificationSystem;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class NewsletterCampaignSystemController extends Controller
{
    protected $modelNameNewsletterCampaign;
    protected $tableNameNewsletterCampaign;
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
        $this->modelNameNewsletterCampaign = new NewsletterCampaign();
        $this->modelNameErrorSystem        = new ErrorAndNotificationSystem();
        $this->modelNameLog                = new Log();
        $this->tableNameNewsletterCampaign = $this->modelNameNewsletterCampaign->getTable();
        $this->tableNameErrorSystem        = $this->modelNameErrorSystem->getTable();
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
            $apiDisplayAllRecords = $this->modelNameNewsletterCampaign->all();
            if ($apiDisplayAllRecords->isEmpty())
            {
                return response([
                    'title'              => __('error_and_notification_system.index.war_00001_notify.user_has_rights.message_title'),
                    'notify_code'        => 'WAR_00001',
                    'description'        => __('error_and_notification_system.index.war_00001_notify.user_has_rights.message_super_admin', [
                        'methodName'     => $_SERVER['REQUEST_METHOD'],
                        'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                        'serviceName' => __NAMESPACE__ . '\\' . basename(NewsletterCampaignSystemController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => $this->tableNameNewsletterCampaign
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
                        'tableName'      => $this->tableNameNewsletterCampaign
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
                        'serviceName' => __NAMESPACE__ . '\\' . basename(NewsletterCampaignSystemController::class) . '.php',
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            $request->validate([
                'campaign_name'        => 'required|regex:/^[a-zA-Z0-9_ ]+$/u|max:255',
                'campaign_description' => 'required|max:255',
                'campaign_is_active'   => 'required|max:255',
                'valid_from'           => 'required|max:255',
                'valid_to'             => 'required|max:255',
                'occur_times'          => 'required|min:1',
                'occur_when'           => 'required|max:255',
                'occur_day'            => 'required|max:255',
                'occur_hour'           => 'required|max:255',
            ]);
            $apiInsertSingleRecord = $this->modelNameNewsletterCampaign
                                        ->create([
                                            'campaign_name'        => $request->get('campaign_name'),
                                            'campaign_description' => $request->get('campaign_description'),
                                            'campaign_is_active'   => $request->get('campaign_is_active'),
                                            'valid_from'           => $request->get('valid_from'),
                                            'valid_to'             => $request->get('valid_to'),
                                            'occur_times'          => $request->get('occur_times'),
                                            'occur_when'           => $request->get('occur_when'),
                                            'occur_day'            => $request->get('occur_day'),
                                            'occur_hour'           => $request->get('occur_hour'),
                                        ]);
            $this->modelNameNewsletterCampaign->find($apiInsertSingleRecord->id)->log()->create([
                'status'             => 'Create',
                'status_description' => Auth::user()->name . ' has just created the following newsletter campaign: ' . $request->get('campaign_name') . '. To view this please go to newsletter settings.',
                'request_details'    => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_super_admin', [
                    'record'         => $apiInsertSingleRecord->id,
                    'databaseName'   => config('database.connections.mysql.database'),
                    'tableName'      => $this->tableNameNewsletterCampaign,
                ]),
                'response_details'   => 'The HTTP 201 Created success status response code indicates that the request has succeeded and has led to the creation of a resource.',
            ]);

            return response([
                'title'              => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_title'),
                'notify_code'        => 'INFO_00002',
                'description'        => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_super_admin', [
                    'record'         => $request->get('campaign_name'),
                    'databaseName'   => config('database.connections.mysql.database'),
                    'tableName'      => $this->tableNameNewsletterCampaign
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
                        'serviceName' => __NAMESPACE__ . '\\' . basename(NewsletterCampaignSystemController::class) . '.php',
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try
        {
            $request->validate([
                'campaign_name'        => 'required|regex:/^[a-zA-Z0-9_ ]+$/u|max:255',
                'campaign_description' => 'required|max:255',
                'campaign_is_active'   => 'required|max:255',
                'valid_from'           => 'required|max:255',
                'valid_to'             => 'required|max:255',
                'occur_times'          => 'required|min:1',
                'occur_when'           => 'required|max:255',
                'occur_day'            => 'required|max:255',
                'occur_hour'           => 'required|max:255',
            ]);
            $apiUpdateSingleRecord = $this->modelNameNewsletterCampaign->find($id);
            $apiUpdateSingleRecord->update([
                'campaign_name'        => $request->get('campaign_name'),
                'campaign_description' => $request->get('campaign_description'),
                'campaign_is_active'   => $request->get('campaign_is_active'),
                'valid_from'           => $request->get('valid_from'),
                'valid_to'             => $request->get('valid_to'),
                'occur_times'          => $request->get('occur_times'),
                'occur_when'           => $request->get('occur_when'),
                'occur_day'            => $request->get('occur_day'),
                'occur_hour'           => $request->get('occur_hour'),
            ]);
            $this->modelNameNewsletterCampaign->find($apiUpdateSingleRecord->id)->log()->create([
                'status'             => 'Update',
                'status_description' => Auth::user()->name . ' has just updated the following newsletter campaign: ' . $request->get('campaign_name') . '. To view this please go to newsletter settings.',
                'request_details'    => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_super_admin', [
                    'record'         => $apiUpdateSingleRecord->id,
                    'databaseName'   => config('database.connections.mysql.database'),
                    'tableName'      => $this->tableNameNewsletterCampaign,
                ]),
                'response_details'   => 'The HTTP 201 Created success status response code indicates that the request has succeeded and has led to the creation of a resource.',
            ]);

            return response([
                'title'              => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_title'),
                'notify_code'        => 'INFO_00002',
                'description'        => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_super_admin', [
                    'record'         => $request->get('campaign_name'),
                    'databaseName'   => config('database.connections.mysql.database'),
                    'tableName'      => $this->tableNameNewsletterCampaign
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
                        'serviceName' => __NAMESPACE__ . '\\' . basename(NewsletterCampaignSystemController::class) . '.php',
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $apiDisplayAllRecords = $this->modelNameNewsletterCampaign->select('id')->get();
            $apiDisplaySingleRecord = $this->modelNameNewsletterCampaign->find($id);
            if ($apiDisplayAllRecords->isEmpty())
            {
                return response([
                    'title'              => __('error_and_notification_system.delete.war_00001_notify.user_has_rights.message_title'),
                    'notify_code'        => 'WAR_00001',
                    'description'        => __('error_and_notification_system.delete.war_00001_notify.user_has_rights.message_super_admin', [
                        'methodName'     => $_SERVER['REQUEST_METHOD'],
                        'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                        'serviceName' => __NAMESPACE__ . '\\' . basename(NewsletterCampaignSystemController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => $this->tableNameNewsletterCampaign
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
                            'serviceName' => __NAMESPACE__ . '\\' . basename(NewsletterCampaignSystemController::class) . '.php',
                            'databaseName'   => config('database.connections.mysql.database'),
                            'tableName'      => $this->tableNameNewsletterCampaign,
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
                    $this->modelNameNewsletterCampaign->find($apiDisplaySingleRecord['id'])->log()->create([
                        'status'             => 'Delete',
                        'status_description' => Auth::user()->name . ' has just deleted the following newsletter campaign: ' . $apiDisplaySingleRecord['campaign_name'] . '. You can recover this by going to the newsletter settings.',
                        'request_details'    => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_super_admin', [
                            'record'         => $apiDisplaySingleRecord['id'],
                            'databaseName'   => config('database.connections.mysql.database'),
                            'tableName'      => $this->tableNameNewsletterCampaign,
                        ]),
                        'response_details'   => 'The HTTP 201 Created success status response code indicates that the request has succeeded and has led to the creation of a resource.',
                    ]);
                    $apiDeleteSingleRecord = $this->modelNameNewsletterCampaign->find($id)->delete();

                    return response([
                        'title'              => __('error_and_notification_system.delete.info_00002_notify.user_has_rights.message_title'),
                        'notify_code'        => 'INFO_00002',
                        'description'        => __('error_and_notification_system.delete.info_00002_notify.user_has_rights.message_super_admin', [
                            'record'         => $apiDisplaySingleRecord['campaign_name'],
                            'databaseName'   => config('database.connections.mysql.database'),
                            'tableName'      => $this->tableNameNewsletterCampaign
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
                        'serviceName' => __NAMESPACE__ . '\\' . basename(NewsletterCampaignSystemController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => 'newsletter_campaigns',
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

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteAllCampaigns()
    {
        try
        {
            $apiDisplayAllRecords = $this->modelNameNewsletterCampaign->all();
            if ($apiDisplayAllRecords->isEmpty())
                {
                    return response([
                        'title'              => __('error_and_notification_system.delete_all.war_00001_notify.user_has_rights.message_title'),
                        'notify_code'        => 'WAR_00001',
                        'description'        => __('error_and_notification_system.delete_all.war_00001_notify.user_has_rights.message_super_admin', [
                            'methodName'     => $_SERVER['REQUEST_METHOD'],
                            'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                            'serviceName' => __NAMESPACE__ . '\\' . basename(NewsletterCampaignSystemController::class) . '.php',
                            'databaseName'   => config('database.connections.mysql.database'),
                            'tableName'      => $this->tableNameNewsletterCampaign
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
                    $apiDeleteSingleRecord = $this->modelNameNewsletterCampaign->truncate();
                    DB::statement('SET FOREIGN_KEY_CHECKS=1;');

                    return response([
                        'title'              => __('error_and_notification_system.delete_all.info_00004_notify.user_has_rights.message_title'),
                        'notify_code'        => 'INFO_00004',
                        'description'        => __('error_and_notification_system.delete_all.info_00004_notify.user_has_rights.message_super_admin', [
                            'databaseName'   => config('database.connections.mysql.database'),
                            'tableName'      => $this->tableNameNewsletterCampaign
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
                        'serviceName' => __NAMESPACE__ . '\\' . basename(NewsletterCampaignSystemController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => 'newsletter_campaigns',
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
