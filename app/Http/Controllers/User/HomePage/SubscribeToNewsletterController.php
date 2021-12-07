<?php

namespace App\Http\Controllers\User\HomePage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\Newsletter;
use App\Models\ErrorAndNotificationSystem;

class SubscribeToNewsletterController extends Controller
{
    protected $modelNameNewsletter;
    protected $tableNameNewsletter;
    protected $tableAllColumnsNewsletter;

    protected $modelNameErrorSystem;
    protected $tableNameErrorSystem;
    protected $tableAllColumnsErrorSystem;

    public function __construct()
    {
        $this->modelNameNewsletter        = new Newsletter();
        $this->tableNameNewsletter        = $this->modelNameNewsletter->getTable();
        $this->tableAllColumnsNewsletter  = Schema::getColumnListing($this->tableNameNewsletter);

        $this->modelNameErrorSystem       = new ErrorAndNotificationSystem();
        $this->tableNameErrorSystem       = $this->modelNameErrorSystem->getTable();
        $this->tableAllColumnsErrorSystem = Schema::getColumnListing($this->tableNameErrorSystem);
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
                'email'          => 'required|email:filter|max:255|unique:newsletter',
            ]);
            if (is_null($request->get('privacy_policy'))) 
            {
                $apiInsertSingleRecord = $this->modelNameNewsletter->create([
                    'full_name'      => $request->get('full_name'),
                    'email'          => $request->get('email'),
                    'privacy_policy' => '0',
                ]);
            }
            else 
            {
                $apiInsertSingleRecord = $this->modelNameNewsletter->create([
                    'full_name'      => $request->get('full_name'),
                    'email'          => $request->get('email'),
                    'privacy_policy' => '1',
                ]);
            }
            return response([
                'notify_code'              => 'INFO_0003',
                'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0003')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0003')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                'admin_message'            => __('newsletter.store.info_0003_admin_message', [ 'fullName' => $request->get('full_name') ]),
                'records'                  => $apiInsertSingleRecord,
            ], 201);
        }
        catch  (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                return response([
                    'notify_code'              => 'ERR_0001',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0001')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0001')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('newsletter.store.err_0001_admin_message'),
                ], 500);
            }
            if ($mysqlError->getCode() === '42S22') 
            {
                return response([
                    'notify_code'              => 'ERR_0002',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0002')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0002')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('newsletter.store.err_0002_admin_message'),
                ], 500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $email
     * @return \Illuminate\Http\Response
     */
    public function destroy($email)
    {
        try
        {
            $apiDisplayAllRecords = $this->modelNameNewsletter->all();
            $findUserSubscriptionByEmailAddress = $this->modelNameNewsletter->where($this->tableAllColumnsNewsletter[2], '=', $email)->get();
            if ($apiDisplayAllRecords->isEmpty()) 
            {
                return response([
                    'notify_code'              => 'INFO_0001',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('newsletter.delete.info_0001_admin_message', [ 'tableName' => $this->modelNameNewsletter ]),
                ], 404);
            }
            $getEmailAddress = $this->modelNameNewsletter->where($this->tableAllColumnsNewsletter[2], '=', $email)->pluck($this->tableAllColumnsNewsletter[2])[0];
            if (is_null($getEmailAddress)) 
            {
                return response([
                    'notify_code'              => 'INFO_0007',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0007')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0007')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('newsletter.delete.info_0007_admin_message', [ 'tableName' => $this->modelNameNewsletter ]),
                ], 404);
            }
            else 
            {
                $findUserIdByEmailAddress = $this->modelNameNewsletter->where($this->tableAllColumnsNewsletter[2], '=', $email)->pluck($this->tableAllColumnsNewsletter[0])[0];
                $apiDeleteSingleRecord = $this->modelNameNewsletter->find($findUserIdByEmailAddress)->delete();
                return response([
                    'notify_code'              => 'INFO_0006',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0006')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0006')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('newsletter.delete.info_0006_admin_message'),
                    'deleted_records'          => $apiDisplayAllRecords,
                ], 200);
            }
        }
        catch (\Illuminate\Database\QueryException $mysqlError) 
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                return response([
                    'notify_code'              => 'ERR_0001',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0001')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0001')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('newsletter.delete.err_0001_admin_message'),
                ], 500);
            }
        }
    }
}
