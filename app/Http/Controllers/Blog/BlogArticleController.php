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
    // Blog Subcategories table and necessary columns
    protected $modelNameBlogSubcategories;
    protected $tableNameBlogSubcategories;
    protected $tableAllColumnsBlogSubcategories;

    // Blog Articles table and necessary columns
    protected $modelNameBlogArticles;
    protected $tableNameBlogArticles;
    protected $blogArticleId;
    protected $blogCategoryId;
    protected $blogSubcategoryId;
    protected $blogArticleAuthor;
    protected $blogArticleReadingTime;
    protected $blogArticleTitle;
    protected $blogArticleShortDescription;
    protected $blogArticleContent;
    protected $blogArticleSlug;
    protected $blogArticleIsAudio;
    protected $blogArticleIsVideo;
    protected $blogArticleIsActive;
    protected $blogArticleRatingSystem;
    protected $blogArticleLikes;
    protected $blogArticleDislikes;
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

    public function __construct()
    {
        $this->modelNameBlogSubcategories       = new BlogSubcategory();
        $this->tableNameBlogSubcategories       = 'blog_subcategories';
        $this->tableAllColumnsBlogSubcategories = Schema::getColumnListing($this->tableNameBlogSubcategories);

        $this->modelNameBlogArticles       = new BlogArticle();
        $this->tableNameBlogArticles       = 'blog_articles';
        $this->blogCategoryId              = 'blog_category_id';
        $this->blogArticleId               = 'id';
        $this->blogSubcategoryId           = 'blog_subcategory_id';
        $this->blogArticleAuthor           = 'blog_article_author';
        $this->blogArticleReadingTime      = 'blog_article_reading_time';
        $this->blogArticleTitle            = 'blog_article_title';
        $this->blogArticleShortDescription = 'blog_article_short_description';
        $this->blogArticleContent          = 'blog_article_content';
        $this->blogArticleSlug             = 'blog_article_slug';
        $this->blogArticleIsAudio          = 'blog_article_is_audio';
        $this->blogArticleIsVideo          = 'blog_article_is_video';
        $this->blogArticleIsActive         = 'blog_article_is_active';
        $this->blogArticleRatingSystem     = 'blog_article_rating_system';
        $this->blogArticleLikes            = 'blog_article_likes';
        $this->blogArticleDislikes         = 'blog_article_dislikes';
        $this->blogCreatedAt               = 'created_at';
        $this->blogUpdatedAt               = 'updated_at';
        $this->blogDeletedAt               = 'deleted_at';

        $this->modelNameErrorSystem        = new ErrorAndNotificationSystem();
        $this->tableNameErrorSystem        = 'errors_and_notification_system';
        $this->notifyCode                  = 'notify_code';
        $this->notifyShortDescription      = 'notify_short_description';
        $this->notifyReference             = 'notify_reference';

        $this->adminMessage                = 'admin_message';
        $this->userMessage                 = 'user_message';
        $this->records                     = 'records';
        $this->results                     = 'results';
        $this->deletedRecords              = 'deletedRecords';
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
            $apiDisplayAllRecords = $this->modelNameBlogArticles->where($this->blogArticleIsActive, '<>', '0')->get();
            if ($apiDisplayAllRecords->isEmpty()) 
            {
                return response([
                    $this->notifyCode             => 'INFO_0001',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0001')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0001')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_articles.index.info_0001_admin_message.message_1', [ 'tableName' => $this->tableNameBlogArticles ]),
                ], 404);
            }
            else 
            {
                return response([
                    $this->notifyCode             => 'INFO_0002',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0002')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0002')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_articles.index.info_0002_admin_message.message_1'),
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
                    $this->adminMessage           => __('blog_articles.index.err_0001_admin_message', [ 'tableName' => $this->tableNameBlogArticles ]),
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
                $this->blogCategoryId              => 'required', // TODO: How to validate a dropdown list
                $this->blogSubcategoryId           => 'required', // TODO: How to validate a dropdown list
                $this->blogArticleAuthor           => 'required|max:255',
                $this->blogArticleTitle            => 'required|regex:/^[a-zA-Z_ ]+$/u|max:255',
                $this->blogArticleShortDescription => 'required|max:255',
                $this->blogArticleContent          => 'required',
            ]);
            $averageAdultReadingSpeed           = 225;
            $articleTitleReadingTime            = round(str_word_count($request->get($this->blogArticleTitle)) / $averageAdultReadingSpeed);
            $articleShortDescriptionReadingTime = round(str_word_count($request->get($this->blogArticleShortDescription)) / $averageAdultReadingSpeed);
            $articleDescriptionReadingTime      = round(str_word_count($request->get($this->blogArticleContent)) / $averageAdultReadingSpeed);
            $articleTotalReadingTime            = $articleTitleReadingTime + $articleShortDescriptionReadingTime + $articleDescriptionReadingTime;
            if ($request->get($this->blogCategoryId) === 1) 
            {
                $apiInsertSingleRecord = $this->modelNameBlogArticles->create([
                    $this->blogCategoryId              => $request->get($this->blogCategoryId),
                    $this->blogSubcategoryId           => $request->get($this->blogSubcategoryId),
                    $this->blogArticleAuthor           => $request->get($this->blogArticleAuthor),
                    $this->blogArticleReadingTime      => $articleTotalReadingTime,
                    $this->blogArticleTitle            => $request->get($this->blogArticleTitle),
                    $this->blogArticleShortDescription => $request->get($this->blogArticleShortDescription),
                    $this->blogArticleContent          => $request->get($this->blogArticleContent),
                    $this->blogArticleSlug             => '/blog/article/view',
                    $this->blogArticleIsAudio          => $request->get($this->blogArticleIsAudio),
                    $this->blogArticleIsVideo          => $request->get($this->blogArticleIsVideo),
                    $this->blogArticleIsActive         => $request->get($this->blogArticleIsActive),
                    $this->blogArticleRatingSystem     => $request->get($this->blogArticleRatingSystem),
                    $this->blogArticleLikes            => $request->get($this->blogArticleLikes),
                    $this->blogArticleDislikes         => $request->get($this->blogArticleDislikes),
                ]);
            }
            elseif ($request->get($this->blogCategoryId) === 2) 
            {
                $apiInsertSingleRecord = $this->modelNameBlogArticles->create([
                    $this->blogCategoryId              => $request->get($this->blogCategoryId),
                    $this->blogSubcategoryId           => $request->get($this->blogSubcategoryId),
                    $this->blogArticleAuthor           => $request->get($this->blogArticleAuthor),
                    $this->blogArticleReadingTime      => $articleTotalReadingTime,
                    $this->blogArticleTitle            => $request->get($this->blogArticleTitle),
                    $this->blogArticleShortDescription => $request->get($this->blogArticleShortDescription),
                    $this->blogArticleContent          => $request->get($this->blogArticleContent),
                    $this->blogArticleSlug             => '/blog/audio/view',
                    $this->blogArticleIsAudio          => $request->get($this->blogArticleIsAudio),
                    $this->blogArticleIsVideo          => $request->get($this->blogArticleIsVideo),
                    $this->blogArticleIsActive         => $request->get($this->blogArticleIsActive),
                    $this->blogArticleRatingSystem     => $request->get($this->blogArticleRatingSystem),
                    $this->blogArticleLikes            => $request->get($this->blogArticleLikes),
                    $this->blogArticleDislikes         => $request->get($this->blogArticleDislikes),
                ]);
            }
            else 
            {
                $apiInsertSingleRecord = $this->modelNameBlogArticles->create([
                    $this->blogCategoryId              => $request->get($this->blogCategoryId),
                    $this->blogSubcategoryId           => $request->get($this->blogSubcategoryId),
                    $this->blogArticleAuthor           => $request->get($this->blogArticleAuthor),
                    $this->blogArticleReadingTime      => $articleTotalReadingTime,
                    $this->blogArticleTitle            => $request->get($this->blogArticleTitle),
                    $this->blogArticleShortDescription => $request->get($this->blogArticleShortDescription),
                    $this->blogArticleContent          => $request->get($this->blogArticleContent),
                    $this->blogArticleSlug             => '/blog/video/view',
                    $this->blogArticleIsAudio          => $request->get($this->blogArticleIsAudio),
                    $this->blogArticleIsVideo          => $request->get($this->blogArticleIsVideo),
                    $this->blogArticleIsActive         => $request->get($this->blogArticleIsActive),
                    $this->blogArticleRatingSystem     => $request->get($this->blogArticleRatingSystem),
                    $this->blogArticleLikes            => $request->get($this->blogArticleLikes),
                    $this->blogArticleDislikes         => $request->get($this->blogArticleDislikes),
                ]);
            }

            if ($request->get($this->blogArticleIsAudio) === '1' && $request->get($this->blogArticleIsActive) === '1') 
            {
                return response([
                    $this->notifyCode             => 'INFO_0010',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0010')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0010')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_articles.store.info_0010_admin_message', [ 
                        'blogArticleTitle' => $request->get($this->blogArticleTitle),
                        'blogSubcategoryTitle' => $this->modelNameBlogSubcategories::where($this->tableAllColumnsBlogSubcategories[0], '=', $request->get($this->blogSubcategoryId))->pluck($this->tableAllColumnsBlogSubcategories[2])[0],
                    ]),
                    $this->records                => $apiInsertSingleRecord,
                ], 201);
            }
            elseif ($request->get($this->blogArticleIsVideo) === '1' && $request->get($this->blogArticleIsActive) === '1') 
            {
                return response([
                    $this->notifyCode             => 'INFO_0011',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0011')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0011')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_articles.store.info_0011_admin_message', [ 
                        'blogArticleTitle' => $request->get($this->blogArticleTitle),
                        'blogSubcategoryTitle' => $this->modelNameBlogSubcategories::where($this->tableAllColumnsBlogSubcategories[0], '=', $request->get($this->blogSubcategoryId))->pluck($this->tableAllColumnsBlogSubcategories[2])[0],
                    ]),
                    $this->records                => $apiInsertSingleRecord,
                ], 201);
            }
            elseif ($request->get($this->blogArticleIsAudio) === '1' && $request->get($this->blogArticleIsActive) === '0') 
            {
                return response([
                    $this->notifyCode             => 'INFO_0012',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0012')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0012')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_articles.store.info_0012_admin_message', [ 
                        'blogArticleTitle' => $request->get($this->blogArticleTitle),
                        'blogSubcategoryTitle' => $this->modelNameBlogSubcategories::where($this->tableAllColumnsBlogSubcategories[0], '=', $request->get($this->blogSubcategoryId))->pluck($this->tableAllColumnsBlogSubcategories[2])[0],
                    ]),
                    $this->records                => $apiInsertSingleRecord,
                ], 201);
            }
            elseif ($request->get($this->blogArticleIsVideo) === '1' && $request->get($this->blogArticleIsActive) === '0') 
            {
                return response([
                    $this->notifyCode             => 'INFO_0013',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0013')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0013')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_articles.store.info_0013_admin_message', [ 
                        'blogArticleTitle' => $request->get($this->blogArticleTitle),
                        'blogSubcategoryTitle' => $this->modelNameBlogSubcategories::where($this->tableAllColumnsBlogSubcategories[0], '=', $request->get($this->blogSubcategoryId))->pluck($this->tableAllColumnsBlogSubcategories[2])[0],
                    ]),
                    $this->records                => $apiInsertSingleRecord,
                ], 201);
            }
            elseif ($request->get($this->blogArticleIsAudio) === '0' && $request->get($this->blogArticleIsVideo) === '0' && $request->get($this->blogArticleIsActive) === '1') 
            {
                return response([
                    $this->notifyCode             => 'INFO_0014',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0014')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0014')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_articles.store.info_0014_admin_message', [ 
                        'blogArticleTitle' => $request->get($this->blogArticleTitle),
                        'blogSubcategoryTitle' => $this->modelNameBlogSubcategories::where($this->tableAllColumnsBlogSubcategories[0], '=', $request->get($this->blogSubcategoryId))->pluck($this->tableAllColumnsBlogSubcategories[2])[0],
                    ]),
                    $this->records                => $apiInsertSingleRecord,
                ], 201);
            }
            else
            {
                return response([
                    $this->notifyCode             => 'INFO_0015',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0015')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0015')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_articles.store.info_0015_admin_message', [ 'blogCategoryTitle' => $request->get($this->blogArticleTitle) ]),
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
                    $this->adminMessage           => __('blog_articles.store.err_0001_admin_message', [ 
                        'blogArticleTitle'     => $request->get($this->blogArticleTitle),
                        'tableName'            => $this->tableNameBlogArticles,
                    ]),
                ], 500);
            }
            if ($mysqlError->getCode() === '42S22') 
            {
                return response([
                    $this->notifyCode             => 'ERR_0002',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0002')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0002')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_articles.store.err_0002_admin_message', [ 
                        'blogArticleTitle'     => $request->get($this->blogArticleTitle),
                        'tableName'            => $this->tableNameBlogArticles,
                    ]),
                ], 500);
            }
            if ($mysqlError->getCode() === '23000') 
            {
                return response([
                    $this->notifyCode             => 'ERR_0003',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0003')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0003')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_articles.store.err_0003_admin_message', [ 
                        'blogArticleTitle'     => $request->get($this->blogArticleTitle),
                        'tableName'            => $this->tableNameBlogArticles,
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
                    $this->notifyCode             => 'INFO_0001',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0001')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0001')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_articles.show.info_0001_admin_message.message_1', [ 'tableName' => $this->tableNameBlogArticles ]),
                ], 404);
            }
            elseif (is_null($apiDisplaySingleRecord)) 
            {
                return response([
                    $this->notifyCode             => 'INFO_0004',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0004')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0004')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_articles.show.info_0004_admin_message'),
                ], 404);
            }
            else 
            {
                return response([
                    $this->notifyCode             => 'INFO_0002',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0002')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0002')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_articles.show.info_0002_admin_message', [ 'blogCategoryTitle' => $apiDisplaySingleRecord['blog_category_title'] ]),
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
                    $this->adminMessage           => __('blog_articles.show.err_0001_admin_message', [ 'tableName' => $this->tableNameBlogArticles ]),
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
                $this->blogCategoryId              => 'required', // TODO: How to validate a dropdown list
                $this->blogSubcategoryId           => 'required', // TODO: How to validate a dropdown list
                $this->blogArticleAuthor           => 'required|max:255',
                $this->blogArticleTitle            => 'required|regex:/^[a-zA-Z_ ]+$/u|max:255',
                $this->blogArticleShortDescription => 'required|max:255',
                $this->blogArticleContent          => 'required',
            ]);
            $averageAdultReadingSpeed           = 225;
            $articleTitleReadingTime            = round(str_word_count($request->get($this->blogArticleTitle)) / $averageAdultReadingSpeed);
            $articleShortDescriptionReadingTime = round(str_word_count($request->get($this->blogArticleShortDescription)) / $averageAdultReadingSpeed);
            $articleDescriptionReadingTime      = round(str_word_count($request->get($this->blogArticleContent)) / $averageAdultReadingSpeed);
            $articleTotalReadingTime            = $articleTitleReadingTime + $articleShortDescriptionReadingTime + $articleDescriptionReadingTime;
            if ($request->get($this->blogCategoryId) === 1) 
            {
                $apiUpdateSingleRecord->update([
                    $this->blogCategoryId              => $request->get($this->blogCategoryId),
                    $this->blogSubcategoryId           => $request->get($this->blogSubcategoryId),
                    $this->blogArticleAuthor           => $request->get($this->blogArticleAuthor),
                    $this->blogArticleReadingTime      => $articleTotalReadingTime,
                    $this->blogArticleTitle            => $request->get($this->blogArticleTitle),
                    $this->blogArticleShortDescription => $request->get($this->blogArticleShortDescription),
                    $this->blogArticleContent          => $request->get($this->blogArticleContent),
                    $this->blogArticleSlug             => '/blog/article/view',
                    $this->blogArticleIsAudio          => $request->get($this->blogArticleIsAudio),
                    $this->blogArticleIsVideo          => $request->get($this->blogArticleIsVideo),
                    $this->blogArticleIsActive         => $request->get($this->blogArticleIsActive),
                    $this->blogArticleRatingSystem     => $request->get($this->blogArticleRatingSystem),
                    $this->blogArticleLikes            => $request->get($this->blogArticleLikes),
                    $this->blogArticleDislikes         => $request->get($this->blogArticleDislikes),
                ]);
            }
            elseif ($request->get($this->blogCategoryId) === 2) 
            {
                $apiUpdateSingleRecord->update([
                    $this->blogCategoryId              => $request->get($this->blogCategoryId),
                    $this->blogSubcategoryId           => $request->get($this->blogSubcategoryId),
                    $this->blogArticleAuthor           => $request->get($this->blogArticleAuthor),
                    $this->blogArticleReadingTime      => $articleTotalReadingTime,
                    $this->blogArticleTitle            => $request->get($this->blogArticleTitle),
                    $this->blogArticleShortDescription => $request->get($this->blogArticleShortDescription),
                    $this->blogArticleContent          => $request->get($this->blogArticleContent),
                    $this->blogArticleSlug             => '/blog/audio/view',
                    $this->blogArticleIsAudio          => $request->get($this->blogArticleIsAudio),
                    $this->blogArticleIsVideo          => $request->get($this->blogArticleIsVideo),
                    $this->blogArticleIsActive         => $request->get($this->blogArticleIsActive),
                    $this->blogArticleRatingSystem     => $request->get($this->blogArticleRatingSystem),
                    $this->blogArticleLikes            => $request->get($this->blogArticleLikes),
                    $this->blogArticleDislikes         => $request->get($this->blogArticleDislikes),
                ]);
            }
            else 
            {
                $apiUpdateSingleRecord->update([
                    $this->blogCategoryId              => $request->get($this->blogCategoryId),
                    $this->blogSubcategoryId           => $request->get($this->blogSubcategoryId),
                    $this->blogArticleAuthor           => $request->get($this->blogArticleAuthor),
                    $this->blogArticleReadingTime      => $articleTotalReadingTime,
                    $this->blogArticleTitle            => $request->get($this->blogArticleTitle),
                    $this->blogArticleShortDescription => $request->get($this->blogArticleShortDescription),
                    $this->blogArticleContent          => $request->get($this->blogArticleContent),
                    $this->blogArticleSlug             => '/blog/video/view',
                    $this->blogArticleIsAudio          => $request->get($this->blogArticleIsAudio),
                    $this->blogArticleIsVideo          => $request->get($this->blogArticleIsVideo),
                    $this->blogArticleIsActive         => $request->get($this->blogArticleIsActive),
                    $this->blogArticleRatingSystem     => $request->get($this->blogArticleRatingSystem),
                    $this->blogArticleLikes            => $request->get($this->blogArticleLikes),
                    $this->blogArticleDislikes         => $request->get($this->blogArticleDislikes),
                ]);
            }
            return response([
                $this->notifyCode             => 'INFO_0008',
                $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0008')->pluck($this->notifyShortDescription)[0],
                $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0008')->pluck($this->notifyReference)[0],
                $this->adminMessage           => __('blog_articles.update.info_0008_admin_message', [ 'blogCategoryTitle' => $request->get('blog_category_title') ]),
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
                    $this->adminMessage           => __('blog_articles.update.err_0001_admin_message', [ 
                        'blogCategoryTitle'    => $request->get('blog_category_title'),
                        'tableName'            => $this->modelNameBlogArticles,
                    ]),
                ], 500);
            }
            if ($mysqlError->getCode() === '42S22') 
            {
                return response([
                    $this->notifyCode             => 'ERR_0002',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0002')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'ERR_0002')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_articles.update.err_0002_admin_message', [ 
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
                    $this->notifyCode             => 'INFO_0001',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0001')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0001')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_articles.delete.info_0001_admin_message.message_1', [ 'tableName' => $this->tableNameBlogArticles ]),
                ], 404);
            }
            elseif (is_null($apiDisplaySingleRecord)) 
            {
                return response([
                    $this->notifyCode             => 'INFO_0005',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0005')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0005')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_articles.delete.info_0005_admin_message'),
                ], 404);
            }
            else 
            {
                $apiDeleteSingleRecord = $this->modelNameBlogArticles->find($id)->delete();
                return response([
                    $this->notifyCode             => 'INFO_0006',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0006')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0006')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_articles.delete.info_0006_admin_message', [ 'blogCategoryTitle' => $apiDisplaySingleRecord['blog_category_title'] ]),
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
                    $this->adminMessage           => __('blog_articles.delete.err_0001_admin_message', [ 'blogCategoryTitle' => $apiDisplaySingleRecord['blog_category_title'] ]),
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
                    $this->notifyCode             => 'INFO_0001',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0001')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0001')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_articles.delete_all_records.info_0001_admin_message.message_1', [ 'tableName' => $this->tableNameBlogArticles ]),
                ], 404);
            }
            elseif (is_null($apiDisplayAllRecords)) 
            {
                return response([
                    $this->notifyCode             => 'INFO_0005',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0005')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0005')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_articles.delete_all_records.info_0005_admin_message'),
                ], 404);
            }
            else 
            {
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                $apiDeleteSingleRecord = $this->modelNameBlogArticles->truncate();
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                return response([
                    $this->notifyCode             => 'INFO_0007',
                    $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0007')->pluck($this->notifyShortDescription)[0],
                    $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0007')->pluck($this->notifyReference)[0],
                    $this->adminMessage           => __('blog_articles.delete_all_records.info_0007_admin_message'),
                    $this->userMessage                => $apiDisplayAllRecords,
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
                    $this->adminMessage           => __('blog_articles.delete_all_records.err_0001_admin_message'),
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
            $allWrittenBlogArticles = $this->modelNameBlogArticles::where($this->blogCategoryId, '=', '1')
                                                ->where($this->blogArticleIsActive, '<>', '0')
                                                ->orderBy('created_at', 'DESC')
                                                ->get();
            if ($allWrittenBlogArticles->isEmpty()) 
            {
                return response([
                    $this->notifyCode => 'INFO_0001',
                    $this->userMessage    => __('blog_articles.index.info_0001_admin_message.message_2'),
                    $this->results        => $allWrittenBlogArticles,
                ], 200);
            }
            else 
            {
                return response([
                    $this->notifyCode => 'INFO_0002',
                    $this->userMessage    => __('blog_articles.index.info_0002_admin_message.message_2'),
                    $this->results        => $allWrittenBlogArticles,
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
     * Display a listing of all audio blog articles.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllAudioBlogArticles()
    {
        if (response($this->index())->status() === 200) 
        {
            $allAudioBlogArticles = $this->modelNameBlogArticles::where($this->blogCategoryId, '=', '2')
                                                ->where($this->blogArticleIsActive, '<>', '0')
                                                ->get();
            if ($allAudioBlogArticles->isEmpty()) 
            {
                return response([
                    $this->notifyCode  => 'INFO_0001',
                    $this->userMessage => __('blog_articles.index.info_0001_admin_message.message_2'),
                    $this->results     => $allAudioBlogArticles,
                ], 200);
            }
            else 
            {
                return response([
                    $this->notifyCode  => 'INFO_0002',
                    $this->userMessage => __('blog_articles.index.info_0002_admin_message.message_2'),
                    $this->results     => $allAudioBlogArticles,
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
     * Display a listing of all video blog articles.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllVideoBlogArticles()
    {
        if (response($this->index())->status() === 200) 
        {
            $allVideoBlogArticles = $this->modelNameBlogArticles::where($this->blogCategoryId, '=', '3')
                                                ->where($this->blogArticleIsActive, '<>', '0')
                                                ->get();
            if ($allVideoBlogArticles->isEmpty()) 
            {
                return response([
                    $this->notifyCode  => 'INFO_0001',
                    $this->userMessage => __('blog_articles.index.info_0001_admin_message.message_2'),
                    $this->results     => $allVideoBlogArticles,
                ], 200);
            }
            else 
            {
                return response([
                    $this->notifyCode  => 'INFO_0002',
                    $this->userMessage => __('blog_articles.index.info_0002_admin_message.message_2'),
                    $this->results     => $allVideoBlogArticles,
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
     * Display a listing of all video blog articles.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function displaySingleWrittenArticle($id)
    {
        $displayWrittenArticle = $this->modelNameBlogArticles::select(
            $this->blogArticleId,
            $this->blogArticleTitle,
            $this->blogArticleAuthor,
            $this->blogCreatedAt,
            $this->blogArticleReadingTime,
            $this->blogArticleShortDescription,
            $this->blogArticleContent,
            $this->blogArticleRatingSystem,
            $this->blogArticleLikes,
            $this->blogArticleDislikes,
        )
        ->where($this->blogArticleId, '=', $id)->where($this->blogArticleIsActive, '<>', '0')
        ->with([
            // TODO: How do you load a parent through the belongsTo method (many to one relationship)
            'blog_article_comments' => function ($query) {
                $query->select('blog_article_id', 'id', 'full_name', 'email', 'comment', 'created_at', 'updated_at')
                      ->where('comment_is_public', '<>', '0');
            },
            'blog_article_comments.blog_article_comment_replies' => function ($query) {
                $query->select('blog_article_comment_id', 'id', 'full_name', 'email', 'comment_reply', 'created_at', 'updated_at')
                      ->where('comment_reply_is_public', '<>', '0');
            }
        ])
        ->get();

        return response([
            $this->notifyCode  => 'INFO_0002',
            $this->userMessage => __('blog_articles.index.info_0002_admin_message.message_2'),
            $this->results     => $displayWrittenArticle,
        ], 200);

        // if (response($this->index())->status() === 200) 
        // {
        //     $displayWrittenArticle = $this->modelNameBlogArticles::where($this->blogCategoryId, '=', '3')
        //                                         ->where($this->blogArticleIsActive, '<>', '0')
        //                                         ->get();
        //     if ($displayWrittenArticle->isEmpty()) 
        //     {
        //         return response([
        //             $this->notifyCode  => 'INFO_0001',
        //             $this->userMessage => __('blog_articles.index.info_0001_admin_message.message_2'),
        //             $this->results     => $displayWrittenArticle,
        //         ], 200);
        //     }
        //     else 
        //     {
        //         return response([
        //             $this->notifyCode  => 'INFO_0002',
        //             $this->userMessage => __('blog_articles.index.info_0002_admin_message.message_2'),
        //             $this->results     => $displayWrittenArticle,
        //         ], 200);
        //     }
        // }
        // else 
        // {
        //     return response([
        //         $this->notifyCode             => 'INFO_0018',
        //         $this->notifyShortDescription => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0018')->pluck($this->notifyShortDescription)[0],
        //         $this->notifyReference        => $this->modelNameErrorSystem::where($this->notifyCode, '=', 'INFO_0018')->pluck($this->notifyReference)[0],
        //         $this->userMessage            => 'The resource you are trying to view does not exist on the server! Please contact the website administrator!',
        //     ], 404);
        // }
    }
}
