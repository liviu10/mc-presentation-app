<?php

namespace App\Http\Controllers\Admin\ErrorAndNotificationSystem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
                'notify_code'              => 'required|regex:/^[a-zA-Z0-9_ ]+$/u|max:10',
                'notify_short_description' => 'required|max:255',
            ]);
            $notifyReference = explode('_', $request->get('notify_code'))[0];
            if ($notifyReference === 'INFO')
            {
                $formUrl = config('app.url') . '/admin/documentation' . '/information#' . $request->get('notify_code');
                $apiInsertSingleRecord = $this->modelName->create(array_merge($request->input(), [ 'notify_reference' => $formUrl ]));
                $apiInsertSingleRecord->save();
                return response([
                    'title'              => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_title'),
                    'notify_code'        => 'INFO_00002',
                    'description'        => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_super_admin', [
                        'record'         => $request->get('notify_code'),
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
            if ($notifyReference === 'WAR')
            {
                $formUrl = config('app.url') . '/admin/documentation' . '/warning#' . $request->get('notify_code');
                $apiInsertSingleRecord = $this->modelName->create(array_merge($request->input(), [ 'notify_reference' => $formUrl ]));
                $apiInsertSingleRecord->save();
                return response([
                    'title'              => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_title'),
                    'notify_code'        => 'INFO_00002',
                    'description'        => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_super_admin', [
                        'record'     => $request->get('notify_code'),
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
            if ($notifyReference === 'ERR')
            {
                $formUrl = config('app.url') . '/admin/documentation' . '/error#' . $request->get('notify_code');
                $apiInsertSingleRecord = $this->modelName->create(array_merge($request->input(), [ 'notify_reference' => $formUrl ]));
                $apiInsertSingleRecord->save();
                return response([
                    'title'              => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_title'),
                    'notify_code'        => 'INFO_00002',
                    'description'        => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_super_admin', [
                        'record'     => $request->get('notify_code'),
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
            $apiDisplayAllRecords = $this->modelName->select('id', 'notify_code', 'notify_short_description', 'notify_reference')->get();
            $apiDisplaySingleRecord = $this->modelName->find($id);
            if ($apiDisplayAllRecords->isEmpty())
            {
                return response([
                    'title'              => __('error_and_notification_system.show.war_00001_notify.user_has_rights.message_title'),
                    'notify_code'        => 'WAR_00001',
                    'description'        => __('error_and_notification_system.show.war_00001_notify.user_has_rights.message_super_admin', [
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
                if (is_null($apiDisplaySingleRecord))
                {
                    return response([
                        'title'              => __('error_and_notification_system.show.info_00006_notify.user_has_rights.message_title'),
                        'notify_code'        => 'INFO_00006',
                        'description'        => __('error_and_notification_system.show.info_00006_notify.user_has_rights.message_super_admin', [
                            'methodName'     => $_SERVER['REQUEST_METHOD'],
                            'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                            'serviceName' => __NAMESPACE__ . '\\' . basename(ErrorAndNotificationSystemController::class) . '.php',
                            'databaseName'   => config('database.connections.mysql.database'),
                            'tableName'      => $this->tableName,
                            'lookupRecord'   => $id,
                        ]),
                        'reference'          => $this->modelName::where('notify_code', '=', 'INFO_00006')->pluck('notify_reference')[0],
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
                        'title'              => __('error_and_notification_system.show.info_00001_notify.user_has_rights.message_title'),
                        'notify_code'        => 'INFO_00001',
                        'description'        => __('error_and_notification_system.show.info_00001_notify.user_has_rights.message_super_admin', [
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
                        'records'            => $apiDisplaySingleRecord,
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
                    'serviceName' => __NAMESPACE__ . '\\' . basename(ErrorAndNotificationSystemController::class) . '.php',
                    'databaseName'   => config('database.connections.mysql.database'),
                    'tableName'      => 'error_and_notification_system'
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
                'notify_code'              => 'required|regex:/^[a-zA-Z0-9_ ]+$/u|max:10',
                'notify_short_description' => 'required|max:255',
            ]);
            $notifyReference = explode('_', $request->get('notify_code'))[0];
            if ($notifyReference === 'INFO')
            {
                $apiUpdateSingleRecord = $this->modelName->find($id);
                $formUrl = config('app.url') . '/admin/documentation' . '/information#' . $request->get('notify_code');
                $apiUpdateSingleRecord->update([
                    'notify_code' => $request->get('notify_code'),
                    'notify_short_description' => $request->get('notify_short_description'),
                    'notify_reference' => $formUrl,
                ]);
                return response([
                    'title'              => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_title'),
                    'notify_code'        => 'INFO_00002',
                    'description'        => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_super_admin', [
                        'record'         => $request->get('notify_code'),
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
            if ($notifyReference === 'WAR')
            {
                $apiUpdateSingleRecord = $this->modelName->find($id);
                $formUrl = config('app.url') . '/admin/documentation' . '/warning#' . $request->get('notify_code');
                $apiUpdateSingleRecord->update([
                    'notify_code' => $request->get('notify_code'),
                    'notify_short_description' => $request->get('notify_short_description'),
                    'notify_reference' => $formUrl,
                ]);
                return response([
                    'title'              => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_title'),
                    'notify_code'        => 'INFO_00002',
                    'description'        => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_super_admin', [
                        'record'     => $request->get('notify_code'),
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
            if ($notifyReference === 'ERR')
            {
                $apiUpdateSingleRecord = $this->modelName->find($id);
                $formUrl = config('app.url') . '/admin/documentation' . '/error#' . $request->get('notify_code');
                $apiUpdateSingleRecord->update([
                    'notify_code' => $request->get('notify_code'),
                    'notify_short_description' => $request->get('notify_short_description'),
                    'notify_reference' => $formUrl,
                ]);
                return response([
                    'title'              => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_title'),
                    'notify_code'        => 'INFO_00002',
                    'description'        => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_super_admin', [
                        'record'     => $request->get('notify_code'),
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
            $apiDisplayAllRecords = $this->modelName->select('id')->get();
            $apiDisplaySingleRecord = $this->modelName->find($id);
            if ($apiDisplayAllRecords->isEmpty())
            {
                return response([
                    'title'              => __('error_and_notification_system.delete.war_00001_notify.user_has_rights.message_title'),
                    'notify_code'        => 'WAR_00001',
                    'description'        => __('error_and_notification_system.delete.war_00001_notify.user_has_rights.message_super_admin', [
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
                if (is_null($apiDisplaySingleRecord))
                {
                    return response([
                        'title'              => __('error_and_notification_system.delete.info_00006_notify.user_has_rights.message_title'),
                        'notify_code'        => 'INFO_00006',
                        'description'        => __('error_and_notification_system.delete.info_00006_notify.user_has_rights.message_super_admin', [
                            'methodName'     => $_SERVER['REQUEST_METHOD'],
                            'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                            'serviceName' => __NAMESPACE__ . '\\' . basename(ErrorAndNotificationSystemController::class) . '.php',
                            'databaseName'   => config('database.connections.mysql.database'),
                            'tableName'      => $this->tableName,
                            'lookupRecord'   => $id,
                        ]),
                        'reference'          => $this->modelName::where('notify_code', '=', 'INFO_00006')->pluck('notify_reference')[0],
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
                    $apiDeleteSingleRecord = $this->modelName->find($id)->delete();
                    return response([
                        'title'              => __('error_and_notification_system.delete.info_00002_notify.user_has_rights.message_title'),
                        'notify_code'        => 'INFO_00002',
                        'description'        => __('error_and_notification_system.delete.info_00002_notify.user_has_rights.message_super_admin', [
                            'record'         => $apiDisplaySingleRecord['notify_code'],
                            'databaseName'   => config('database.connections.mysql.database'),
                            'tableName'      => $this->tableName
                        ]),
                        'reference'          => $this->modelName::where('notify_code', '=', 'INFO_00002')->pluck('notify_reference')[0],
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
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteAllRecords()
    {
        try
        {
            $apiDisplayAllRecords = $this->modelName->all();
            if ($apiDisplayAllRecords->isEmpty())
                {
                    return response([
                        'title'              => __('error_and_notification_system.delete_all.war_00001_notify.user_has_rights.message_title'),
                        'notify_code'        => 'WAR_00001',
                        'description'        => __('error_and_notification_system.delete_all.war_00001_notify.user_has_rights.message_super_admin', [
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
                    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                    $apiDeleteSingleRecord = $this->modelName->truncate();
                    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                    return response([
                        'title'              => __('error_and_notification_system.delete_all.info_00004_notify.user_has_rights.message_title'),
                        'notify_code'        => 'INFO_00004',
                        'description'        => __('error_and_notification_system.delete_all.info_00004_notify.user_has_rights.message_super_admin', [
                            'databaseName'   => config('database.connections.mysql.database'),
                            'tableName'      => $this->tableName
                        ]),
                        'reference'          => config('app.url') . '/documentation/information#INFO_00004',
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