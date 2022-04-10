<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ErrorAndNotificationSystem;

class ErrorAndNotificationSystemController extends Controller
{
    protected $modelName;
    protected $tableName;

    /**
     * Instantiate the variables that will be used to get the model and table name as well as the table's columns.
     *
     * @return Collection|String
     */
    public function __construct()
    {
        $this->modelName = new ErrorAndNotificationSystem();
        $this->tableName = $this->modelName->getTable();
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
            $apiDisplayAllRecords = $this->modelName->select('id', 'notify_code', 'notify_short_description', 'notify_reference')->get();
            if ($apiDisplayAllRecords->isEmpty())
            {
                return response([
                    'title'              => __('error_and_notification_system.index.war_00001_notify.user_has_rights.message_title'),
                    'notify_code'        => 'WAR_00001',
                    'description'        => __('error_and_notification_system.index.war_00001_notify.user_has_rights.message_super_admin', [
                        'methodName'     => $_SERVER['REQUEST_METHOD'],
                        'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                        'serviceName' => __NAMESPACE__ . '\\' . basename(ErrorAndNotificationSystemController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => $this->tableName
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
                        'tableName'      => $this->tableName
                    ]),
                    'reference'          => $this->modelName::where('notify_code', '=', 'INFO_00001')->pluck('notify_reference')[0],
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
                        'serviceName' => __NAMESPACE__ . '\\' . basename(ErrorAndNotificationSystemController::class) . '.php',
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
                'notify_code_options'      => 'required',
                'notify_code'              => 'required|regex:/^[a-zA-Z0-9_ ]+$/u|max:10',
                'notify_short_description' => 'required|max:255',
            ]);
            if ($request->get('notify_code_options') === '1')
            {
                $formUrl = config('app.url') . '/admin/documentation' . '/information#' . $request->get('notify_code');
                $apiInsertSingleRecord = $this->modelName->create(array_merge([
                    'notify_code'              => 'INFO' . '_' . $request->get('notify_code'),
                    'notify_short_description' => $request->get('notify_short_description'),
                ], [ 'notify_reference' => $formUrl ]));
                $this->modelName->find($apiInsertSingleRecord->id)->log()->create([ 
                    'status'  => 'Admin create error and notification',
                    'details' => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_super_admin', [
                        'record'         => $apiInsertSingleRecord['notify_code'] . ' (id ' . $apiInsertSingleRecord->id . ')',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => $this->tableName
                    ])
                ]);
                return response([
                    'title'              => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_title'),
                    'notify_code'        => 'INFO_00002',
                    'description'        => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_super_admin', [
                        'record'         => $apiInsertSingleRecord['notify_code'],
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => $this->tableName
                    ]),
                    'reference'          => $this->modelName::where('notify_code', '=', 'INFO_00002')->pluck('notify_reference')[0],
                    'api_endpoint'       => $_SERVER['REQUEST_URI'],
                    'http_response'      => [
                        'code'           => 201,
                        'general_message'=> 'The HTTP 201 Created success status response code indicates that the request has succeeded and has led to the creation of a resource.',
                        'url'            => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/201',
                    ],
                    'records'            => $apiInsertSingleRecord,
                ], 201);
            }
            if ($request->get('notify_code_options') === '2')
            {
                $formUrl = config('app.url') . '/admin/documentation' . '/warning#' . $request->get('notify_code');
                $apiInsertSingleRecord = $this->modelName->create(array_merge([
                    'notify_code'              => 'WAR' . '_' . $request->get('notify_code'),
                    'notify_short_description' => $request->get('notify_short_description'),
                ], [ 'notify_reference' => $formUrl ]));
                $this->modelName->find($apiInsertSingleRecord->id)->log()->create([ 
                    'status'  => 'Admin create error and notification',
                    'details' => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_super_admin', [
                        'record'         => $apiInsertSingleRecord['notify_code'] . ' (id ' . $apiInsertSingleRecord->id . ')',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => $this->tableName
                    ])
                ]);
                return response([
                    'title'              => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_title'),
                    'notify_code'        => 'INFO_00002',
                    'description'        => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_super_admin', [
                        'record'         => $apiInsertSingleRecord['notify_code'],
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => $this->tableName
                    ]),
                    'reference'          => $this->modelName::where('notify_code', '=', 'INFO_00002')->pluck('notify_reference')[0],
                    'api_endpoint'       => $_SERVER['REQUEST_URI'],
                    'http_response'      => [
                        'code'           => 201,
                        'general_message'=> 'The HTTP 201 Created success status response code indicates that the request has succeeded and has led to the creation of a resource.',
                        'url'            => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/201',
                    ],
                    'records'            => $apiInsertSingleRecord,
                ], 201);
            }
            if ($request->get('notify_code_options') === '3')
            {
                $formUrl = config('app.url') . '/admin/documentation' . '/error#' . $request->get('notify_code');
                $apiInsertSingleRecord = $this->modelName->create(array_merge([
                    'notify_code'              => 'ERR' . '_' . $request->get('notify_code'),
                    'notify_short_description' => $request->get('notify_short_description'),
                ], [ 'notify_reference' => $formUrl ]));
                $this->modelName->find($apiInsertSingleRecord->id)->log()->create([ 
                    'status'  => 'Admin create error and notification',
                    'details' => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_super_admin', [
                        'record'         => $apiInsertSingleRecord['notify_code'] . ' (id ' . $apiInsertSingleRecord->id . ')',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => $this->tableName
                    ])
                ]);
                return response([
                    'title'              => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_title'),
                    'notify_code'        => 'INFO_00002',
                    'description'        => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_super_admin', [
                        'record'         => $apiInsertSingleRecord['notify_code'],
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => $this->tableName
                    ]),
                    'reference'          => $this->modelName::where('notify_code', '=', 'INFO_00002')->pluck('notify_reference')[0],
                    'api_endpoint'       => $_SERVER['REQUEST_URI'],
                    'http_response'      => [
                        'code'           => 201,
                        'general_message'=> 'The HTTP 201 Created success status response code indicates that the request has succeeded and has led to the creation of a resource.',
                        'url'            => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/201',
                    ],
                    'records'            => $apiInsertSingleRecord,
                ], 201);
            }
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
                        'serviceName' => __NAMESPACE__ . '\\' . basename(ErrorAndNotificationSystemController::class) . '.php',
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
            if ($mysqlError->getCode() === '23000') 
            {
                return response([
                    'title'              => __('error_and_notification_system.store.err_00003_notify.user_has_rights.message_title'),
                    'notify_code'        => 'ERR_00003',
                    'description'        => __('error_and_notification_system.store.err_00003_notify.user_has_rights.message_super_admin', [
                        'methodName'     => $_SERVER['REQUEST_METHOD'],
                        'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                        'serviceName' => __NAMESPACE__ . '\\' . basename(ErrorAndNotificationSystemController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => 'error_and_notification_system',
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
                'notify_code_options'      => 'required',
                'notify_code'              => 'required|regex:/^[a-zA-Z0-9_ ]+$/u|max:10',
                'notify_short_description' => 'required|max:255',
            ]);
            $notifyReference = explode('_', $request->get('notify_code'))[0];
            if ($request->get('notify_code_options') === '1')
            {
                $apiUpdateSingleRecord = $this->modelName->find($id);
                $formUrl = config('app.url') . '/admin/documentation' . '/information#' . $request->get('notify_code');
                $apiUpdateSingleRecord->update([
                    'notify_code' => 'INFO' . '_' . $request->get('notify_code'),
                    'notify_short_description' => $request->get('notify_short_description'),
                    'notify_reference' => $formUrl,
                ]);
                $this->modelName->find($apiUpdateSingleRecord->id)->log()->create([ 
                    'status'  => 'Admin update error and notification',
                    'details' => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_super_admin', [
                        'record'         => $apiUpdateSingleRecord['notify_code'] . ' (id ' . $apiUpdateSingleRecord->id . ')',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => $this->tableName
                    ])
                ]);
                return response([
                    'title'              => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_title'),
                    'notify_code'        => 'INFO_00002',
                    'description'        => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_super_admin', [
                        'record'         => $apiUpdateSingleRecord['notify_code'],
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => $this->tableName
                    ]),
                    'reference'          => $this->modelName::where('notify_code', '=', 'INFO_00002')->pluck('notify_reference')[0],
                    'api_endpoint'       => $_SERVER['REQUEST_URI'],
                    'http_response'      => [
                        'code'           => 201,
                        'general_message'=> 'The HTTP 201 Created success status response code indicates that the request has succeeded and has led to the creation of a resource.',
                        'url'            => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/201',
                    ],
                    'records'            => $apiUpdateSingleRecord,
                ], 201);
            }
            if ($request->get('notify_code_options') === '2')
            {
                $apiUpdateSingleRecord = $this->modelName->find($id);
                $formUrl = config('app.url') . '/admin/documentation' . '/warning#' . $request->get('notify_code');
                $apiUpdateSingleRecord->update([
                    'notify_code' => 'WAR' . '_' . $request->get('notify_code'),
                    'notify_short_description' => $request->get('notify_short_description'),
                    'notify_reference' => $formUrl,
                ]);
                $this->modelName->find($apiUpdateSingleRecord->id)->log()->create([ 
                    'status'  => 'Admin update error and notification',
                    'details' => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_super_admin', [
                        'record'         => $apiUpdateSingleRecord['notify_code'] . ' (id ' . $apiUpdateSingleRecord->id . ')',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => $this->tableName
                    ])
                ]);
                return response([
                    'title'              => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_title'),
                    'notify_code'        => 'INFO_00002',
                    'description'        => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_super_admin', [
                        'record'         => $apiUpdateSingleRecord['notify_code'],
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => $this->tableName
                    ]),
                    'reference'          => $this->modelName::where('notify_code', '=', 'INFO_00002')->pluck('notify_reference')[0],
                    'api_endpoint'       => $_SERVER['REQUEST_URI'],
                    'http_response'      => [
                        'code'           => 201,
                        'general_message'=> 'The HTTP 201 Created success status response code indicates that the request has succeeded and has led to the creation of a resource.',
                        'url'            => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/201',
                    ],
                    'records'            => $apiUpdateSingleRecord,
                ], 201);
            }
            if ($request->get('notify_code_options') === '3')
            {
                $apiUpdateSingleRecord = $this->modelName->find($id);
                $formUrl = config('app.url') . '/admin/documentation' . '/error#' . $request->get('notify_code');
                $apiUpdateSingleRecord->update([
                    'notify_code' => 'ERR' . '_' . $request->get('notify_code'),
                    'notify_short_description' => $request->get('notify_short_description'),
                    'notify_reference' => $formUrl,
                ]);
                $this->modelName->find($apiUpdateSingleRecord->id)->log()->create([ 
                    'status'  => 'Admin update error and notification',
                    'details' => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_super_admin', [
                        'record'         => $apiUpdateSingleRecord['notify_code'] . ' (id ' . $apiUpdateSingleRecord->id . ')',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => $this->tableName
                    ])
                ]);
                return response([
                    'title'              => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_title'),
                    'notify_code'        => 'INFO_00002',
                    'description'        => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_super_admin', [
                        'record'         => $apiUpdateSingleRecord['notify_code'],
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => $this->tableName
                    ]),
                    'reference'          => $this->modelName::where('notify_code', '=', 'INFO_00002')->pluck('notify_reference')[0],
                    'api_endpoint'       => $_SERVER['REQUEST_URI'],
                    'http_response'      => [
                        'code'           => 201,
                        'general_message'=> 'The HTTP 201 Created success status response code indicates that the request has succeeded and has led to the creation of a resource.',
                        'url'            => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/201',
                    ],
                    'records'            => $apiUpdateSingleRecord,
                ], 201);
            }
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
                        'serviceName' => __NAMESPACE__ . '\\' . basename(ErrorAndNotificationSystemController::class) . '.php',
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