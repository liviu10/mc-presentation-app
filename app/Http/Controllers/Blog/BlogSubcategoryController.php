<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogSubcategory;
use App\Models\ErrorAndNotificationSystem;
use Illuminate\Support\Facades\DB;

class BlogSubcategoryController extends Controller
{
    // Blog Subcategories table and necessary columns
    protected $modelNameBlogCategories;
    protected $tableNameBlogCategories;
    protected $blogCategoryId;
    protected $blogSubcategoryId;
    protected $blogSubcategoryTitle;
    protected $blogSubcategoryShortDescription;
    protected $blogSubcategoryDescription;
    protected $blogSubcategoryIsActive;
    protected $blogSubcategorySlug;
    protected $blogCreatedAt;
    protected $blogUpdatedAt;
    protected $blogDeletedAt;

    // Error and Notification System table and necessary columns
    protected $modelNameErrorSystem;
    protected $tableNameErrorSystem;
    protected $notifyCode;
    protected $notifyShortDescription;
    protected $notifyReference;

    /**
     * Instantiate models, tables and necessary columns for
     * Blog Subcategories, Error and Notification System and HTTP responses
     *
     */
    public function __construct()
    {
        $this->modelNameBlogSubcategories      = new BlogSubcategory();
        $this->tableNameBlogSubcategories      = 'blog_subcategories';
        $this->blogCategoryId                  = 'blog_category_id';
        $this->blogSubcategoryId               = 'id';
        $this->blogSubcategoryTitle            = 'blog_subcategory_title';
        $this->blogSubcategoryShortDescription = 'blog_subcategory_short_description';
        $this->blogSubcategoryDescription      = 'blog_subcategory_description';
        $this->blogSubcategoryIsActive         = 'blog_subcategory_is_active';
        $this->blogSubcategorySlug             = 'blog_subcategory_slug';
        $this->blogCreatedAt                   = 'created_at';
        $this->blogUpdatedAt                   = 'updated_at';
        $this->blogDeletedAt                   = 'deleted_at';

        $this->modelNameErrorSystem            = new ErrorAndNotificationSystem();
        $this->tableNameErrorSystem            = 'errors_and_notification_system';
        $this->notifyCode                      = 'notify_code';
        $this->notifyShortDescription          = 'notify_short_description';
        $this->notifyReference                 = 'notify_reference';

        $this->adminMessage                    = 'admin_message';
        $this->userMessage                     = 'user_message';
        $this->records                         = 'records';
        $this->results                         = 'results';
        $this->deletedRecords                  = 'deletedRecords';
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
            $apiDisplayAllRecords = $this->modelNameBlogSubcategories->where($this->blogSubcategoryIsActive, '<>', '0')->get();
            if ($apiDisplayAllRecords->isEmpty()) 
            {
                return response([
                    $this->notifyCode             => 'INFO_0001',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0001')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0001')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_subcategories.index.info_0001_admin_message.message_1', [ 'tableName' => $this->tableNameBlogSubcategories ]),
                ], 404);
            }
            else 
            {
                return response([
                    $this->notifyCode             => 'INFO_0002',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0002')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0002')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_subcategories.index.info_0002_admin_message.message_1'),
                    $this->records                => $apiDisplayAllRecords,
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
                    $this->adminMessage           => __('blog_subcategories.index.err_0001_admin_message', [ 'tableName' => $this->tableNameBlogSubcategories ]),
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
                $this->blogCategoryId                  => 'required', // TODO: How to validate a dropdown list
                $this->blogSubcategoryTitle            => 'required|regex:/^[a-zA-Z_ ]+$/u|max:255',
                $this->blogSubcategoryShortDescription => 'required|max:255',
                $this->blogSubcategoryDescription      => 'required',
            ]);
            $apiInsertSingleRecord = $this->modelNameBlogSubcategories->create([
                $this->blogCategoryId                  => $request->get($this->blogCategoryId),
                $this->blogSubcategoryTitle            => $request->get($this->blogSubcategoryTitle),
                $this->blogSubcategoryShortDescription => $request->get($this->blogSubcategoryShortDescription),
                $this->blogSubcategoryDescription      => $request->get($this->blogSubcategoryDescription),
                $this->blogSubcategoryIsActive         => $request->get($this->blogSubcategoryIsActive),
                $this->blogSubcategorySlug             => $request->get($this->blogSubcategorySlug),
            ]);

