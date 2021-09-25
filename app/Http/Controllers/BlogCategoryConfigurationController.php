<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogCategoryConfiguration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class BlogCategoryConfigurationController extends Controller
{
    protected $modelName;
    protected $tableName;
    protected $tableAllColumns;

    public function __construct()
    {
        $this->modelName              = new BlogCategoryConfiguration();
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
                    'notify_short_description' => 'Currently, there are no defined categories!',
                    'notify_reference'         => '!!! Insert documentation link here !!!',
                    'records'                  => $apiDisplayAllRecords,
                ], 404);
            }
            else 
            {
                return response([
                    'notify_code'              => 'INFO_02',
                    'notify_short_description' => 'The list of blog categories was successfully fetched from the database!',
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
                'blog_category_title'       => 'required|regex:/^[a-zA-Z_ ]+$/u|max:255', // 
                'blog_category_description' => 'required|max:255',
                'blog_category_is_active'   => 'accepted',
            ]);
            $apiInsertSingleRecord = $this->modelName->create([
                'blog_category_code'        => substr($request->get('blog_category_title'), 0, 3) . '_01',
                'blog_category_title'       => $request->get('blog_category_title'),
                'blog_category_description' => $request->get('blog_category_description'),
                'blog_category_is_active'   => $request->get('blog_category_is_active'),
            ]);
            return response([
                'notify_code'                  => 'INFO_03',
                'notify_short_description'     => $request->get('blog_category_title') . ' was successfully created as a new blog category!',
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
                    'user_message'             => 'The record(s) you are trying to insert in the field(s) [Blog Title] and / or [Blog Description] could not be saved in the database! Please contact the website administrator!',
                ], 500);
            }
            if ($mysqlError->getCode() === '23000') 
            {
                return response([
                    'error_code'               => 'ERR_03',
                    'error_short_description'  => 'It appears that the record already exist in the database!',
                    'error_reference'          => '!!! Insert documentation link here !!!',
                    'user_message'             => 'The record(s) you are trying to insert in the field(s) [Blog Category Title] could not be saved in the database! Please try again with a different category!',
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
                    'notify_code'              => 'INFO_01',
                    'notify_short_description' => 'Currently, there are no main categories defined!',
                    'notify_reference'         => '!!! Insert documentation link here !!!',
                ], 404);
            }
            elseif (is_null($apiDisplaySingleRecord)) 
            {
                return response([
                    'notify_code'              => 'INFO_04',
                    'notify_short_description' => 'The blog category you are looking for does not exist in the database!',
                    'notify_reference'         => '!!! Insert documentation link here !!!',
                ], 404);
            }
            else 
            {
                return response([
                    'notify_code'              => 'INFO_05',
                    'notify_short_description' => 'The blog category was successfully fetched from the database!',
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
                'blog_category_title'       => 'required|regex:/^[a-zA-Z_ ]+$/u|max:255', // 
                'blog_category_description' => 'required|max:255',
                'blog_category_is_active'   => 'accepted',
            ]));
            $this->modelName::where($this->tableAllColumns[0], '=', $id)->update([
                'blog_category_code' => substr($apiUpdateSingleRecord['blog_category_title'], 0, 3) . '_01',
            ]);
            return response([
                'notify_code'                  => 'INFO_06',
                'notify_short_description'     => 'You have successfully change the blog main category!',
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
                    'user_message'             => 'The record(s) you are trying to insert in the field(s) [Blog Category Title] and / or [Blog Category Description] could not be saved in the database! Please contact the website administrator!',
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
                    'notify_code'              => 'INFO_01',
                    'notify_short_description' => 'The table you are looking for does not have any records to display!',
                    'notify_reference'         => '!!! Insert documentation link here !!!',
                ], 404);
            }
            elseif (is_null($apiDisplaySingleRecord)) 
            {
                return response([
                    'notify_code'              => 'INFO_07',
                    'notify_short_description' => 'The equipment you are looking for does not exist!',
                    'notify_reference'         => '!!! Insert documentation link here !!!',
                ], 404);
            }
            else 
            {
                $apiDeleteSingleRecord = $this->modelName->find($id)->delete();
                return response([
                    'notify_code'               => 'INFO_1',
                    'notify_short_description'  => 'The equipment you have selected was successfully deleted from the database.',
                    'notify_reference'          => '!!! Insert documentation link here !!!',
                    'delete_records'            => $apiDisplaySingleRecord,
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
                    'notify_short_description' => 'The table you are looking for does not have any records to display!',
                    'notify_reference'         => '!!! Insert documentation link here !!!',
                ], 404);
            }
            elseif (is_null($apiDisplayAllRecords)) 
            {
                return response([
                    'notify_code'              => 'INFO_07',
                    'notify_short_description' => 'There are no records in the database to be deleted!',
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
