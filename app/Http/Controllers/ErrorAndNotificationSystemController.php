<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ErrorAndNotificationSystem;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ErrorAndNotificationSystemController extends Controller
{
    protected $modelName;
    protected $tableName;
    protected $tableAllColumns;

    public function __construct()
    {
        $this->modelName              = new ErrorAndNotificationSystem();
        $this->tableName              = $this->modelName->getTable();
        $this->tableAllColumns        = Schema::getColumnListing($this->tableName);
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
            $apiDisplayAllRecords = $this->modelName->all();
            if ($apiDisplayAllRecords->isEmpty()) 
            {
                return response([
                    'notify_code'              => 'INFO_0001',
                    'notify_short_description' => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0001')->pluck($this->tableAllColumns[2])[0],
                    'notify_reference'         => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0001')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.index.info_0001_admin_message', [ 'tableName' => $this->tableName ]),
                ], 404);
            }
            else 
            {
                return response([
                    'notify_code'              => 'INFO_0002',
                    'notify_short_description' => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0002')->pluck($this->tableAllColumns[2])[0],
                    'notify_reference'         => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0002')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.index.info_0002_admin_message', [ 'tableRecordCount' => $apiDisplayAllRecords->count() ]),
                    'records'                  => $apiDisplayAllRecords,
                ], 201);
            }
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                return response([
                    'notify_code'              => 'ERR_0001',
                    'error_short_description'  => $this->modelName::where($this->tableAllColumns[1], '=', 'ERR_0001')->pluck($this->tableAllColumns[2])[0],
                    'error_reference'          => $this->modelName::where($this->tableAllColumns[1], '=', 'ERR_0001')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.index.err_0001_admin_message'),
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
                'notify_reference'         => 'required|max:255',
            ]);
            $apiInsertSingleRecord = $this->modelName->create([
                'notify_code'              => $request->get('notify_code'),
                'notify_short_description' => $request->get('notify_short_description'),
                'notify_reference'         => $request->get('notify_reference'),
            ]);
            return response([
                'notify_code'              => 'INFO_0003',
                'notify_short_description' => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0003')->pluck($this->tableAllColumns[2])[0],
                'notify_reference'         => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0003')->pluck($this->tableAllColumns[3])[0],
                'admin_message'            => __('error_and_notification_system.store.info_0003_admin_message', [ 
                                                'notifyCode'        => $request->get('notify_code'),
                                                'notifyDescription' => $request->get('notify_short_description'),
                                            ]),
                'records'                  => $apiInsertSingleRecord,
            ], 201);
        }
        catch  (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                return response([
                    'error_code'               => 'ERR_0001',
                    'notify_short_description' => $this->modelName::where($this->tableAllColumns[1], '=', 'ERR_0001')->pluck($this->tableAllColumns[2])[0],
                    'notify_reference'         => $this->modelName::where($this->tableAllColumns[1], '=', 'ERR_0001')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.store.err_0001_admin_message'),
                ], 500);
            }
            if ($mysqlError->getCode() === '42S22') 
            {
                return response([
                    'error_code'               => 'ERR_0002',
                    'notify_short_description' => $this->modelName::where($this->tableAllColumns[1], '=', 'ERR_0002')->pluck($this->tableAllColumns[2])[0],
                    'notify_reference'         => $this->modelName::where($this->tableAllColumns[1], '=', 'ERR_0002')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.store.err_0002_admin_message'),
                ], 500);
            }
            if ($mysqlError->getCode() === '23000') 
            {
                return response([
                    'error_code'               => 'ERR_0003',
                    'notify_short_description' => $this->modelName::where($this->tableAllColumns[1], '=', 'ERR_0003')->pluck($this->tableAllColumns[2])[0],
                    'notify_reference'         => $this->modelName::where($this->tableAllColumns[1], '=', 'ERR_0003')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.store.err_0003_admin_message', [ 'notifyCode' => $request->get('notify_code') ]),
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
            $apiDisplayAllRecords = $this->modelName->all();
            $apiDisplaySingleRecord = $this->modelName->find($id);
            if ($apiDisplayAllRecords->isEmpty()) 
            {
                return response([
                    'notify_code'              => 'INFO_0001',
                    'notify_short_description' => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0001')->pluck($this->tableAllColumns[2])[0],
                    'notify_reference'         => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0001')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.show.info_0001_admin_message', [ 'tableName' => $this->tableName ]),
                ], 404);
            }
            elseif (is_null($apiDisplaySingleRecord)) 
            {
                return response([
                    'notify_code'              => 'INFO_0004',
                    'notify_short_description' => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0004')->pluck($this->tableAllColumns[2])[0],
                    'notify_reference'         => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0004')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.show.info_0004_admin_message'),
                ], 404);
            }
            else 
            {
                return response([
                    'notify_code'              => 'INFO_0002',
                    'notify_short_description' => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0002')->pluck($this->tableAllColumns[2])[0],
                    'notify_reference'         => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0002')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.show.info_0002_admin_message'),
                    'record'                   => $apiDisplaySingleRecord,
                ], 201);
            }
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                return response([
                    'notify_code'              => 'ERR_0001',
                    'notify_short_description' => $this->modelName::where($this->tableAllColumns[1], '=', 'ERR_0001')->pluck($this->tableAllColumns[2])[0],
                    'notify_reference'         => $this->modelName::where($this->tableAllColumns[1], '=', 'ERR_0001')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.show.err_0001_admin_message'),
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
            $apiUpdateSingleRecord = $this->modelName->find($id);
            $apiUpdateSingleRecord->update($request->validate([
                'notify_code'              => 'required|regex:/^[a-zA-Z0-9_ ]+$/u|max:10',
                'notify_short_description' => 'required|max:255',
                'notify_reference'         => 'required|max:255',
            ]));
            return response([
                'notify_code'              => 'INFO_0006',
                'notify_short_description' => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0006')->pluck($this->tableAllColumns[2])[0],
                'notify_reference'         => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0006')->pluck($this->tableAllColumns[3])[0],
                'admin_message'            => __('error_and_notification_system.update.info_0006_admin_message', ['notifyCode' => $request->get('notify_code')]),
                'records'                  => $apiUpdateSingleRecord,
            ], 201);
        }
        catch (\Illuminate\Database\QueryException $mysqlError) 
        {
            if ($mysqlError->getCode() === '42S02')
            {
                return response([
                    'error_code'               => 'ERR_0001',
                    'notify_short_description' => $this->modelName::where($this->tableAllColumns[1], '=', 'ERR_0001')->pluck($this->tableAllColumns[2])[0],
                    'notify_reference'         => $this->modelName::where($this->tableAllColumns[1], '=', 'ERR_0001')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.update.err_0001_admin_message'),
                ], 500);
            }
            if ($mysqlError->getCode() === '42S22') 
            {
                return response([
                    'error_code'               => 'ERR_0002',
                    'notify_short_description' => $this->modelName::where($this->tableAllColumns[1], '=', 'ERR_0002')->pluck($this->tableAllColumns[2])[0],
                    'notify_reference'         => $this->modelName::where($this->tableAllColumns[1], '=', 'ERR_0002')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.update.err_0002_admin_message'),
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
            $apiDisplayAllRecords = $this->modelName->all();
            $apiDisplaySingleRecord = $this->modelName->find($id);
            if ($apiDisplayAllRecords->isEmpty()) 
            {
                return response([
                    'notify_code'              => 'INFO_0001',
                    'notify_short_description' => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0001')->pluck($this->tableAllColumns[2])[0],
                    'notify_reference'         => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0001')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.delete.info_0001_admin_message', [ 'tableName' => $this->tableName ]),
                ], 404);
            }
            elseif (is_null($apiDisplaySingleRecord)) 
            {
                return response([
                    'notify_code'              => 'INFO_0005',
                    'notify_short_description' => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0005')->pluck($this->tableAllColumns[2])[0],
                    'notify_reference'         => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0005')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.delete.info_0005_admin_message', [ 'tableName' => $this->tableName ]),
                ], 404);
            }
            else 
            {
                $apiDeleteSingleRecord = $this->modelName->find($id)->delete();
                return response([
                    'notify_code'              => 'INFO_0006',
                    'notify_short_description' => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0006')->pluck($this->tableAllColumns[2])[0],
                    'notify_reference'         => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0006')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.delete.info_0006_admin_message', [ 'notifyCode' => $apiDisplaySingleRecord->notify_code ]),
                    'delete_records'           => $apiDisplaySingleRecord,
                ], 200);
            }
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                return response([
                    'notify_code'              => 'ERR_0001',
                    'error_short_description'  => $this->modelName::where($this->tableAllColumns[1], '=', 'ERR_0001')->pluck($this->tableAllColumns[2])[0],
                    'error_reference'          => $this->modelName::where($this->tableAllColumns[1], '=', 'ERR_0001')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.delete.err_0001_admin_message'),
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
                    'notify_code'              => 'INFO_0001',
                    'notify_short_description' => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0001')->pluck($this->tableAllColumns[2])[0],
                    'notify_reference'         => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0001')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.delete_all_records.info_0001_admin_message', [ 'tableName' => $this->tableName ]),
                ], 404);
            }
            elseif (is_null($apiDisplayAllRecords)) 
            {
                return response([
                    'notify_code'              => 'INFO_0005',
                    'notify_short_description' => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0005')->pluck($this->tableAllColumns[2])[0],
                    'notify_reference'         => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0005')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.delete_all_records.info_0005_admin_message', [ 'tableName' => $this->tableName ]),
                ], 404);
            }
            else 
            {
                $apiDeleteSingleRecord = $this->modelName->truncate();
                return response([
                    'notify_code'              => 'INFO_0007',
                    'notify_short_description' => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0007')->pluck($this->tableAllColumns[2])[0],
                    'notify_reference'         => $this->modelName::where($this->tableAllColumns[1], '=', 'INFO_0007')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.delete_all_records.info_0007_admin_message', [ 'tableName' => $this->tableName ]),
                    'user_message'             => $apiDisplayAllRecords,
                ], 200);
            }
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                return response([
                    'notify_code'              => 'ERR_0001',
                    'error_short_description'  => $this->modelName::where($this->tableAllColumns[1], '=', 'ERR_0001')->pluck($this->tableAllColumns[2])[0],
                    'error_reference'          => $this->modelName::where($this->tableAllColumns[1], '=', 'ERR_0001')->pluck($this->tableAllColumns[3])[0],
                    'admin_message'            => __('error_and_notification_system.delete_all_records.err_0001_admin_message'),
                ], 500);
            }
        }
    }
}

