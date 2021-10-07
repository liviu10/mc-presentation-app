<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\ErrorAndNotificationSystem;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class BlogCategoryController extends Controller
{
    protected $modelNameBlogCategories;
    protected $tableNameBlogCategories;
    protected $tableAllColumnsBlogCategories;

    protected $modelNameErrorSystem;
    protected $tableNameErrorSystem;
    protected $tableAllColumnsErrorSystem;

    public function __construct()
    {
        $this->modelNameBlogCategories       = new BlogCategory();
        $this->tableNameBlogCategories       = $this->modelNameBlogCategories->getTable();
        $this->tableAllColumnsBlogCategories = Schema::getColumnListing($this->tableNameBlogCategories);

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
            $apiDisplayAllRecords = $this->modelNameBlogCategories->where('blog_category_is_active', '<>', '0')->get();
            if ($apiDisplayAllRecords->isEmpty()) 
            {
                return response([
                    'notify_code'              => 'INFO_0001',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_categories.index.info_0001_admin_message', [ 'tableName' => $this->tableNameBlogCategories ]),
                ], 404);
            }
            else 
            {
                return response([
                    'notify_code'              => 'INFO_0002',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0002')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0002')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_categories.index.info_0002_admin_message'),
                    'records'                  => $apiDisplayAllRecords,
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
                    'admin_message'            => __('blog_categories.index.err_0001_admin_message', [ 'tableName' => $this->tableNameBlogCategories ]),
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
                'blog_category_title'             => 'required|unique:blog_categories|regex:/^[a-zA-Z_ ]+$/u|max:255',
                'blog_category_short_description' => 'required|max:255',
                'blog_category_description'       => 'required',
                // 'blog_category_is_active'         => 'accepted',
                'blog_image_card_url'             => 'required|max:255',
                'blog_category_path'              => 'required|max:255',
            ]);
            $apiInsertSingleRecord = $this->modelNameBlogCategories->create([
                'blog_category_title'             => $request->get('blog_category_title'),
                'blog_category_short_description' => $request->get('blog_category_short_description'),
                'blog_category_description'       => $request->get('blog_category_description'),
                'blog_category_is_active'         => $request->get('blog_category_is_active'),
                'blog_image_card_url'             => $request->get('blog_image_card_url'),
                'blog_category_path'              => $request->get('blog_category_path'),
            ]);
            if ($request->get('blog_category_is_active') === '1') 
            {
                return response([
                    'notify_code'              => 'INFO_0003',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0003')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0003')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_categories.store.info_0003_admin_message', [ 'blogCategoryTitle' => $request->get('blog_category_title') ]),
                    'records'                  => $apiInsertSingleRecord,
                ], 201);
            }
            else 
            {
                return response([
                    'notify_code'              => 'INFO_0009',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0009')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0009')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_categories.store.info_0009_admin_message', [ 'blogCategoryTitle' => $request->get('blog_category_title') ]),
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
                    'admin_message'            => __('blog_categories.store.err_0001_admin_message', [ 
                        'blogCategoryTitle'    => $request->get('blog_category_title'),
                        'tableName'            => $this->tableNameBlogCategories,
                    ]),
                ], 500);
            }
            if ($mysqlError->getCode() === '42S22') 
            {
                return response([
                    'notify_code'              => 'ERR_0002',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0002')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0002')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_categories.store.err_0002_admin_message', [ 
                        'blogCategoryTitle'    => $request->get('blog_category_title'),
                        'tableName'            => $this->tableNameBlogCategories,
                    ]),
                ], 500);
            }
            if ($mysqlError->getCode() === '23000') 
            {
                return response([
                    'notify_code'              => 'ERR_0003',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0003')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0003')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_categories.store.err_0003_admin_message', [ 
                        'blogCategoryTitle'    => $request->get('blog_category_title'),
                        'tableName'            => $this->tableNameBlogCategories,
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
            $apiDisplayAllRecords = $this->modelNameBlogCategories->all();
            $apiDisplaySingleRecord = $this->modelNameBlogCategories->find($id);
            if ($apiDisplayAllRecords->isEmpty()) 
            {
                return response([
                    'notify_code'              => 'INFO_0001',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_categories.show.info_0001_admin_message', [ 'tableName' => $this->tableNameBlogCategories ]),
                ], 404);
            }
            elseif (is_null($apiDisplaySingleRecord)) 
            {
                return response([
                    'notify_code'              => 'INFO_0004',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0004')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0004')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_categories.show.info_0004_admin_message'),
                ], 404);
            }
            else 
            {
                return response([
                    'notify_code'              => 'INFO_0002',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0002')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0002')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_categories.show.info_0002_admin_message', [ 'blogCategoryTitle' => $apiDisplaySingleRecord['blog_category_title'] ]),
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
                    'admin_message'            => __('blog_categories.show.err_0001_admin_message', [ 'tableName' => $this->tableNameBlogCategories ]),
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
            $apiUpdateSingleRecord = $this->modelNameBlogCategories->find($id);
            $request->validate([
                'blog_category_title'             => 'required|regex:/^[a-zA-Z_ ]+$/u|max:255',
                'blog_category_short_description' => 'required|max:255',
                'blog_category_description'       => 'required',
                // 'blog_category_is_active'         => 'accepted',
                'blog_image_card_url'             => 'required|max:255',
                'blog_category_path'              => 'required|max:255',
            ]);
            if ($request->get('blog_category_is_active') === '1' && str_word_count($request->get('blog_category_title')) === 1)
            {
                $apiUpdateSingleRecord->update([
                    'blog_category_title'             => $request->get('blog_category_title'),
                    'blog_category_short_description' => $request->get('blog_category_short_description'),
                    'blog_category_description'       => $request->get('blog_category_description'),
                    'blog_category_is_active'         => '1',
                    'blog_image_card_url'             => '/' . strtolower($request->get('blog_category_title')),
                    'blog_category_path'              => strtolower($request->get('blog_category_path')),
                ]);
            }
            elseif ($request->get('blog_category_is_active') === '0' && str_word_count($request->get('blog_category_title')) === 1)
            {
                $apiUpdateSingleRecord->update([
                    'blog_category_title'             => $request->get('blog_category_title'),
                    'blog_category_short_description' => $request->get('blog_category_short_description'),
                    'blog_category_description'       => $request->get('blog_category_description'),
                    'blog_category_is_active'         => '0',
                    'blog_image_card_url'             => '/' . strtolower($request->get('blog_category_title')),
                    'blog_category_path'              => strtolower($request->get('blog_category_path')),
                ]);
            }
            elseif ($request->get('blog_subcategory_is_active') === '1' && str_word_count($request->get('blog_category_title')) > 1) 
            {
                $apiUpdateSingleRecord->update([
                    'blog_category_title'             => $request->get('blog_category_title'),
                    'blog_category_short_description' => $request->get('blog_category_short_description'),
                    'blog_category_description'       => $request->get('blog_category_description'),
                    'blog_category_is_active'         => '1',
                    'blog_image_card_url'             => '/' . strtolower(str_replace(' ', '-', $request->get('blog_category_title'))),
                    'blog_category_path'              => strtolower($request->get('blog_category_path')),
                ]);
            }
            else 
            {
                $apiUpdateSingleRecord->update([
                    'blog_category_title'             => $request->get('blog_category_title'),
                    'blog_category_short_description' => $request->get('blog_category_short_description'),
                    'blog_category_description'       => $request->get('blog_category_description'),
                    'blog_category_is_active'         => '0',
                    'blog_image_card_url'             => '/' . strtolower(str_replace(' ', '-', $request->get('blog_category_title'))),
                    'blog_category_path'              => strtolower($request->get('blog_category_path')),
                ]);
            }

            return response([
                'notify_code'              => 'INFO_0008',
                'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0008')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0008')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                'admin_message'            => __('blog_categories.update.info_0008_admin_message', [ 'blogCategoryTitle' => $request->get('blog_category_title') ]),
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
                    'admin_message'            => __('blog_categories.update.err_0001_admin_message', [ 
                        'blogCategoryTitle'    => $request->get('blog_category_title'),
                        'tableName'            => $this->tableNameBlogCategories,
                    ]),
                ], 500);
            }
            if ($mysqlError->getCode() === '42S22') 
            {
                return response([
                    'notify_code'              => 'ERR_0002',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0002')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0002')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_categories.update.err_0002_admin_message', [ 
                        'blogCategoryTitle'    => $request->get('blog_category_title'),
                        'tableName'            => $this->tableNameBlogCategories,
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
            $apiDisplayAllRecords = $this->modelNameBlogCategories->all();
            $apiDisplaySingleRecord = $this->modelNameBlogCategories->find($id);
            if ($apiDisplayAllRecords->isEmpty()) 
            {
                return response([
                    'notify_code'              => 'INFO_0001',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_categories.delete.info_0001_admin_message', [ 'tableName' => $this->tableNameBlogCategories ]),
                ], 404);
            }
            elseif (is_null($apiDisplaySingleRecord)) 
            {
                return response([
                    'notify_code'              => 'INFO_0005',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0005')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0005')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_categories.delete.info_0005_admin_message'),
                ], 404);
            }
            else 
            {
                $apiDeleteSingleRecord = $this->modelNameBlogCategories->find($id)->delete();
                return response([
                    'notify_code'              => 'INFO_0006',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0006')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0006')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_categories.delete.info_0006_admin_message', [ 'blogCategoryTitle' => $apiDisplaySingleRecord['blog_category_title'] ]),
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
                    'admin_message'            => __('blog_categories.delete.err_0001_admin_message', [ 'blogCategoryTitle' => $apiDisplaySingleRecord['blog_category_title'] ]),
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
            $apiDisplayAllRecords = $this->modelNameBlogCategories->all();
            if ($apiDisplayAllRecords->isEmpty()) 
            {
                return response([
                    'notify_code'              => 'INFO_0001',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_categories.delete_all_records.info_0001_admin_message', [ 'tableName' => $this->tableNameBlogCategories ]),
                ], 404);
            }
            elseif (is_null($apiDisplayAllRecords)) 
            {
                return response([
                    'notify_code'              => 'INFO_0005',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0005')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0005')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_categories.delete_all_records.info_0005_admin_message'),
                ], 404);
            }
            else 
            {
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                $apiDeleteSingleRecord = $this->modelNameBlogCategories->truncate();
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                return response([
                    'notify_code'              => 'INFO_0007',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0007')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0007')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_categories.delete_all_records.info_0007_admin_message'),
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
                    'admin_message'            => __('blog_categories.delete_all_records.err_0001_admin_message'),
                ], 500);
            }
        }
    }

    /**
     * Display a listing of all blog main categories and subcategories.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllBlogMainCategories()
    {
        if (response($this->index())->status() === 200) 
        {
            // TODO: How to filter the eager load for each of the records in the blog_categories table
            $allBlogCategoriesAndSubcategories = $this->modelNameBlogCategories::where('blog_category_is_active', '<>', '0')
                                                ->limit(3)
                                                ->with([
                                                    'blog_subcategories' => function ($query) {
                                                        $query->where('blog_subcategory_is_active', '<>', '0');
                                                    }
                                                ])
                                                ->get();
            return response([
                'results'              => $allBlogCategoriesAndSubcategories,
            ], 200);
        }
        else 
        {
            return response([
                'notify_code'              => 'INFO_0018',
                'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0018')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0018')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                'user_message'             => 'The resource you are trying to view does not exist on the server! Please contact the website administrator!',
            ], 404);
        }
    }
}
