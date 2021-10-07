<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogSubcategory;
use App\Models\BlogArticle;
use App\Models\ErrorAndNotificationSystem;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class BlogArticleController extends Controller
{
    protected $modelNameBlogSubcategories;
    protected $tableNameBlogSubcategories;
    protected $tableAllColumnsBlogSubcategories;

    protected $modelNameBlogArticles;
    protected $tableNameBlogArticles;
    protected $tableAllColumnsBlogArticles;

    protected $modelNameErrorSystem;
    protected $tableNameErrorSystem;
    protected $tableAllColumnsErrorSystem;

    public function __construct()
    {
        $this->modelNameBlogSubcategories       = new BlogSubcategory();
        $this->tableNameBlogSubcategories       = $this->modelNameBlogSubcategories->getTable();
        $this->tableAllColumnsBlogSubcategories = Schema::getColumnListing($this->tableNameBlogSubcategories);

        $this->modelNameBlogArticles       = new BlogArticle();
        $this->tableNameBlogArticles       = $this->modelNameBlogArticles->getTable();
        $this->tableAllColumnsBlogArticles = Schema::getColumnListing($this->tableNameBlogArticles);

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
            $apiDisplayAllRecords = $this->modelNameBlogArticles->where('blog_article_is_active', '<>', '0')->get();
            if ($apiDisplayAllRecords->isEmpty()) 
            {
                return response([
                    'notify_code'              => 'INFO_0001',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_articles.index.info_0001_admin_message.message_1', [ 'tableName' => $this->modelNameBlogArticles ]),
                ], 404);
            }
            else 
            {
                return response([
                    'notify_code'              => 'INFO_0002',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0002')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0002')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_articles.index.info_0002_admin_message.message_1'),
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
                    'admin_message'            => __('blog_articles.index.err_0001_admin_message', [ 'tableName' => $this->modelNameBlogArticles ]),
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
                'blog_category_id'               => 'required', // TODO: How to validate a dropdown list
                'blog_subcategory_id'            => 'required', // TODO: How to validate a dropdown list
                'blog_article_title'             => 'required|regex:/^[a-zA-Z_ ]+$/u|max:255',
                'blog_article_short_description' => 'required|max:255',
                'blog_article_content'           => 'required',
                // 'blog_article_is_audio'          => 'accepted',
                // 'blog_article_is_video'          => 'accepted',
                // 'blog_article_is_active'         => 'accepted',
            ]);
            $averageAdultReadingSpeed = 225;
            $articleTitleReadingTime = round(str_word_count($request->get('blog_article_title')) / $averageAdultReadingSpeed);
            $articleShortDescriptionReadingTime = round(str_word_count($request->get('blog_article_short_description')) / $averageAdultReadingSpeed);
            $articleDescriptionReadingTime = round(str_word_count($request->get('blog_article_content')) / $averageAdultReadingSpeed);
            $articleTotalReadingTime = $articleTitleReadingTime + $articleShortDescriptionReadingTime + $articleDescriptionReadingTime;
            if ($request->get('blog_category_id') === '1') 
            {
                $apiInsertSingleRecord = $this->modelNameBlogArticles->create([
                    'blog_category_id'               => $request->get('blog_category_id'),
                    'blog_subcategory_id'            => $request->get('blog_subcategory_id'),
                    'blog_article_title'             => $request->get('blog_article_title'),
                    'blog_article_short_description' => $request->get('blog_article_short_description'),
                    'blog_article_content'           => $request->get('blog_article_content'),
                    'blog_article_slug'              => '/blog/article/view/' . strtolower(str_replace(' ', '-', $request->get('blog_article_title'))),
                    'blog_article_is_audio'          => $request->get('blog_article_is_audio'),
                    'blog_article_is_video'          => $request->get('blog_article_is_video'),
                    'blog_article_is_active'         => $request->get('blog_article_is_active'),
                    'blog_article_reading_time'      => $articleTotalReadingTime,
                ]);
            }
            elseif ($request->get('blog_category_id') === '2') 
            {
                $apiInsertSingleRecord = $this->modelNameBlogArticles->create([
                    'blog_category_id'               => $request->get('blog_category_id'),
                    'blog_subcategory_id'            => $request->get('blog_subcategory_id'),
                    'blog_article_title'             => $request->get('blog_article_title'),
                    'blog_article_short_description' => $request->get('blog_article_short_description'),
                    'blog_article_content'           => $request->get('blog_article_content'),
                    'blog_article_slug'              => '/blog/audio/view/' . strtolower(str_replace(' ', '-', $request->get('blog_article_title'))),
                    'blog_article_is_audio'          => $request->get('blog_article_is_audio'),
                    'blog_article_is_video'          => $request->get('blog_article_is_video'),
                    'blog_article_is_active'         => $request->get('blog_article_is_active'),
                    'blog_article_reading_time'      => $articleTotalReadingTime,
                ]);
            }
            else 
            {
                $apiInsertSingleRecord = $this->modelNameBlogArticles->create([
                    'blog_category_id'               => $request->get('blog_category_id'),
                    'blog_subcategory_id'            => $request->get('blog_subcategory_id'),
                    'blog_article_title'             => $request->get('blog_article_title'),
                    'blog_article_short_description' => $request->get('blog_article_short_description'),
                    'blog_article_content'           => $request->get('blog_article_content'),
                    'blog_article_slug'              => '/blog/video/view/' . strtolower(str_replace(' ', '-', $request->get('blog_article_title'))),
                    'blog_article_is_audio'          => $request->get('blog_article_is_audio'),
                    'blog_article_is_video'          => $request->get('blog_article_is_video'),
                    'blog_article_is_active'         => $request->get('blog_article_is_active'),
                    'blog_article_reading_time'      => $articleTotalReadingTime,
                ]);
            }

            if ($request->get('blog_article_is_audio') === '1' && $request->get('blog_article_is_active') === '1') 
            {
                return response([
                    'notify_code'              => 'INFO_0010',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0010')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0010')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_articles.store.info_0010_admin_message', [ 
                        'blogArticleTitle' => $request->get('blog_article_title'),
                        'blogSubcategoryTitle' => $this->modelNameBlogSubcategories::where($this->tableAllColumnsBlogSubcategories[0], '=', $request->get('blog_subcategory_id'))->pluck($this->tableAllColumnsBlogSubcategories[2])[0],
                    ]),
                    'records'                  => $apiInsertSingleRecord,
                ], 201);
            }
            elseif ($request->get('blog_article_is_video') === '1' && $request->get('blog_article_is_active') === '1') 
            {
                return response([
                    'notify_code'              => 'INFO_0011',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0011')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0011')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_articles.store.info_0011_admin_message', [ 
                        'blogArticleTitle' => $request->get('blog_article_title'),
                        'blogSubcategoryTitle' => $this->modelNameBlogSubcategories::where($this->tableAllColumnsBlogSubcategories[0], '=', $request->get('blog_subcategory_id'))->pluck($this->tableAllColumnsBlogSubcategories[2])[0],
                    ]),
                    'records'                  => $apiInsertSingleRecord,
                ], 201);
            }
            elseif ($request->get('blog_article_is_audio') === '1' && $request->get('blog_article_is_active') === '0') 
            {
                return response([
                    'notify_code'              => 'INFO_0012',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0012')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0012')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_articles.store.info_0012_admin_message', [ 
                        'blogArticleTitle' => $request->get('blog_article_title'),
                        'blogSubcategoryTitle' => $this->modelNameBlogSubcategories::where($this->tableAllColumnsBlogSubcategories[0], '=', $request->get('blog_subcategory_id'))->pluck($this->tableAllColumnsBlogSubcategories[2])[0],
                    ]),
                    'records'                  => $apiInsertSingleRecord,
                ], 201);
            }
            elseif ($request->get('blog_article_is_video') === '1' && $request->get('blog_article_is_active') === '0') 
            {
                return response([
                    'notify_code'              => 'INFO_0013',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0013')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0013')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_articles.store.info_0013_admin_message', [ 
                        'blogArticleTitle' => $request->get('blog_article_title'),
                        'blogSubcategoryTitle' => $this->modelNameBlogSubcategories::where($this->tableAllColumnsBlogSubcategories[0], '=', $request->get('blog_subcategory_id'))->pluck($this->tableAllColumnsBlogSubcategories[2])[0],
                    ]),
                    'records'                  => $apiInsertSingleRecord,
                ], 201);
            }
            elseif ($request->get('blog_article_is_audio') === '0' && $request->get('blog_article_is_video') === '0' && $request->get('blog_article_is_active') === '1') 
            {
                return response([
                    'notify_code'              => 'INFO_0014',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0014')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0014')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_articles.store.info_0014_admin_message', [ 
                        'blogArticleTitle' => $request->get('blog_article_title'),
                        'blogSubcategoryTitle' => $this->modelNameBlogSubcategories::where($this->tableAllColumnsBlogSubcategories[0], '=', $request->get('blog_subcategory_id'))->pluck($this->tableAllColumnsBlogSubcategories[2])[0],
                    ]),
                    'records'                  => $apiInsertSingleRecord,
                ], 201);
            }
            else
            {
                return response([
                    'notify_code'              => 'INFO_0015',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0015')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0015')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_articles.store.info_0015_admin_message', [ 'blogCategoryTitle' => $request->get('blog_article_title') ]),
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
                    'admin_message'            => __('blog_articles.store.err_0001_admin_message', [ 
                        'blogArticleTitle'     => $request->get('blog_article_title'),
                        'tableName'            => $this->tableAllColumnsBlogArticles,
                    ]),
                ], 500);
            }
            if ($mysqlError->getCode() === '42S22') 
            {
                return response([
                    'notify_code'              => 'ERR_0002',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0002')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0002')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_articles.store.err_0002_admin_message', [ 
                        'blogArticleTitle'     => $request->get('blog_article_title'),
                        'tableName'            => $this->tableAllColumnsBlogArticles,
                    ]),
                ], 500);
            }
            if ($mysqlError->getCode() === '23000') 
            {
                return response([
                    'notify_code'              => 'ERR_0003',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0003')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0003')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_articles.store.err_0003_admin_message', [ 
                        'blogArticleTitle'     => $request->get('blog_article_title'),
                        'tableName'            => $this->tableAllColumnsBlogArticles,
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
            $apiDisplayAllRecords = $this->modelNameBlogArticles->all();
            $apiDisplaySingleRecord = $this->modelNameBlogArticles->find($id);
            if ($apiDisplayAllRecords->isEmpty()) 
            {
                return response([
                    'notify_code'              => 'INFO_0001',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_articles.show.info_0001_admin_message.message_1', [ 'tableName' => $this->modelNameBlogArticles ]),
                ], 404);
            }
            elseif (is_null($apiDisplaySingleRecord)) 
            {
                return response([
                    'notify_code'              => 'INFO_0004',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0004')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0004')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_articles.show.info_0004_admin_message'),
                ], 404);
            }
            else 
            {
                return response([
                    'notify_code'              => 'INFO_0002',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0002')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0002')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_articles.show.info_0002_admin_message', [ 'blogCategoryTitle' => $apiDisplaySingleRecord['blog_category_title'] ]),
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
                    'admin_message'            => __('blog_articles.show.err_0001_admin_message', [ 'tableName' => $this->modelNameBlogArticles ]),
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
            $apiUpdateSingleRecord = $this->modelNameBlogArticles->find($id);
            $request->validate([
                'blog_category_id'               => 'required', // TODO: How to validate a dropdown list
                'blog_subcategory_id'            => 'required', // TODO: How to validate a dropdown list
                'blog_article_title'             => 'required|regex:/^[a-zA-Z_ ]+$/u|max:255',
                'blog_article_short_description' => 'required|max:255',
                'blog_article_content'           => 'required',
                // 'blog_article_is_audio'          => 'accepted',
                // 'blog_article_is_video'          => 'accepted',
                // 'blog_article_is_active'         => 'accepted',
            ]);
            $averageAdultReadingSpeed = 225;
            $articleTitleReadingTime = round(str_word_count($request->get('blog_article_title')) / $averageAdultReadingSpeed);
            $articleShortDescriptionReadingTime = round(str_word_count($request->get('blog_article_short_description')) / $averageAdultReadingSpeed);
            $articleDescriptionReadingTime = round(str_word_count($request->get('blog_article_content')) / $averageAdultReadingSpeed);
            $articleTotalReadingTime = $articleTitleReadingTime + $articleShortDescriptionReadingTime + $articleDescriptionReadingTime;
            if ($request->get('blog_category_id') === 1) 
            {
                $apiUpdateSingleRecord->update([
                    'blog_category_id'               => $request->get('blog_category_id'),
                    'blog_subcategory_id'            => $request->get('blog_subcategory_id'),
                    'blog_article_title'             => $request->get('blog_article_title'),
                    'blog_article_short_description' => $request->get('blog_article_short_description'),
                    'blog_article_content'           => $request->get('blog_article_content'),
                    'blog_article_slug'              => '/blog/article/view/' . strtolower($request->get('blog_article_title')),
                    'blog_article_is_audio'          => $request->get('blog_article_is_audio'),
                    'blog_article_is_video'          => $request->get('blog_article_is_video'),
                    'blog_article_is_active'         => $request->get('blog_article_is_active'),
                    'blog_article_reading_time'      => $articleTotalReadingTime,
                ]);
            }
            elseif ($request->get('blog_category_id') === 2) 
            {
                $apiUpdateSingleRecord->update([
                    'blog_category_id'               => $request->get('blog_category_id'),
                    'blog_subcategory_id'            => $request->get('blog_subcategory_id'),
                    'blog_article_title'             => $request->get('blog_article_title'),
                    'blog_article_short_description' => $request->get('blog_article_short_description'),
                    'blog_article_content'           => $request->get('blog_article_content'),
                    'blog_article_slug'              => '/blog/audio/view/' . strtolower($request->get('blog_article_title')),
                    'blog_article_is_audio'          => $request->get('blog_article_is_audio'),
                    'blog_article_is_video'          => $request->get('blog_article_is_video'),
                    'blog_article_is_active'         => $request->get('blog_article_is_active'),
                    'blog_article_reading_time'      => $articleTotalReadingTime,
                ]);
            }
            else 
            {
                $apiUpdateSingleRecord->update([
                    'blog_category_id'               => $request->get('blog_category_id'),
                    'blog_subcategory_id'            => $request->get('blog_subcategory_id'),
                    'blog_article_title'             => $request->get('blog_article_title'),
                    'blog_article_short_description' => $request->get('blog_article_short_description'),
                    'blog_article_content'           => $request->get('blog_article_content'),
                    'blog_article_slug'              => '/blog/video/view/' . strtolower($request->get('blog_article_title')),
                    'blog_article_is_audio'          => $request->get('blog_article_is_audio'),
                    'blog_article_is_video'          => $request->get('blog_article_is_video'),
                    'blog_article_is_active'         => $request->get('blog_article_is_active'),
                    'blog_article_reading_time'      => $articleTotalReadingTime,
                ]);
            }
            return response([
                'notify_code'              => 'INFO_0008',
                'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0008')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0008')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                'admin_message'            => __('blog_articles.update.info_0008_admin_message', [ 'blogCategoryTitle' => $request->get('blog_category_title') ]),
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
                    'admin_message'            => __('blog_articles.update.err_0001_admin_message', [ 
                        'blogCategoryTitle'    => $request->get('blog_category_title'),
                        'tableName'            => $this->modelNameBlogArticles,
                    ]),
                ], 500);
            }
            if ($mysqlError->getCode() === '42S22') 
            {
                return response([
                    'notify_code'              => 'ERR_0002',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0002')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'ERR_0002')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_articles.update.err_0002_admin_message', [ 
                        'blogCategoryTitle'    => $request->get('blog_category_title'),
                        'tableName'            => $this->modelNameBlogArticles,
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
            $apiDisplayAllRecords = $this->modelNameBlogArticles->all();
            $apiDisplaySingleRecord = $this->modelNameBlogArticles->find($id);
            if ($apiDisplayAllRecords->isEmpty()) 
            {
                return response([
                    'notify_code'              => 'INFO_0001',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_articles.delete.info_0001_admin_message.message_1', [ 'tableName' => $this->modelNameBlogArticles ]),
                ], 404);
            }
            elseif (is_null($apiDisplaySingleRecord)) 
            {
                return response([
                    'notify_code'              => 'INFO_0005',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0005')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0005')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_articles.delete.info_0005_admin_message'),
                ], 404);
            }
            else 
            {
                $apiDeleteSingleRecord = $this->modelNameBlogArticles->find($id)->delete();
                return response([
                    'notify_code'              => 'INFO_0006',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0006')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0006')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_articles.delete.info_0006_admin_message', [ 'blogCategoryTitle' => $apiDisplaySingleRecord['blog_category_title'] ]),
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
                    'admin_message'            => __('blog_articles.delete.err_0001_admin_message', [ 'blogCategoryTitle' => $apiDisplaySingleRecord['blog_category_title'] ]),
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
            $apiDisplayAllRecords = $this->modelNameBlogArticles->all();
            if ($apiDisplayAllRecords->isEmpty()) 
            {
                return response([
                    'notify_code'              => 'INFO_0001',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0001')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_articles.delete_all_records.info_0001_admin_message.message_1', [ 'tableName' => $this->modelNameBlogArticles ]),
                ], 404);
            }
            elseif (is_null($apiDisplayAllRecords)) 
            {
                return response([
                    'notify_code'              => 'INFO_0005',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0005')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0005')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_articles.delete_all_records.info_0005_admin_message'),
                ], 404);
            }
            else 
            {
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                $apiDeleteSingleRecord = $this->modelNameBlogArticles->truncate();
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                return response([
                    'notify_code'              => 'INFO_0007',
                    'notify_short_description' => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0007')->pluck($this->tableAllColumnsErrorSystem[2])[0],
                    'notify_reference'         => $this->modelNameErrorSystem::where($this->tableAllColumnsErrorSystem[1], '=', 'INFO_0007')->pluck($this->tableAllColumnsErrorSystem[3])[0],
                    'admin_message'            => __('blog_articles.delete_all_records.info_0007_admin_message'),
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
                    'admin_message'            => __('blog_articles.delete_all_records.err_0001_admin_message'),
                ], 500);
            }
        }
    }

    /**
     * Display a listing of all written blog articles no matter the subcategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllWrittenBlogArticles()
    {
        if (response($this->index())->status() === 200) 
        {
            $allWrittenBlogArticles = $this->modelNameBlogArticles::where('blog_category_id', '=', '1')
                                                ->where('blog_article_is_active', '<>', '0')
                                                ->orderBy('created_at', 'DESC')
                                                ->get();
            if ($allWrittenBlogArticles->isEmpty()) 
            {
                return response([
                    'notify_code'          => 'INFO_0001',
                    'user_message'         => __('blog_articles.index.info_0001_admin_message.message_2'),
                    'results'              => $allWrittenBlogArticles,
                ], 200);
            }
            else 
            {
                return response([
                    'notify_code'          => 'INFO_0002',
                    'user_message'         => __('blog_articles.index.info_0002_admin_message.message_2'),
                    'results'              => $allWrittenBlogArticles,
                ], 200);
            }
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

    /**
     * Display a listing of all audio blog articles.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllAudioBlogArticles()
    {
        if (response($this->index())->status() === 200) 
        {
            $allAudioBlogArticles = $this->modelNameBlogArticles::where('blog_category_id', '=', '2')
                                                ->where('blog_article_is_active', '<>', '0')
                                                ->get();
            return response([
                'results'              => $allAudioBlogArticles,
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

    /**
     * Display a listing of all video blog articles.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllVideoBlogArticles()
    {
        if (response($this->index())->status() === 200) 
        {
            $allVideoBlogArticles = $this->modelNameBlogArticles::where('blog_category_id', '=', '3')
                                                ->where('blog_article_is_active', '<>', '0')
                                                ->get();
            return response([
                'results'              => $allVideoBlogArticles,
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