            if ($request->get($this->blogSubcategoryIsActive) === '1') 
            {
                return response([
                    $this->notifyCode             => 'INFO_0003',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0003')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0003')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_subcategories.store.info_0003_admin_message', [ 
                        'blogSubcategoryTitle' => $request->get($this->blogSubcategoryTitle),
                        'blogCategoryTitle'    => $this->modelNameBlogCategories::where($this->tableAllColumnsBlogCategories[0], '=', $request->get($this->blogCategoryId))->pluck($this->tableAllColumnsBlogCategories[1])[0],
                    ]),
                    $this->records                => $apiInsertSingleRecord,
                ], 201);
            }
            else 
            {
                return response([
                    $this->notifyCode             => 'INFO_0009',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0009')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0009')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_subcategories.store.info_0009_admin_message', [ 'blogSubcategoryTitle' => $request->get($this->blogSubcategoryTitle) ]),
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
                    $this->adminMessage           => __('blog_subcategories.store.err_0001_admin_message', [ 
                        'blogSubcategoryTitle' => $request->get($this->blogSubcategoryTitle),
                        'tableName'            => $this->tableNameBlogSubcategories,
                    ]),
                ], 500);
            }
            if ($mysqlError->getCode() === '42S22') 
            {
                return response([
                    $this->notifyCode             => 'ERR_0002',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0002')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0002')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_subcategories.store.err_0002_admin_message', [ 
                        'blogSubcategoryTitle' => $request->get($this->blogSubcategoryTitle),
                        'tableName'            => $this->tableNameBlogSubcategories,
                    ]),
                ], 500);
            }
            if ($mysqlError->getCode() === '23000') 
            {
                return response([
                    $this->notifyCode             => 'ERR_0003',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0003')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0003')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_subcategories.store.err_0003_admin_message', [ 
                        'blogSubcategoryTitle' => $request->get($this->blogSubcategoryTitle),
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
                    $this->notifyCode             => 'INFO_0001',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0001')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0001')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_subcategories.show.info_0001_admin_message', [ 'tableName' => $this->tableNameBlogSubcategories ]),
                ], 404);
            }
            elseif (is_null($apiDisplaySingleRecord)) 
            {
                return response([
                    $this->notifyCode             => 'INFO_0004',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0004')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0004')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_subcategories.show.info_0004_admin_message'),
                ], 404);
            }
            else 
            {
                return response([
                    $this->notifyCode             => 'INFO_0002',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0002')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0002')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_subcategories.show.info_0002_admin_message', [ 'blogSubcategoryTitle' => $apiDisplaySingleRecord[$this->blogSubcategoryTitle] ]),
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
                    $this->adminMessage           => __('blog_subcategories.show.err_0001_admin_message', [ 'tableName' => $this->tableNameBlogSubcategories ]),
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
            $request->validate([
                $this->blogCategoryId                  => 'required', // TODO: How to validate a dropdown list
                $this->blogSubcategoryTitle            => 'required|regex:/^[a-zA-Z_ ]+$/u|max:255',
                $this->blogSubcategoryShortDescription => 'required|max:255',
                $this->blogSubcategoryDescription      => 'required',
            ]);
            if ($request->get($this->blogSubcategoryIsActive) === '1') 
            {
                $apiUpdateSingleRecord->update([
                    $this->blogCategoryId                  => $request->get($this->blogCategoryId),
                    $this->blogSubcategoryTitle            => $request->get($this->blogSubcategoryTitle),
                    $this->blogSubcategoryShortDescription => $request->get($this->blogSubcategoryShortDescription),
                    $this->blogSubcategoryDescription      => $request->get($this->blogSubcategoryDescription),
                    $this->blogSubcategoryIsActive         => '1',
                    $this->blogSubcategorySlug             => $request->get($this->blogSubcategorySlug),
                ]);
            }
            else 
            {
                $apiUpdateSingleRecord->update([
                    $this->blogCategoryId                  => $request->get($this->blogCategoryId),
                    $this->blogSubcategoryTitle            => $request->get($this->blogSubcategoryTitle),
                    $this->blogSubcategoryShortDescription => $request->get($this->blogSubcategoryShortDescription),
                    $this->blogSubcategoryDescription      => $request->get($this->blogSubcategoryDescription),
                    $this->blogSubcategoryIsActive         => '0',
                    $this->blogSubcategorySlug             => $request->get($this->blogSubcategorySlug),
                ]);
            }

            return response([
                $this->notifyCode             => 'INFO_0008',
                $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0008')->pluck($this->notifyShortDescription)[0],
                $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0008')->pluck($this->notifyReference)[0],
                $this->adminMessage           => __('blog_subcategories.update.info_0008_admin_message', [ 'blogSubcategoryTitle' => $request->get($this->blogSubcategoryTitle) ]),
                $this->records                => $apiUpdateSingleRecord,
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
                    $this->adminMessage           => __('blog_subcategories.update.err_0001_admin_message', [ 
                        'blogSubcategoryTitle' => $request->get($this->blogSubcategoryTitle),
                        'tableName'            => $this->tableNameBlogSubcategories,
                    ]),
                ], 500);
            }
            if ($mysqlError->getCode() === '42S22') 
            {
                return response([
                    $this->notifyCode             => 'ERR_0002',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0002')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0002')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_subcategories.update.err_0001_admin_message', [ 
                        'blogSubcategoryTitle' => $request->get($this->blogSubcategoryTitle),
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
                    $this->notifyCode             => 'INFO_0001',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0001')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0001')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_subcategories.delete.info_0001_admin_message', [ 'tableName' => $this->tableNameBlogSubcategories ]),
                ], 404);
            }
            elseif (is_null($apiDisplaySingleRecord)) 
            {
                return response([
                    $this->notifyCode             => 'INFO_0005',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0005')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0005')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_subcategories.delete.info_0005_admin_message'),
                ], 404);
            }
            else 
            {
                $apiDeleteSingleRecord = $this->modelNameBlogSubcategories->find($id)->delete();
                return response([
                    $this->notifyCode             => 'INFO_0006',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0006')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0006')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_subcategories.delete.info_0006_admin_message', [ 'blogSubcategoryTitle' => $apiDisplaySingleRecord[$this->blogSubcategoryTitle] ]),
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
                    $this->adminMessage           => __('blog_subcategories.delete.err_0001_admin_message', [ 'blogSubcategoryTitle' => $apiDisplaySingleRecord[$this->blogSubcategoryTitle] ]),
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
                    $this->notifyCode             => 'INFO_0001',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0001')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0001')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_subcategories.delete_all_records.info_0001_admin_message', [ 'tableName' => $this->tableNameBlogSubcategories ]),
                ], 404);
            }
            elseif (is_null($apiDisplayAllRecords)) 
            {
                return response([
                    $this->notifyCode             => 'INFO_0005',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0005')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0005')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_subcategories.delete_all_records.info_0005_admin_message'),
                ], 404);
            }
            else 
            {
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                $apiDeleteSingleRecord = $this->modelNameBlogSubcategories->truncate();
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                return response([
                    $this->notifyCode             => 'INFO_0007',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0007')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0007')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_subcategories.delete_all_records.info_0007_admin_message'),
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
                    $this->adminMessage           => __('blog_subcategories.delete_all_records.err_0001_admin_message'),
                ], 500);
            }
        }
    }

    /**
     * Display a list of all blog written articles for a given blog subcategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAllBlogSubcategoryWrittenArticles($id)
    {
        if (response($this->index())->status() === 200) 
        {
            $allWrittenArticlesForSubcategory = $this->modelNameBlogSubcategories::select(
                $this->blogSubcategoryId,
                $this->blogCategoryId,
                $this->blogSubcategoryTitle,
            )
            ->where($this->blogSubcategoryId, '=', $id)
            ->where($this->blogCategoryId, '=', '1')
            ->where($this->blogSubcategoryIsActive, '<>', '0')
            ->with([
                // TODO: How do you load a parent through the belongsTo method (many to one relationship)
                'blog_articles' => function ($query) {
                    $query->select(
                            'blog_subcategory_id',
                            'id',
                            'blog_article_title',
                            'blog_article_time',
                            'created_at',
                            'updated_at',
                            'blog_article_short_description',
                        )
                        ->where('blog_article_is_active', '<>', '0');
                },
            ])
            ->get();
            return response([
                $this->notifyCode  => 'INFO_0002',
                $this->userMessage => __('blog_subcategories.index.info_0002_admin_message.message_2'),
                $this->results     => $allWrittenArticlesForSubcategory,
            ], 200);

            if ($allWrittenArticlesForSubcategory->isEmpty()) 
            {
                return response([
                    $this->notifyCode  => 'INFO_0001',
                    $this->userMessage => __('blog_subcategories.index.info_0001_admin_message.message_2'),
                    $this->results     => $allWrittenArticlesForSubcategory,
                ], 200);
            }
            else 
            {
                return response([
                    $this->notifyCode  => 'INFO_0002',
                    $this->userMessage => __('blog_subcategories.index.info_0002_admin_message.message_2'),
                    $this->results     => $allWrittenArticlesForSubcategory,
                ], 200);
            }
        }
        else 
        {
            return response([
                $this->notifyCode             => 'INFO_0018',
                $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0018')->pluck($this->notifyShortDescription)[0],
                $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0018')->pluck($this->notifyReference)[0],
                $this->userMessage            => 'The resource you are trying to view does not exist on the server! Please contact the website administrator!',
            ], 404);
        }
    }

    /**
     * Display a list of all blog audio articles for a given blog subcategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAllBlogSubcategoryAudioArticles($id)
    {
        if (response($this->index())->status() === 200) 
        {
            $allWrittenArticlesForSubcategory = $this->modelNameBlogSubcategories::select(
                $this->blogSubcategoryId,
                $this->blogCategoryId,
                $this->blogSubcategoryTitle,
            )
            ->where($this->blogSubcategoryId, '=', $id)
            ->where($this->blogCategoryId, '=', '2')
            ->where($this->blogSubcategoryIsActive, '<>', '0')
            ->with([
                // TODO: How do you load a parent through the belongsTo method (many to one relationship)
                'blog_articles' => function ($query) {
                    $query->select(
                            'blog_subcategory_id',
                            'id',
                            'blog_article_title',
                            'blog_article_time',
                            'created_at',
                            'updated_at',
                            'blog_article_short_description',
                        )
                        ->where('blog_article_is_audio', '=', '1')
                        ->where('blog_article_is_active', '<>', '0');
                },
            ])
            ->get();
            return response([
                $this->notifyCode  => 'INFO_0002',
                $this->userMessage => __('blog_subcategories.index.info_0002_admin_message.message_2'),
                $this->results     => $allWrittenArticlesForSubcategory,
            ], 200);

            if ($allWrittenArticlesForSubcategory->isEmpty()) 
            {
                return response([
                    $this->notifyCode  => 'INFO_0001',
                    $this->userMessage => __('blog_subcategories.index.info_0001_admin_message.message_2'),
                    $this->results     => $allWrittenArticlesForSubcategory,
                ], 200);
            }
            else 
            {
                return response([
                    $this->notifyCode  => 'INFO_0002',
                    $this->userMessage => __('blog_subcategories.index.info_0002_admin_message.message_2'),
                    $this->results     => $allWrittenArticlesForSubcategory,
                ], 200);
            }
        }
        else 
        {
            return response([
                $this->notifyCode             => 'INFO_0018',
                $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0018')->pluck($this->notifyShortDescription)[0],
                $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0018')->pluck($this->notifyReference)[0],
                $this->userMessage            => 'The resource you are trying to view does not exist on the server! Please contact the website administrator!',
            ], 404);
        }
    }

    /**
     * Display a list of all blog video articles for a given blog subcategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAllBlogSubcategoryVideoArticles($id)
    {
        if (response($this->index())->status() === 200) 
        {
            $allWrittenArticlesForSubcategory = $this->modelNameBlogSubcategories::select(
                $this->blogSubcategoryId,
                $this->blogCategoryId,
                $this->blogSubcategoryTitle,
            )
            ->where($this->blogSubcategoryId, '=', $id)
            ->where($this->blogCategoryId, '=', '3')
            ->where($this->blogSubcategoryIsActive, '<>', '0')
            ->with([
                // TODO: How do you load a parent through the belongsTo method (many to one relationship)
                'blog_articles' => function ($query) {
                    $query->select(
                            'blog_subcategory_id',
                            'id',
                            'blog_article_title',
                            'blog_article_time',
                            'created_at',
                            'updated_at',
                            'blog_article_short_description',
                        )
                        ->where('blog_article_is_active', '<>', '0');
                },
            ])
            ->get();
            return response([
                $this->notifyCode  => 'INFO_0002',
                $this->userMessage => __('blog_subcategories.index.info_0002_admin_message.message_2'),
                $this->results     => $allWrittenArticlesForSubcategory,
            ], 200);

            if ($allWrittenArticlesForSubcategory->isEmpty()) 
            {
                return response([
                    $this->notifyCode  => 'INFO_0001',
                    $this->userMessage => __('blog_subcategories.index.info_0001_admin_message.message_2'),
                    $this->results     => $allWrittenArticlesForSubcategory,
                ], 200);
            }
            else 
            {
                return response([
                    $this->notifyCode  => 'INFO_0002',
                    $this->userMessage => __('blog_subcategories.index.info_0002_admin_message.message_2'),
                    $this->results     => $allWrittenArticlesForSubcategory,
                ], 200);
            }
        }
        else 
        {
            return response([
                $this->notifyCode             => 'INFO_0018',
                $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0018')->pluck($this->notifyShortDescription)[0],
                $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0018')->pluck($this->notifyReference)[0],
                $this->userMessage            => 'The resource you are trying to view does not exist on the server! Please contact the website administrator!',
            ], 404);
        }
    }
}
