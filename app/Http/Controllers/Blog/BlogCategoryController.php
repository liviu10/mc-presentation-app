<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\ErrorAndNotificationSystem;
use Illuminate\Support\Facades\DB;

class BlogCategoryController extends Controller
{
    // Blog Categories table and necessary columns
    protected $modelNameBlogCategories;
    protected $tableNameBlogCategories;
    protected $blogCategoryId;
    protected $blogCategoryTitle;
    protected $blogCategoryShortDescription;
    protected $blogCategoryDescription;
    protected $blogCategoryIsActive;
    protected $blogImageCardUrl;
    protected $blogCategoryPath;
    protected $blogCreatedAt;
    protected $blogUpdatedAt;
    protected $blogDeletedAt;

    // Error and Notification System table and necessary columns
    protected $modelNameErrorSystem;
    protected $tableNameErrorSystem;
    protected $notifyCode;
    protected $notifyShortDescription;
    protected $notifyReference;

    // HTTP response object attributes
    protected $adminMessage;
    protected $userMessage;
    protected $records;
    protected $results;
    protected $deletedRecords;

    /**
     * Instantiate models, tables and necessary columns for
     * Blog Categories, Error and Notification System and HTTP responses
     *
     */
    public function __construct()
    {
        $this->modelNameBlogCategories      = new BlogCategory();
        $this->tableNameBlogCategories      = 'blog_categories';
        $this->blogCategoryId               = 'id';
        $this->blogCategoryTitle            = 'blog_category_title';
        $this->blogCategoryShortDescription = 'blog_category_short_description';
        $this->blogCategoryDescription      = 'blog_category_description';
        $this->blogCategoryIsActive         = 'blog_category_is_active';
        $this->blogImageCardUrl             = 'blog_image_card_url';
        $this->blogCategoryPath             = 'blog_category_path';
        $this->blogCreatedAt                = 'created_at';
        $this->blogUpdatedAt                = 'updated_at';
        $this->blogDeletedAt                = 'deleted_at';

        $this->modelNameErrorSystem         = new ErrorAndNotificationSystem();
        $this->tableNameErrorSystem         = 'errors_and_notification_system';
        $this->notifyCode                   = 'notify_code';
        $this->notifyShortDescription       = 'notify_short_description';
        $this->notifyReference              = 'notify_reference';

        $this->adminMessage                 = 'admin_message';
        $this->userMessage                  = 'user_message';
        $this->records                      = 'records';
        $this->results                      = 'results';
        $this->deletedRecords               = 'deletedRecords';
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
            if (empty($this->modelNameBlogCategories)) 
            {
                return response([
                    $this->notifyCode             => 'INFO_0001',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0001')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0001')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_categories.index.info_0001_admin_message.message_1', [ 'tableName' => $this->tableNameBlogCategories ]),
                ], 404);
            }
            else 
            {
                $apiDisplayAllRecords = $this->modelNameBlogCategories->where($this->blogCategoryIsActive, '<>', '0')->get();
                return response([
                    $this->notifyCode             => 'INFO_0002',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0002')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0002')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_categories.index.info_0002_admin_message'),
                    $this->records                => $apiDisplayAllRecords,
                ], 200);
            }
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                return response([
                    $this->notifyCode             => 'ERR_0001',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0001')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0001')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_categories.index.err_0001_admin_message.message_1', [ 'tableName' => $this->tableNameBlogCategories ]),
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
                $this->blogCategoryTitle            => 'required|unique:blog_categories|regex:/^[a-zA-Z_ ]+$/u|max:255',
                $this->blogCategoryShortDescription => 'required|max:255',
                $this->blogCategoryDescription      => 'required',
                $this->blogImageCardUrl             => 'required|max:255',
                $this->blogCategoryPath             => 'required|max:255',
            ]);
            $apiInsertSingleRecord = $this->modelNameBlogCategories->create([
                $this->blogCategoryTitle            => $request->get($this->blogCategoryTitle),
                $this->blogCategoryShortDescription => $request->get($this->blogCategoryShortDescription),
                $this->blogCategoryDescription      => $request->get($this->blogCategoryDescription),
                $this->blogCategoryIsActive         => $request->get($this->blogCategoryIsActive),
                $this->blogImageCardUrl             => $request->get($this->blogImageCardUrl),
                $this->blogCategoryPath             => $request->get($this->blogCategoryPath),
            ]);
            if ($request->get($this->blogCategoryIsActive) === '1') 
            {
                return response([
                    $this->notifyCode             => 'INFO_0003',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0003')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0003')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_categories.store.info_0003_admin_message', [ 'blogCategoryTitle' => $request->get($this->blogCategoryTitle) ]),
                    $this->records                => $apiInsertSingleRecord,
                ], 201);
            }
            else 
            {
                return response([
                    $this->notifyCode             => 'INFO_0009',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0009')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0009')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_categories.store.info_0009_admin_message', [ 'blogCategoryTitle' => $request->get($this->blogCategoryTitle) ]),
                    $this->records                => $apiInsertSingleRecord,
                ], 201);
            }
        }
        catch  (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                return response([
                    $this->notifyCode             => 'ERR_0001',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0001')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0001')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_categories.store.err_0001_admin_message', [ 
                        'blogCategoryTitle'    => $request->get($this->blogCategoryTitle),
                        'tableName'            => $this->tableNameBlogCategories,
                    ]),
                ], 500);
            }
            if ($mysqlError->getCode() === '42S22') 
            {
                return response([
                    $this->notifyCode             => 'ERR_0002',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0002')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0002')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_categories.store.err_0002_admin_message', [ 
                        'blogCategoryTitle'    => $request->get($this->blogCategoryTitle),
                        'tableName'            => $this->tableNameBlogCategories,
                    ]),
                ], 500);
            }
            if ($mysqlError->getCode() === '23000') 
            {
                return response([
                    $this->notifyCode             => 'ERR_0003',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0003')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0003')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_categories.store.err_0003_admin_message', [ 
                        'blogCategoryTitle'    => $request->get($this->blogCategoryTitle),
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
                    $this->notifyCode             => 'INFO_0001',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0001')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0001')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_categories.show.info_0001_admin_message.message_1', [ 'tableName' => $this->tableNameBlogCategories ]),
                ], 404);
            }
            elseif (is_null($apiDisplaySingleRecord)) 
            {
                return response([
                    $this->notifyCode             => 'INFO_0004',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0004')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0004')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_categories.show.info_0004_admin_message'),
                ], 404);
            }
            else 
            {
                return response([
                    $this->notifyCode             => 'INFO_0002',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0002')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0002')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_categories.show.info_0002_admin_message', [ 'blogCategoryTitle' => $apiDisplaySingleRecord[$this->blogCategoryTitle] ]),
                    $this->records                => $apiDisplaySingleRecord,
                ], 201);
            }
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                return response([
                    $this->notifyCode             => 'ERR_0001',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0001')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0001')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_categories.show.err_0001_admin_message', [ 'tableName' => $this->tableNameBlogCategories ]),
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
                $this->blogCategoryTitle            => 'required|regex:/^[a-zA-Z_ ]+$/u|max:255',
                $this->blogCategoryShortDescription => 'required|max:255',
                $this->blogCategoryDescription      => 'required',
                $this->blogImageCardUrl             => 'required|max:255',
                $this->blogCategoryPath             => 'required|max:255',
            ]);
            if ($request->get($this->blogCategoryIsActive) === '1')
            {
                $apiUpdateSingleRecord->update([
                    $this->blogCategoryTitle            => $request->get($this->blogCategoryTitle),
                    $this->blogCategoryShortDescription => $request->get($this->blogCategoryShortDescription),
                    $this->blogCategoryDescription      => $request->get($this->blogCategoryDescription),
                    $this->blogCategoryIsActive         => '1',
                    $this->blogImageCardUrl             => $request->get($this->blogImageCardUrl),
                    $this->blogCategoryPath             => strtolower($request->get($this->blogCategoryPath)),
                ]);
            }
            else 
            {
                $apiUpdateSingleRecord->update([
                    $this->blogCategoryTitle            => $request->get($this->blogCategoryTitle),
                    $this->blogCategoryShortDescription => $request->get($this->blogCategoryShortDescription),
                    $this->blogCategoryDescription      => $request->get($this->blogCategoryDescription),
                    $this->blogCategoryIsActive         => '0',
                    $this->blogImageCardUrl             => $request->get($this->blogImageCardUrl),
                    $this->blogCategoryPath             => strtolower($request->get($this->blogCategoryPath)),
                ]);
            }

            return response([
                $this->notifyCode                 => 'INFO_0008',
                $this->notifyShortDescription     => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0008')->pluck($this->notifyShortDescription)[0],
                $this->notifyReference            => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0008')->pluck($this->notifyReference)[0],
                $this->adminMessage               => __('blog_categories.update.info_0008_admin_message', [ 'blogCategoryTitle' => $request->get($this->blogCategoryTitle) ]),
                $this->records                    => $apiUpdateSingleRecord,
            ], 201);
        }
        catch (\Illuminate\Database\QueryException $mysqlError) 
        {
            if ($mysqlError->getCode() === '42S02')
            {
                return response([
                    $this->notifyCode             => 'ERR_0001',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0001')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0001')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_categories.update.err_0001_admin_message', [ 
                        'blogCategoryTitle'    => $request->get($this->blogCategoryTitle),
                        'tableName'            => $this->tableNameBlogCategories,
                    ]),
                ], 500);
            }
            if ($mysqlError->getCode() === '42S22') 
            {
                return response([
                    $this->notifyCode             => 'ERR_0002',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0002')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0002')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_categories.update.err_0002_admin_message', [ 
                        'blogCategoryTitle'    => $request->get($this->blogCategoryTitle),
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
                    $this->notifyCode             => 'INFO_0001',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0001')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0001')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_categories.delete.info_0001_admin_message.message_1', [ 'tableName' => $this->tableNameBlogCategories ]),
                ], 404);
            }
            elseif (is_null($apiDisplaySingleRecord)) 
            {
                return response([
                    $this->notifyCode             => 'INFO_0005',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0005')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0005')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_categories.delete.info_0005_admin_message'),
                ], 404);
            }
            else 
            {
                $apiDeleteSingleRecord = $this->modelNameBlogCategories->find($id)->delete();
                return response([
                    $this->notifyCode             => 'INFO_0006',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0006')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0006')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_categories.delete.info_0006_admin_message', [ 'blogCategoryTitle' => $apiDisplaySingleRecord[$this->blogCategoryTitle] ]),
                    $this->deletedRecords         => $apiDisplaySingleRecord,
                ], 200);
            }
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                return response([
                    $this->notifyCode             => 'ERR_0001',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0001')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0001')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_categories.delete.err_0001_admin_message', [ 'blogCategoryTitle' => $apiDisplaySingleRecord[$this->blogCategoryTitle] ]),
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
                    $this->notifyCode             => 'INFO_0001',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0001')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0001')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_categories.delete_all_records.info_0001_admin_message.message_1', [ 'tableName' => $this->tableNameBlogCategories ]),
                ], 404);
            }
            elseif (is_null($apiDisplayAllRecords)) 
            {
                return response([
                    $this->notifyCode             => 'INFO_0005',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0005')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0005')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_categories.delete_all_records.info_0005_admin_message'),
                ], 404);
            }
            else 
            {
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                $apiDeleteSingleRecord = $this->modelNameBlogCategories->truncate();
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                return response([
                    $this->notifyCode             => 'INFO_0007',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0007')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0007')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_categories.delete_all_records.info_0007_admin_message'),
                    $this->userMessage            => $apiDisplayAllRecords,
                ], 200);
            }
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                return response([
                    $this->notifyCode             => 'ERR_0001',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0001')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0001')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_categories.delete_all_records.err_0001_admin_message'),
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
            // TODO: Limit blog_subcategories to 3 records for each blog_category record
            $allBlogCategoriesAndSubcategories = $this->modelNameBlogCategories::select(
                                                    $this->blogCategoryId,
                                                    $this->blogCategoryTitle,
                                                    $this->blogCategoryShortDescription,
                                                    $this->blogImageCardUrl,
                                                    $this->blogCategoryPath
                                                )
                                                ->where($this->blogCategoryIsActive, '<>', '0')->limit(3)
                                                ->with([
                                                    'blog_subcategories' => function ($query) {
                                                        $query->select('blog_category_id', 'blog_subcategory_title', 'blog_subcategory_slug')
                                                              ->where('blog_subcategory_is_active', '<>', '0');
                                                    }
                                                ])->get();
            if ($allBlogCategoriesAndSubcategories->isEmpty())
            {
                return response([
                    $this->notifyCode             => 'INFO_0001',
                    $this->userMessage            => __('blog_categories.index.info_0001_admin_message.message_2'),
                    $this->results                => $allBlogCategoriesAndSubcategories,
                ], 404);
            }
            else 
            {
                return response([
                    $this->notifyCode             => 'INFO_0002',
                    $this->userMessage            => __('blog_categories.index.info_0002_admin_message.message_2'),
                    $this->results                => $allBlogCategoriesAndSubcategories,
                ], 200);
            }
        }
        else 
        {
            return response([
                $this->notifyCode                 => 'INFO_0001',
                $this->userMessage                => __('blog_categories.index.info_0001_admin_message.message_2'),
            ], 404);
        }
    }
}
