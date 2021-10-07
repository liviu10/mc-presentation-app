<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogArticle;
use App\Models\BlogArticleComment;
use App\Models\ErrorAndNotificationSystem;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class BlogArticleCommentController extends Controller
{
    protected $modelNameBlogArticles;
    protected $tableNameBlogArticles;
    protected $tableAllColumnsBlogArticles;

    protected $modelNameBlogArticleComments;
    protected $tableNameBlogArticleComments;
    protected $tableAllColumnsBlogArticleComments;

    protected $modelNameErrorSystem;
    protected $tableNameErrorSystem;
    protected $tableAllColumnsErrorSystem;

    public function __construct()
    {
        $this->modelNameBlogArticles       = new BlogArticle();
        $this->tableNameBlogArticles       = $this->modelNameBlogArticles->getTable();
        $this->tableAllColumnsBlogArticles = Schema::getColumnListing($this->tableNameBlogArticles);

        $this->modelNameBlogArticleComments       = new BlogArticleComment();
        $this->tableNameBlogArticleComments       = $this->modelNameBlogArticleComments->getTable();
        $this->tableAllColumnsBlogArticleComments = Schema::getColumnListing($this->tableNameBlogArticleComments);

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
            $apiDisplayAllRecords = $this->modelNameBlogArticleComments->where('comment_is_public', '<>', '0')->get();
            if ($apiDisplayAllRecords->isEmpty()) 
            {
                return response([
                    'notify_code'              => 'INFO_0001',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_article_comments.index.info_0001_admin_message', [ 'tableName' => $this->modelNameBlogArticleComments ]),
                ], 404);
            }
            else 
            {
                return response([
                    'notify_code'              => 'INFO_0002',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0002')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0002')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_article_comments.index.info_0002_admin_message'),
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
                    'admin_message'            => __('blog_article_comments.index.err_0001_admin_message', [ 'tableName' => $this->modelNameBlogArticleComments ]),
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
                'blog_category_id'    => 'required', // TODO: How to validate a dropdown list
                'blog_subcategory_id' => 'required', // TODO: How to validate a dropdown list
                'blog_article_id'     => 'required', // TODO: How to validate a dropdown list
                'full_name'           => 'required|regex:/^[a-zA-Z_ ]+$/u|max:255',
                'email'               => 'required|email:filter|max:255',
                'comment'             => 'required|max:255',
                // 'comment_is_public'   => 'accepted',
                // 'privacy_policy'      => 'accepted',
            ]);
            $apiInsertSingleRecord = $this->modelNameBlogArticleComments->create([
                'blog_category_id'    => $request->get('blog_category_id'),
                'blog_subcategory_id' => $request->get('blog_subcategory_id'),
                'blog_article_id'     => $request->get('blog_article_id'),
                'full_name'           => $request->get('full_name'),
                'email'               => $request->get('email'),
                'comment'             => $request->get('comment'),
                'comment_is_public'   => $request->get('comment_is_public'),
                'privacy_policy'      => $request->get('privacy_policy'),
            ]);
            if ($request->get('comment_is_public') === '1') 
            {
                return response([
                    'notify_code'              => 'INFO_0016',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0016')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0016')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_article_comments.store.info_0016_admin_message', [ 
                        'fullName' => $request->get('full_name'),
                        'blogArticleTitle'     => $request->get('blog_article_title'),
                    ]),
                    'records'                  => $apiInsertSingleRecord,
                ], 201);
            }
            else
            {
                return response([
                    'notify_code'              => 'INFO_0017',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0017')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0017')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_article_comments.store.info_0017_admin_message', [ 
                        'fullName' => $request->get('full_name'),
                        'blogArticleTitle'     => $request->get('blog_article_title'),
                    ]),
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
                    'admin_message'            => __('blog_article_comments.store.err_0001_admin_message', [ 'tableName' => $this->tableAllColumnsBlogArticleComments, ]),
                ], 500);
            }
            if ($mysqlError->getCode() === '42S22') 
            {
                return response([
                    'notify_code'              => 'ERR_0002',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0002')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0002')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_article_comments.store.err_0002_admin_message', [ 'tableName' => $this->tableAllColumnsBlogArticleComments, ]),
                ], 500);
            }
            if ($mysqlError->getCode() === '23000') 
            {
                return response([
                    'notify_code'              => 'ERR_0003',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0003')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0003')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_article_comments.store.err_0003_admin_message', [ 'tableName' => $this->tableAllColumnsBlogArticleComments, ]),
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
                    'notify_code'              => 'INFO_0001',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_article_comments.show.info_0001_admin_message', [ 'tableName' => $this->modelNameBlogArticleComments ]),
                ], 404);
            }
            elseif (is_null($apiDisplaySingleRecord)) 
            {
                return response([
                    'notify_code'              => 'INFO_0004',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0004')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0004')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_article_comments.show.info_0004_admin_message'),
                ], 404);
            }
            else 
            {
                return response([
                    'notify_code'              => 'INFO_0002',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0002')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0002')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_article_comments.show.info_0002_admin_message', [ 'blogArticleTitle' => $apiDisplaySingleRecord['blog_article_title'] ]),
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
                    'admin_message'            => __('blog_article_comments.show.err_0001_admin_message', [ 'tableName' => $this->modelNameBlogArticleComments ]),
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
                'blog_category_id'    => 'required', // TODO: How to validate a dropdown list
                'blog_subcategory_id' => 'required', // TODO: How to validate a dropdown list
                'blog_article_id'     => 'required', // TODO: How to validate a dropdown list
                'full_name'           => 'required|regex:/^[a-zA-Z_ ]+$/u|max:255',
                'email'               => 'required|email:filter|max:255',
                'comment'             => 'required|max:255',
                // 'comment_is_public'   => 'accepted',
                // 'privacy_policy'      => 'accepted',
            ]));
            return response([
                'notify_code'              => 'INFO_0008',
                'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0008')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0008')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                'admin_message'            => __('blog_article_comments.update.info_0008_admin_message'),
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
                    'admin_message'            => __('blog_article_comments.update.err_0001_admin_message', [ 'tableName' => $this->modelNameBlogArticleComments, ]),
                ], 500);
            }
            if ($mysqlError->getCode() === '42S22') 
            {
                return response([
                    'notify_code'              => 'ERR_0002',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0002')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0002')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_article_comments.update.err_0002_admin_message', [ 'tableName' => $this->modelNameBlogArticleComments, ]),
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
                    'notify_code'              => 'INFO_0001',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_article_comments.delete.info_0001_admin_message', [ 'tableName' => $this->modelNameBlogArticleComments ]),
                ], 404);
            }
            elseif (is_null($apiDisplaySingleRecord)) 
            {
                return response([
                    'notify_code'              => 'INFO_0005',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0005')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0005')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_article_comments.delete.info_0005_admin_message'),
                ], 404);
            }
            else 
            {
                $apiDeleteSingleRecord = $this->modelNameBlogArticleComments->find($id)->delete();
                return response([
                    'notify_code'              => 'INFO_0006',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0006')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0006')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_article_comments.delete.info_0006_admin_message'),
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
                    'admin_message'            => __('blog_article_comments.delete.err_0001_admin_message'),
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
                    'notify_code'              => 'INFO_0001',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_article_comments.delete_all_records.info_0001_admin_message', [ 'tableName' => $this->modelNameBlogArticleComments ]),
                ], 404);
            }
            elseif (is_null($apiDisplayAllRecords)) 
            {
                return response([
                    'notify_code'              => 'INFO_0005',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0005')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0005')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_article_comments.delete_all_records.info_0005_admin_message'),
                ], 404);
            }
            else 
            {
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                $apiDeleteSingleRecord = $this->modelNameBlogArticleComments->truncate();
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                return response([
                    'notify_code'              => 'INFO_0007',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0007')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0007')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_article_comments.delete_all_records.info_0007_admin_message'),
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
                    'admin_message'            => __('blog_article_comments.delete_all_records.err_0001_admin_message'),
                ], 500);
            }
        }
    }
}
