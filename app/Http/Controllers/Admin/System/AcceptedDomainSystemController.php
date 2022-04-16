<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AcceptedDomain;
use App\Models\ErrorAndNotificationSystem;

class AcceptedDomainSystemController extends Controller
{
    protected $modelNameAcceptedDomain;
    protected $modelNameErrorSystem;
    protected $tableNameAcceptedDomain;
    protected $tableNameErrorSystem;

    /**
     * Instantiate the variables that will be used to get the model and table name as well as the table's columns.
     *
     * @return Collection|String
     */
    public function __construct()
    {
        $this->modelNameAcceptedDomain  = new AcceptedDomain();
        $this->modelNameErrorSystem     = new ErrorAndNotificationSystem();
        $this->tableNameAcceptedDomain  = $this->modelNameAcceptedDomain->getTable();
        $this->tableNameErrorSystem     = $this->modelNameErrorSystem->getTable();
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
            $apiDisplayAllRecords = $this->modelNameAcceptedDomain->select('id', 'domain', 'type')->get();
            if ($apiDisplayAllRecords->isEmpty())
            {
                return response([
                    'title'              => __('error_and_notification_system.index.war_00001_notify.user_has_rights.message_title'),
                    'notify_code'        => 'WAR_00001',
                    'description'        => __('error_and_notification_system.index.war_00001_notify.user_has_rights.message_super_admin', [
                        'methodName'     => $_SERVER['REQUEST_METHOD'],
                        'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                        'serviceName' => __NAMESPACE__ . '\\' . basename(AcceptedDomainSystemController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => $this->tableNameAcceptedDomain
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
                        'tableName'      => $this->tableNameAcceptedDomain
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
                        'serviceName' => __NAMESPACE__ . '\\' . basename(AcceptedDomainSystemController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => 'accepted_domains',
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
                'domain' => 'required|max:50',
                'type'   => 'required|max:50',
            ]);
            if (substr($request->get('domain'), 0, 1) !== '.')
            {
                $apiInsertSingleRecord = $this->modelNameAcceptedDomain->create([
                    'domain' => substr_replace(substr($request->get('domain'), 0, 1), '.', 0) . $request->get('domain'),
                    'type'   => $request->get('type'),
                ]);
            }
            else 
            {
                $apiInsertSingleRecord = $this->modelNameAcceptedDomain->create([
                    'domain' => $request->get('domain'),
                    'type'   => $request->get('type'),
                ]);
            }
            // $this->modelNameAcceptedDomain->find($apiInsertSingleRecord->id)->log()->create([ 
            //     'status'  => 'Admin create accepted domain',
            //     'details' => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_super_admin', [
            //         'record'         => $request->get('domain') . ' (id ' . $apiInsertSingleRecord->id . ')',
            //         'databaseName'   => config('database.connections.mysql.database'),
            //         'tableName'      => $this->tableNameAcceptedDomain
            //     ])
            // ]);
            return response([
                'title'              => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_title'),
                'notify_code'        => 'INFO_00002',
                'description'        => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_super_admin', [
                    'record'         => $apiInsertSingleRecord['domain'],
                    'databaseName'   => config('database.connections.mysql.database'),
                    'tableName'      => $this->tableNameAcceptedDomain
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
                        'serviceName' => __NAMESPACE__ . '\\' . basename(AcceptedDomainSystemController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => 'accepted_domains',
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
            if ($mysqlError->getCode() === '23000') 
            {
                return response([
                    'title'              => __('error_and_notification_system.store.err_00003_notify.user_has_rights.message_title'),
                    'notify_code'        => 'ERR_00003',
                    'description'        => __('error_and_notification_system.store.err_00003_notify.user_has_rights.message_super_admin', [
                        'methodName'     => $_SERVER['REQUEST_METHOD'],
                        'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                        'serviceName' => __NAMESPACE__ . '\\' . basename(AcceptedDomainSystemController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => 'accepted_domains',
                    ]),
                    'reference'          => config('app.url') . '/documentation/error#ERR_00001',
                    'api_endpoint'       => $_SERVER['REQUEST_URI'],
                    'http_response'      => [
                        'code'           => 406,
                        'general_message'=> 'The HyperText Transfer Protocol (HTTP) 406 Not Acceptable client error response code indicates that the server cannot produce a response matching the list of acceptable values defined in the request\'s proactive content negotiation headers, and that the server is unwilling to supply a default representation',
                        'url'            => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/406',
                    ],
                    'sql_response'       => [
                        'sql_err_code'   => $mysqlError->getCode(),
                        'sql_err_message'=> $mysqlError->getMessage(),
                        'sql_err_url'    => 'https://dev.mysql.com/doc/mysql-errors/8.0/en/server-error-reference.html#error_er_dup_entry'
                    ],
                    'records'            => [],
                ], 406);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try
        {
            $apiDisplayAllRecords = $this->modelNameAcceptedDomain->select('id')->get();
            $apiDisplaySingleRecord = $this->modelNameAcceptedDomain->find($id);
            if ($apiDisplayAllRecords->isEmpty())
            {
                return response([
                    'title'              => __('error_and_notification_system.show.war_00001_notify.user_has_rights.message_title'),
                    'notify_code'        => 'WAR_00001',
                    'description'        => __('error_and_notification_system.show.war_00001_notify.user_has_rights.message_super_admin', [
                        'methodName'     => $_SERVER['REQUEST_METHOD'],
                        'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                        'serviceName' => __NAMESPACE__ . '\\' . basename(AcceptedDomainSystemController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => $this->tableNameAcceptedDomain
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
                if (is_null($apiDisplaySingleRecord))
                {
                    return response([
                        'title'              => __('error_and_notification_system.show.info_00006_notify.user_has_rights.message_title'),
                        'notify_code'        => 'INFO_00006',
                        'description'        => __('error_and_notification_system.show.info_00006_notify.user_has_rights.message_super_admin', [
                            'methodName'     => $_SERVER['REQUEST_METHOD'],
                            'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                            'serviceName' => __NAMESPACE__ . '\\' . basename(AcceptedDomainSystemController::class) . '.php',
                            'databaseName'   => config('database.connections.mysql.database'),
                            'tableName'      => $this->tableNameAcceptedDomain,
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
                    $apiDisplayAllRecords = $this->modelNameAcceptedDomain->select('id', 'domain', 'type')->where('id', '=', $id)->get();
                    return response([
                        'title'              => __('error_and_notification_system.show.info_00001_notify.user_has_rights.message_title'),
                        'notify_code'        => 'INFO_00001',
                        'description'        => __('error_and_notification_system.show.info_00001_notify.user_has_rights.message_super_admin', [
                            'databaseName'   => config('database.connections.mysql.database'),
                            'tableName'      => $this->tableNameAcceptedDomain
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
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            return response([
                'title'              => __('error_and_notification_system.show.err_00001_notify.user_has_rights.message_title'),
                'notify_code'        => 'ERR_00001',
                'description'        => __('error_and_notification_system.show.err_00001_notify.user_has_rights.message_super_admin', [
                    'methodName'     => $_SERVER['REQUEST_METHOD'],
                    'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                    'serviceName' => __NAMESPACE__ . '\\' . basename(AcceptedDomainSystemController::class) . '.php',
                    'databaseName'   => config('database.connections.mysql.database'),
                    'tableName'      => 'accepted_domains'
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
                'domain' => 'required',
                'type'   => 'required',
            ]);
            $apiUpdateSingleRecord = $this->modelNameAcceptedDomain->find($id);
            $apiUpdateSingleRecord->update([
                'domain' => $request->get('domain'),
                'type'   => $request->get('type'),
            ]);
            // $this->modelNameAcceptedDomain->find($apiUpdateSingleRecord->id)->log()->create([ 
            //     'status'  => 'Admin update accepted domain',
            //     'details' => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_super_admin', [
            //         'record'         => $request->get('domain') . ' (id ' . $apiUpdateSingleRecord->id . ')',
            //         'databaseName'   => config('database.connections.mysql.database'),
            //         'tableName'      => $this->tableNameAcceptedDomain
            //     ])
            // ]);
            return response([
                'title'              => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_title'),
                'notify_code'        => 'INFO_00002',
                'description'        => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_super_admin', [
                    'record'         => $apiUpdateSingleRecord['domain'],
                    'databaseName'   => config('database.connections.mysql.database'),
                    'tableName'      => $this->tableNameAcceptedDomain
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
                        'tableName'      => 'accepted_domains',
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
            $apiDisplayAllRecords = $this->modelNameAcceptedDomain->select('id')->get();
            $apiDisplaySingleRecord = $this->modelNameAcceptedDomain->find($id);
            if ($apiDisplayAllRecords->isEmpty())
            {
                return response([
                    'title'              => __('error_and_notification_system.delete.war_00001_notify.user_has_rights.message_title'),
                    'notify_code'        => 'WAR_00001',
                    'description'        => __('error_and_notification_system.delete.war_00001_notify.user_has_rights.message_super_admin', [
                        'methodName'     => $_SERVER['REQUEST_METHOD'],
                        'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                        'serviceName' => __NAMESPACE__ . '\\' . basename(AcceptedDomainSystemController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => $this->tableNameAcceptedDomain
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
                            'serviceName' => __NAMESPACE__ . '\\' . basename(AcceptedDomainSystemController::class) . '.php',
                            'databaseName'   => config('database.connections.mysql.database'),
                            'tableName'      => $this->tableNameAcceptedDomain,
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
                    // $this->modelNameAcceptedDomain->find($apiDisplaySingleRecord['id'])->log()->create([ 
                    //     'status'  => 'Admin delete accepted domain',
                    //     'details' => __('error_and_notification_system.delete.info_00002_notify.user_has_rights.message_super_admin', [
                    //         'record'         => $apiDisplaySingleRecord['domain'] . ' (id ' . $apiDisplaySingleRecord['id'] . ')',
                    //         'databaseName'   => config('database.connections.mysql.database'),
                    //         'tableName'      => $this->tableNameAcceptedDomain
                    //     ])
                    // ]);
                    $apiDeleteSingleRecord = $this->modelNameAcceptedDomain->find($id)->delete();
                    return response([
                        'title'              => __('error_and_notification_system.delete.info_00002_notify.user_has_rights.message_title'),
                        'notify_code'        => 'INFO_00002',
                        'description'        => __('error_and_notification_system.delete.info_00002_notify.user_has_rights.message_super_admin', [
                            'record'         => $apiDisplaySingleRecord['domain'],
                            'databaseName'   => config('database.connections.mysql.database'),
                            'tableName'      => $this->tableNameAcceptedDomain
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
                        'serviceName' => __NAMESPACE__ . '\\' . basename(AcceptedDomainSystemController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => 'accepted_domains',
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
