<?php

namespace App\Http\Controllers\User\ContactMePage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMe;
use App\Models\AcceptedDomain;
use App\Models\Log;

class ContactMeController extends Controller
{
    protected $modelNameContactMe;
    protected $modelNameLog;
    protected $modelNameAcceptedDomain;
    protected $tableNameContactMe;

    /**
     * Instantiate the variables that will be used to get the model.
     * 
     * @return Collection
     */
    public function __construct()
    {
        $this->modelNameContactMe = new ContactMe();
        $this->modelNameLog = new Log();
        $this->modelNameAcceptedDomain = new AcceptedDomain();
        $this->tableNameContactMe = $this->modelNameContactMe->getTable();
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
                'full_name'      => 'required|regex:/^[a-zA-Z_ ]+$/u|max:255',
                'email'          => 'required|email:filter|max:255',
                'message'        => 'required|min:60',
            ]);
            
            // Check the email address against the accepted domains
            $getEmailAddressProvider = $this->modelNameAcceptedDomain->select('id', 'domain')->where('domain', '=', '.' . explode('.', substr(strstr($request->get('email'), '@'), 1))[0])->get()->toArray();
            $getEmailAddressDomain = $this->modelNameAcceptedDomain->select('id', 'domain')->where('domain', '=', '.' . explode('.', substr(strstr($request->get('email'), '@'), 1))[1])->get()->toArray();

            if (count($getEmailAddressProvider) === 1 && count($getEmailAddressDomain) === 1) 
            {
                if (is_null($request->get('privacy_policy'))) 
                {
                    $records = $this->modelNameContactMe->create([
                        'full_name'      => $request->get('full_name'),
                        'email'          => $request->get('email'),
                        'message'        => $request->get('message'),
                        'privacy_policy' => '0',
                    ]);
                }
                else 
                {
                    $records = $this->modelNameContactMe->create([
                        'full_name'      => $request->get('full_name'),
                        'email'          => $request->get('email'),
                        'message'        => $request->get('message'),
                        'privacy_policy' => '1',
                    ]);
                }
                $apiInsertSingleRecord = [
                    'full_name' => $records['full_name'],
                    'email' => $records['email'],
                    'message' => $request->get('message'),
                    'privacy_policy' => $records['privacy_policy'],
                ];
                $this->modelNameContactMe->find($records->id)->log()->create([
                    'status'             => 'Create',
                    'status_description' => $records['full_name'] . ' has just send you a message. To view this message please go to contact me settings.',
                    'request_details'    => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_super_admin', [
                        'record'         => $records['id'],
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => $this->tableNameContactMe,
                    ]),
                    'response_details'   => 'The HTTP 201 Created success status response code indicates that the request has succeeded and has led to the creation of a resource.',
                ]);
                return response()->json($apiInsertSingleRecord);
            }
            else
            {
                // The email provider and the domain does not exist in the accepted domain list
                $completeEmailProvider = substr(strstr($request->get('email'), '@'), 1);
                escapeshellcmd(exec('ping ' . escapeshellarg($completeEmailProvider), $output, $value));
                if ($value === 1 || $value === 2) 
                {
                    return response([], 406);
                }
            }
        }
        catch  (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                $this->modelNameLog->create([
                    'status'             => 'Error',
                    'status_description' => 'The table you are looking for does not exist in the database!',
                    'request_details'    => 'Test request_details',
                    'request_details'    => __('error_and_notification_system.store.err_00001_notify.user_has_rights.message_super_admin', [
                        'methodName'     => $_SERVER['REQUEST_METHOD'],
                        'apiEndpoint'    => $_SERVER['REQUEST_URI'],
                        'serviceName'    => __NAMESPACE__ . '\\' . basename(ContactMeController::class) . '.php',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => 'contact_me',
                    ]),
                    'response_details'   => 'The HyperText Transfer Protocol (HTTP) 500 Internal Server Error server error response code indicates that the server encountered an unexpected condition that prevented it from fulfilling the request.',
                    'sql_response'       => $mysqlError->getCode() . ' ' . $mysqlError->getMessage(),
                ]);
                return response([], 500);
            }
        }
    }
}