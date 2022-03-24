<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ErrorAndNotificationSystem;

class ProfileController extends Controller
{
    protected $modelName;

    /**
     * Instantiate the variables that will be used to get the model and table name as well as the table's columns.
     *
     * @return Collection|String
     */
    public function __construct()
    {
        $this->modelName = new ErrorAndNotificationSystem();
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        try
        {
            if ($request->get('email') === $request->user()->email)
            {
                $user = $request->user();
                $this->validate($request, [
                    'name'     => 'nullable|regex:/^[a-zA-Z0-9_ ]+$/u|max:255',
                    'email'    => 'nullable|email|unique:users,email,' . $user->id,
                    'nickname' => 'nullable|max:255',
                    'password' => 'nullable|min:6|confirmed',
                ]);
                $request->user()->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'nickname' => $request->nickname,
                    'password' => bcrypt($request->password),
                ]);
                return response([
                    'title'              => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_title'),
                    'notify_code'        => 'INFO_00002',
                    'description'        => __('error_and_notification_system.update.info_00002_notify.user_has_rights.message_super_admin', [
                        'record'         => $request->get('notify_code'),
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => 'users'
                    ]),
                    'reference'          => $this->modelName::where('notify_code', '=', 'INFO_00002')->pluck('notify_reference')[0],
                    'api_endpoint'       => $_SERVER['REQUEST_URI'],
                    'http_response'      => [
                        'code'           => 201,
                        'general_message'=> 'The HTTP 201 Created success status response code indicates that the request has succeeded and has led to the creation of a resource.',
                        'url'            => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/201',
                    ],
                    'records'            => $user,
                ], 201);
            }
            else
            {
                return response([
                    'title'              => __('error_and_notification_system.store.err_00003_notify.user_has_rights.message_title'),
                    'notify_code'        => 'ERR_00003',
                    'description'        => __('error_and_notification_system.store.err_00003_notify.user_has_rights.message_super_admin', [
                        'methodName'     => $_SERVER['REQUEST_METHOD'],
                        'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                        'serviceName' => __NAMESPACE__ . '\\' . basename(ProfileController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => 'users',
                    ]),
                    'reference'          => config('app.url') . '/documentation/error#ERR_00001',
                    'api_endpoint'       => $_SERVER['REQUEST_URI'],
                    'http_response'      => [
                        'code'           => 406,
                        'general_message'=> 'The HyperText Transfer Protocol (HTTP) 406 Not Acceptable client error response code indicates that the server cannot produce a response matching the list of acceptable values defined in the request\'s proactive content negotiation headers, and that the server is unwilling to supply a default representation',
                        'url'            => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/406',
                    ],
                    'records'            => [],
                ], 406);
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
                        'serviceName' => __NAMESPACE__ . '\\' . basename(ProfileController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => 'users',
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
