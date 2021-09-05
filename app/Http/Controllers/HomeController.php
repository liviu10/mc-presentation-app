<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected $modelName;
    protected $tableName;
    protected $tableAllColumns;

    public function __construct()
    {
        $this->modelName              = new Home();
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
        //
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
                'notify_code'                  => '!!! ERROR CODE HERE !!!',
                'notify_short_description'     => 'You have successfully subscribed to the newsletter! Welcome to my website!',
                'notify_reference'             => '!!! Insert documentation link here !!!',
                'user_message'                 => $apiInsertSingleRecord,
            ], 201);
        }
        catch  (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                return response([
                    'error_code'               => '!!! ERROR CODE HERE !!!',
                    'error_short_description'  => 'It appears that the table is missing from the database!',
                    'error_reference'          => '!!! Insert documentation link here !!!',
                    'user_message'             => 'The record(s) you are trying to insert in the field(s) [Full Name] and [Email] could not be saved in the database! Please contact the website administrator!',
                ], 500);
            }
            if ($mysqlError->getCode() === '42S22') 
            {
                return response([
                    'error_code'               => '!!! ERROR CODE HERE !!!',
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
