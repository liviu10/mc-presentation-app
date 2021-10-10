<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogArticleComment;
use App\Models\ErrorAndNotificationSystem;
use Illuminate\Support\Facades\DB;

class BlogArticleCommentController extends Controller
{
    // Blog Article Comments table and necessary columns
    protected $modelNameBlogArticleComment;
    protected $tableNameBlogArticleComment;
    protected $blogCategoryId;
    protected $blogSubcategoryId;
    protected $blogArticleId;
    protected $fullName;
    protected $email;
    protected $comment;
    protected $commentIsPublic;
    protected $privacyPolicy;
    protected $commentCreatedAt;
    protected $commentUpdatedAt;
    protected $commentDeletedAt;

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

    public function __construct()
    {
        $this->modelNameBlogArticleComments = new BlogArticleComment();
        $this->tableNameBlogArticleComments = 'blog_article_comments';
        $this->blogCategoryId               = 'blog_category_id';
        $this->blogSubcategoryId            = 'blog_subcategory_id';
        $this->blogArticleId                = 'blog_article_id';
        $this->fullName                     = 'full_name';
        $this->email                        = 'email';
        $this->comment                      = 'comment';
        $this->commentIsPublic              = 'comment_is_public';
        $this->privacyPolicy                = 'privacy_policy';
        $this->commentCreatedAt             = 'created_at';
        $this->commentUpdatedAt             = 'updated_at';
        $this->commentDeletedAt             = 'deleted_at';

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
            $apiDisplayAllRecords = $this->modelNameBlogArticleComments->where($this->commentIsPublic, '<>', '0')->get();
            if ($apiDisplayAllRecords->isEmpty()) 
            {
                return response([
                    $this->notifyCode             => 'INFO_0001',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0001')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0001')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_article_comments.index.info_0001_admin_message', [ 'tableName' => $this->tableNameBlogArticleComments ]),
                ], 404);
            }
            else 
            {
                return response([
                    $this->notifyCode             => 'INFO_0002',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0002')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0002')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_article_comments.index.info_0002_admin_message'),
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
                    $this->adminMessage           => __('blog_article_comments.index.err_0001_admin_message', [ 'tableName' => $this->tableNameBlogArticleComments ]),
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
                $this->blogCategoryId    => 'required', // TODO: How to validate a dropdown list
                $this->blogSubcategoryId => 'required', // TODO: How to validate a dropdown list
                $this->blogArticleId     => 'required', // TODO: How to validate a dropdown list
                $this->fullName          => 'required|regex:/^[a-zA-Z_ ]+$/u|max:255',
                $this->email             => 'required|email:filter|max:255',
                $this->comment           => 'required|max:255',
            ]);
            $apiInsertSingleRecord = $this->modelNameBlogArticleComments->create([
                $this->blogCategoryId    => $request->get($this->blogCategoryId),
                $this->blogSubcategoryId => $request->get($this->blogSubcategoryId),
                $this->blogArticleId     => $request->get($this->blogArticleId),
                $this->fullName          => $request->get($this->fullName),
                $this->email             => $request->get($this->email),
                $this->comment           => $request->get($this->comment),
                $this->commentIsPublic   => $request->get($this->commentIsPublic),
                $this->privacyPolicy     => $request->get($this->privacyPolicy),
            ]);
            if ($request->get($this->commentIsPublic) === '1') 
            {
                return response([
                    $this->notifyCode             => 'INFO_0016',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0016')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0016')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_article_comments.store.info_0016_admin_message', [ 
                        'fullName' => $request->get($this->fullName),
                        'blogArticleTitle'     => $request->get('blog_article_title'),
                    ]),
                    $this->records                => $apiInsertSingleRecord,
                ], 201);
            }
            else
            {
                return response([
                    $this->notifyCode             => 'INFO_0017',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0017')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0017')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_article_comments.store.info_0017_admin_message', [ 
                        'fullName' => $request->get($this->fullName),
                        'blogArticleTitle'     => $request->get('blog_article_title'),
                    ]),
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
                    $this->adminMessage           => __('blog_article_comments.store.err_0001_admin_message', [ 'tableName' => $this->tableAllColumnsBlogArticleComments, ]),
                ], 500);
            }
            if ($mysqlError->getCode() === '42S22') 
            {
                return response([
                    $this->notifyCode             => 'ERR_0002',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0002')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0002')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_article_comments.store.err_0002_admin_message', [ 'tableName' => $this->tableAllColumnsBlogArticleComments, ]),
                ], 500);
            }
            if ($mysqlError->getCode() === '23000') 
            {
                return response([
                    $this->notifyCode             => 'ERR_0003',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0003')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0003')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_article_comments.store.err_0003_admin_message', [ 'tableName' => $this->tableAllColumnsBlogArticleComments, ]),
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
            $apiDisplayAllRecords = $this->modelNameBlogArticleComments->all();
            $apiDisplaySingleRecord = $this->modelNameBlogArticleComments->find($id);
            if ($apiDisplayAllRecords->isEmpty()) 
            {
                return response([
                    $this->notifyCode             => 'INFO_0001',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0001')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0001')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_article_comments.show.info_0001_admin_message', [ 'tableName' => $this->tableNameBlogArticleComments ]),
                ], 404);
            }
            elseif (is_null($apiDisplaySingleRecord)) 
            {
                return response([
                    $this->notifyCode             => 'INFO_0004',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0004')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0004')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_article_comments.show.info_0004_admin_message'),
                ], 404);
            }
            else 
            {
                return response([
                    $this->notifyCode             => 'INFO_0002',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0002')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0002')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_article_comments.show.info_0002_admin_message', [ 'blogArticleTitle' => $apiDisplaySingleRecord['blog_article_title'] ]),
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
                    $this->adminMessage           => __('blog_article_comments.show.err_0001_admin_message', [ 'tableName' => $this->tableNameBlogArticleComments ]),
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
            $apiUpdateSingleRecord = $this->modelNameBlogArticleComments->find($id);
            $apiUpdateSingleRecord->update($request->validate([
                $this->blogCategoryId    => 'required', // TODO: How to validate a dropdown list
                $this->blogSubcategoryId => 'required', // TODO: How to validate a dropdown list
                $this->blogArticleId     => 'required', // TODO: How to validate a dropdown list
                $this->fullName          => 'required|regex:/^[a-zA-Z_ ]+$/u|max:255',
                $this->email             => 'required|email:filter|max:255',
                $this->comment           => 'required|max:255',
            ]));
            return response([
                $this->notifyCode             => 'INFO_0008',
                $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0008')->pluck($this->notifyShortDescription)[0],
                $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0008')->pluck($this->notifyReference)[0],
                $this->adminMessage           => __('blog_article_comments.update.info_0008_admin_message'),
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
                    $this->adminMessage           => __('blog_article_comments.update.err_0001_admin_message', [ 'tableName' => $this->tableNameBlogArticleComments, ]),
                ], 500);
            }
            if ($mysqlError->getCode() === '42S22') 
            {
                return response([
                    $this->notifyCode             => 'ERR_0002',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0002')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0002')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_article_comments.update.err_0002_admin_message', [ 'tableName' => $this->tableNameBlogArticleComments, ]),
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
            $apiDisplayAllRecords = $this->modelNameBlogArticleComments->all();
            $apiDisplaySingleRecord = $this->modelNameBlogArticleComments->find($id);
            if ($apiDisplayAllRecords->isEmpty()) 
            {
                return response([
                    $this->notifyCode             => 'INFO_0001',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0001')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0001')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_article_comments.delete.info_0001_admin_message', [ 'tableName' => $this->tableNameBlogArticleComments ]),
                ], 404);
            }
            elseif (is_null($apiDisplaySingleRecord)) 
            {
                return response([
                    $this->notifyCode             => 'INFO_0005',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0005')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0005')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_article_comments.delete.info_0005_admin_message'),
                ], 404);
            }
            else 
            {
                $apiDeleteSingleRecord = $this->modelNameBlogArticleComments->find($id)->delete();
                return response([
                    $this->notifyCode             => 'INFO_0006',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0006')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0006')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_article_comments.delete.info_0006_admin_message'),
                    $this->deleteRecords          => $apiDisplaySingleRecord,
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
                    $this->adminMessage           => __('blog_article_comments.delete.err_0001_admin_message'),
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
            $apiDisplayAllRecords = $this->modelNameBlogArticleComments->all();
            if ($apiDisplayAllRecords->isEmpty()) 
            {
                return response([
                    $this->notifyCode             => 'INFO_0001',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0001')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0001')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_article_comments.delete_all_records.info_0001_admin_message', [ 'tableName' => $this->tableNameBlogArticleComments ]),
                ], 404);
            }
            elseif (is_null($apiDisplayAllRecords)) 
            {
                return response([
                    $this->notifyCode             => 'INFO_0005',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0005')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0005')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_article_comments.delete_all_records.info_0005_admin_message'),
                ], 404);
            }
            else 
            {
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                $apiDeleteSingleRecord = $this->modelNameBlogArticleComments->truncate();
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                return response([
                    $this->notifyCode             => 'INFO_0007',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0007')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0007')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_article_comments.delete_all_records.info_0007_admin_message'),
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
                    $this->adminMessage           => __('blog_article_comments.delete_all_records.err_0001_admin_message'),
                ], 500);
            }
        }
    }
}
