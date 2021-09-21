<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class NewsletterController extends Controller
{
    protected $modelName;
    protected $tableName;
    protected $tableAllColumns;

    public function __construct()
    {
        $this->modelName              = new Newsletter();
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
                    'notify_code'              => 'INFO_01',
                    'notify_short_description' => 'Currently, there are no users that have subscribed to your newsletter!',
                    'notify_reference'         => '!!! Insert documentation link here !!!',
                    'records'                  => $apiDisplayAllRecords,
                ], 404);
            }
            else 
            {
                return response([
                    'notify_code'              => 'INFO_02',
                    'notify_short_description' => 'The list of subscribed users was successfully fetched from the database!',
                    'notify_reference'         => '!!! Insert documentation link here !!!',
                    'records'                  => $apiDisplayAllRecords,
                ], 201);
            }
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                return response([
                    'notify_code'              => 'ERR_01',
                    'notify_short_description' => 'The table you are looking for does not exist in the database!',
                    'notify_reference'         => '!!! Insert documentation link here !!!',
                ], 500);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
                'email'          => 'required|email:filter|max:255|unique:newsletter',
                'privacy_policy' => 'accepted',
            ]);
            $apiInsertSingleRecord = $this->modelName->create([
                'full_name'      => $request->get('full_name'),
                'email'          => $request->get('email'),
                'privacy_policy' => $request->get('privacy_policy'),
            ]);
            return response([
                'notify_code'                  => 'INFO_03',
                'notify_short_description'     => 'You have successfully subscribed to the newsletter! Welcome to my website, ' . $request->get('full_name') . '!',
                'notify_reference'             => '!!! Insert documentation link here !!!',
                'records'                      => $apiInsertSingleRecord,
            ], 201);
        }
        catch  (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                return response([
                    'error_code'               => 'ERR_01',
                    'error_short_description'  => 'It appears that the table is missing from the database!',
                    'error_reference'          => '!!! Insert documentation link here !!!',
                    'user_message'             => 'The record(s) you are trying to insert in the field(s) [Full Name] and [Email] could not be saved in the database! Please contact the website administrator!',
                ], 500);
            }
            if ($mysqlError->getCode() === '42S22') 
            {
                return response([
                    'error_code'               => 'ERR_02',
                    'error_short_description'  => 'It appears that one or more columns are missing from the table!',
                    'error_reference'          => '!!! Insert documentation link here !!!',
                    'user_message'             => 'The record(s) you are trying to insert in the field(s) [Full Name] and [Email] could not be saved in the database! Please contact the website administrator!',
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
            $apiDisplayAllRecords = $this->modelName->all();
            $apiDisplaySingleRecord = $this->modelName->find($id);
            if ($apiDisplayAllRecords->isEmpty()) 
            {
                return response([
                    'notify_code'              => 'INFO_01',
                    'notify_short_description' => 'Currently, there are no users that have subscribed to your newsletter!',
                    'notify_reference'         => '!!! Insert documentation link here !!!',
                ], 404);
            }
            elseif (is_null($apiDisplaySingleRecord)) 
            {
                return response([
                    'notify_code'              => 'INFO_04',
                    'notify_short_description' => 'The user subscription you are looking for does not exist in the database!',
                    'notify_reference'         => '!!! Insert documentation link here !!!',
                ], 404);
            }
            else 
            {
                return response([
                    'notify_code'              => 'INFO_05',
                    'notify_short_description' => 'The user subscription was successfully fetched from the database!',
                    'notify_reference'         => '!!! Insert documentation link here !!!',
                    'record'                   => $apiDisplaySingleRecord,
                ], 201);
            }
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                return response([
                    'notify_code'              => 'ERR_01',
                    'notify_short_description' => 'It appears that the table is missing from the database!',
                    'notify_reference'         => '!!! Insert documentation link here !!!',
                    'user_message'             => 'The record(s) you are trying to view could not be fetched from the database! Please contact the website administrator!',
                ], 500);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 
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
                'email'          => 'required|email:filter|max:255|unique:newsletter',
            ]));
            return response([
                'notify_code'                  => 'INFO_06',
                'notify_short_description'     => 'You have successfully change your email address!',
                'notify_reference'             => '!!! Insert documentation link here !!!',
                'records'                      => $apiUpdateSingleRecord,
            ], 201);
        }
        catch (\Illuminate\Database\QueryException $mysqlError) 
        {
            if ($mysqlError->getCode() === '42S02')
            {
                return response([
                    'notify_code'              => 'ERR_01',
                    'notify_short_description' => 'The table you are looking for does not exist in the database!',
                    'notify_reference'         => '!!! Insert documentation link here !!!',
                ], 500);
            }
            if ($mysqlError->getCode() === '42S22') 
            {
                return response([
                    'error_code'               => 'ERR_02',
                    'error_short_description'  => 'It appears that one or more columns are missing from the table!',
                    'error_reference'          => '!!! Insert documentation link here !!!',
                    'user_message'             => 'The record(s) you are trying to insert in the field(s) [Full Name] and [Email] could not be saved in the database! Please contact the website administrator!',
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
            $apiDisplayAllRecords = $this->modelName->all();
            $findUserSubscriptionByEmailAddress = $this->modelName->where($this->tableAllColumns[2], '=', $email)->get();
            if ($apiDisplayAllRecords->isEmpty()) 
            {
                return response([
                    'notify_code'              => 'INFO_01',
                    'notify_short_description' => 'Currently, there are no users that have subscribed to your newsletter!',
                    'notify_reference'         => '!!! Insert documentation link here !!!',
                ], 404);
            }
            $getEmailAddress = $this->modelName->where($this->tableAllColumns[2], '=', $email)->pluck($this->tableAllColumns[2])[0];
            if (is_null($getEmailAddress)) 
            {
                return response([
                    'notify_code'              => 'INFO_07',
                    'notify_short_description' => 'The user subscription you are trying to delete does not exist in the database!',
                    'notify_reference'         => '!!! Insert documentation link here !!!',
                ], 404);
            }
            else 
            {
                $findUserIdByEmailAddress = $this->modelName->where($this->tableAllColumns[2], '=', $email)->pluck($this->tableAllColumns[0])[0];
                $apiDeleteSingleRecord = $this->modelName->find($findUserIdByEmailAddress)->delete();
                return response([
                    'notify_code'              => 'INFO_05',
                    'notify_short_description' => 'The user subscription you have selected was successfully deleted from the database',
                    'notify_reference'         => '!!! Insert documentation link here !!!',
                ], 200);
            }
        }
        catch (\Illuminate\Database\QueryException $mysqlError) 
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                return response([
                    'notify_code'              => 'ERR_01',
                    'notify_short_description' => 'The table you are looking for does not exist in the database!',
                    'notify_reference'         => '!!! Insert documentation link here !!!',
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
                    'notify_code'              => 'INFO_01',
                    'notify_short_description' => 'Currently, there are no users that have subscribed to your newsletter!',
                    'notify_reference'         => '!!! Insert documentation link here !!!',
                ], 404);
            }
            elseif (is_null($apiDisplayAllRecords)) 
            {
                return response([
                    'notify_code'              => 'INFO_07',
                    'notify_short_description' => 'The user subscription you are trying to delete does not exist in the database!',
                    'notify_reference'         => '!!! Insert documentation link here !!!',
                ], 404);
            }
            else 
            {
                $apiDeleteSingleRecord = $this->modelName->truncate();
                return response([
                    'notify_code'              => 'INFO_08',
                    'notify_short_description' => 'You have successfully delete all the records from the database!',
                    'notify_reference'         => '!!! Insert documentation link here !!!',
                    'user_message'             => $apiDisplayAllRecords,
                ], 200);
            }
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                return response([
                    'notify_code'              => 'ERR_01',
                    'notify_short_description' => 'The table you are looking for does not exist in the database!',
                    'notify_reference'         => '!!! Insert documentation link here !!!',
                ], 500);
            }
        }
    }
}
