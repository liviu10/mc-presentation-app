<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogSubcategory;
use App\Models\ErrorAndNotificationSystem;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class BlogSubcategoryController extends Controller
{
    protected $modelNameBlogCategories;
    protected $tableNameBlogCategories;
    protected $tableAllColumnsBlogCategories;

    protected $modelNameBlogSubcategories;
    protected $tableNameBlogSubcategories;
    protected $tableAllColumnsBlogSubcategories;

    protected $modelNameErrorSystem;
    protected $tableNameErrorSystem;
    protected $tableAllColumnsErrorSystem;

    public function __construct()
    {
        $this->modelNameBlogCategories       = new BlogCategory();
        $this->tableNameBlogCategories       = $this->modelNameBlogCategories->getTable();
        $this->tableAllColumnsBlogCategories = Schema::getColumnListing($this->tableNameBlogCategories);

        $this->modelNameBlogSubcategories       = new BlogSubcategory();
        $this->tableNameBlogSubcategories       = $this->modelNameBlogSubcategories->getTable();
        $this->tableAllColumnsBlogSubcategories = Schema::getColumnListing($this->tableNameBlogSubcategories);

        $this->modelNameErrorSystem          = new ErrorAndNotificationSystem();
        $this->tableNameErrorSystem          = $this->modelNameErrorSystem->getTable();
        $this->tableAllColumnsErrorSystem    = Schema::getColumnListing($this->tableNameErrorSystem);
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
            $apiDisplayAllRecords = $this->modelNameBlogSubcategories->where('blog_subcategory_is_active', '<>', '0')->get();
            if ($apiDisplayAllRecords->isEmpty()) 
            {
                return response([
                    'notify_code'              => 'INFO_0001',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_subcategories.index.info_0001_admin_message', [ 'tableName' => $this->tableNameBlogSubcategories ]),
                ], 404);
            }
            else 
            {
                return response([
                    'notify_code'              => 'INFO_0002',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0002')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0002')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_subcategories.index.info_0002_admin_message'),
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
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0001')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0001')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_subcategories.index.err_0001_admin_message', [ 'tableName' => $this->tableNameBlogSubcategories ]),
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
                'blog_category_id'                   => 'required', // TODO: how to validated dropdown list
                'blog_subcategory_title'             => 'required|regex:/^[a-zA-Z_ ]+$/u|max:255',
                'blog_subcategory_short_description' => 'required|max:255',
                'blog_subcategory_description'       => 'required',
                // 'blog_subcategory_is_active'         => 'accepted',
            ]);
            $apiInsertSingleRecord = $this->modelNameBlogSubcategories->create([
                'blog_category_id'                   => $request->get('blog_category_id'),
                'blog_subcategory_title'             => $request->get('blog_subcategory_title'),
                'blog_subcategory_short_description' => $request->get('blog_subcategory_short_description'),
                'blog_subcategory_description'       => $request->get('blog_subcategory_description'),
                'blog_subcategory_is_active'         => $request->get('blog_subcategory_is_active'),
            ]);
            if ($request->get('blog_subcategory_is_active') === '1') 
            {
                return response([
                    'notify_code'              => 'INFO_0003',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0003')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0003')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_subcategories.store.info_0003_admin_message', [ 
                        'blogSubcategoryTitle' => $request->get('blog_subcategory_title'),
                        'blogCategoryTitle'    => $this->modelNameBlogCategories::where($this->tableAllColumnsBlogCategories[0], '=', $request->get('blog_category_id'))->pluck($this->tableAllColumnsBlogCategories[1])[0],
                    ]),
                    'records'                  => $apiInsertSingleRecord,
                ], 201);
            }
            else 
            {
                return response([
                    'notify_code'              => 'INFO_0009',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0009')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0009')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_subcategories.store.info_0009_admin_message', [ 'blogSubcategoryTitle' => $request->get('blog_subcategory_title') ]),
                    'records'                  => $apiInsertSingleRecord,
                ], 201);
            }
        }
        catch  (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                return response([
                    'notify_code'              => 'ERR_0001',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0001')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0001')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_subcategories.store.err_0001_admin_message', [ 
                        'blogSubcategoryTitle' => $request->get('blog_subcategory_title'),
                        'tableName'            => $this->tableNameBlogSubcategories,
                    ]),
                ], 500);
            }
            if ($mysqlError->getCode() === '42S22') 
            {
                return response([
                    'notify_code'              => 'ERR_0002',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0002')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0002')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_subcategories.store.err_0002_admin_message', [ 
                        'blogSubcategoryTitle' => $request->get('blog_subcategory_title'),
                        'tableName'            => $this->tableNameBlogSubcategories,
                    ]),
                ], 500);
            }
            if ($mysqlError->getCode() === '23000') 
            {
                return response([
                    'notify_code'              => 'ERR_0003',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0003')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0003')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_subcategories.store.err_0003_admin_message', [ 
                        'blogSubcategoryTitle' => $request->get('blog_subcategory_title'),
                        'tableName'            => $this->tableNameBlogSubcategories,
                    ]),
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
            $apiDisplayAllRecords = $this->modelNameBlogSubcategories->all();
            $apiDisplaySingleRecord = $this->modelNameBlogSubcategories->find($id);
            if ($apiDisplayAllRecords->isEmpty()) 
            {
                return response([
                    'notify_code'              => 'INFO_0001',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_subcategories.show.info_0001_admin_message', [ 'tableName' => $this->tableNameBlogSubcategories ]),
                ], 404);
            }
            elseif (is_null($apiDisplaySingleRecord)) 
            {
                return response([
                    'notify_code'              => 'INFO_0004',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0004')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0004')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_subcategories.show.info_0004_admin_message'),
                ], 404);
            }
            else 
            {
                return response([
                    'notify_code'              => 'INFO_0002',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0002')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0002')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_subcategories.show.info_0002_admin_message', [ 'blogSubcategoryTitle' => $apiDisplaySingleRecord['blog_subcategory_title'] ]),
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
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0001')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0001')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_subcategories.show.err_0001_admin_message', [ 'tableName' => $this->tableNameBlogSubcategories ]),
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
            $apiUpdateSingleRecord = $this->modelNameBlogSubcategories->find($id);
            $apiUpdateSingleRecord->update($request->validate([
                'blog_category_id'                   => 'required', // TODO: how to validated dropdown list
                'blog_subcategory_title'             => 'required|regex:/^[a-zA-Z_ ]+$/u|max:255',
                'blog_subcategory_short_description' => 'required|max:255',
                'blog_subcategory_description'       => 'required',
                // 'blog_subcategory_is_active'         => 'accepted',
            ]));
            return response([
                'notify_code'              => 'INFO_0008',
                'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0008')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0008')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                'admin_message'            => __('blog_categories.update.info_0008_admin_message', [ 'blogSubcategoryTitle' => $request->get('blog_subcategory_title') ]),
                'records'                  => $apiUpdateSingleRecord,
            ], 201);
        }
        catch (\Illuminate\Database\QueryException $mysqlError) 
        {
            if ($mysqlError->getCode() === '42S02')
            {
                return response([
                    'notify_code'              => 'ERR_0001',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0001')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0001')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_subcategories.update.err_0001_admin_message', [ 
                        'blogSubcategoryTitle' => $request->get('blog_subcategory_title'),
                        'tableName'            => $this->tableNameBlogSubcategories,
                    ]),
                ], 500);
            }
            if ($mysqlError->getCode() === '42S22') 
            {
                return response([
                    'notify_code'              => 'ERR_0002',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0002')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0002')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_subcategories.update.err_0001_admin_message', [ 
                        'blogSubcategoryTitle' => $request->get('blog_subcategory_title'),
                        'tableName'            => $this->tableNameBlogSubcategories,
                    ]),
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
            $apiDisplayAllRecords = $this->modelNameBlogSubcategories->all();
            $apiDisplaySingleRecord = $this->modelNameBlogSubcategories->find($id);
            if ($apiDisplayAllRecords->isEmpty()) 
            {
                return response([
                    'notify_code'              => 'INFO_0001',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_subcategories.delete.info_0001_admin_message', [ 'tableName' => $this->tableNameBlogSubcategories ]),
                ], 404);
            }
            elseif (is_null($apiDisplaySingleRecord)) 
            {
                return response([
                    'notify_code'              => 'INFO_0005',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0005')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0005')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_subcategories.delete.info_0005_admin_message'),
                ], 404);
            }
            else 
            {
                $apiDeleteSingleRecord = $this->modelNameBlogSubcategories->find($id)->delete();
                return response([
                    'notify_code'              => 'INFO_0006',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0006')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0006')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_subcategories.delete.info_0006_admin_message', [ 'blogSubcategoryTitle' => $apiDisplaySingleRecord['blog_subcategory_title'] ]),
                    'delete_records'            => $apiDisplaySingleRecord,
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
                    'admin_message'            => __('blog_subcategories.delete.err_0001_admin_message', [ 'blogSubcategoryTitle' => $apiDisplaySingleRecord['blog_subcategory_title'] ]),
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
            $apiDisplayAllRecords = $this->modelNameBlogSubcategories->all();
            if ($apiDisplayAllRecords->isEmpty()) 
            {
                return response([
                    'notify_code'              => 'INFO_0001',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_subcategories.delete_all_records.info_0001_admin_message', [ 'tableName' => $this->tableNameBlogSubcategories ]),
                ], 404);
            }
            elseif (is_null($apiDisplayAllRecords)) 
            {
                return response([
                    'notify_code'              => 'INFO_0005',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0005')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0005')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_subcategories.delete_all_records.info_0005_admin_message'),
                ], 404);
            }
            else 
            {
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                $apiDeleteSingleRecord = $this->modelNameBlogSubcategories->truncate();
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                return response([
                    'notify_code'              => 'INFO_0007',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0007')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0007')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_subcategories.delete_all_records.info_0007_admin_message'),
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
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0001')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0001')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_subcategories.delete_all_records.err_0001_admin_message'),
                ], 500);
            }
        }
    }
}
