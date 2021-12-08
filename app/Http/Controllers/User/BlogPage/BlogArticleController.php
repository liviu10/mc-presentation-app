<?php

namespace App\Http\Controllers\User\BlogPage;

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
    protected $blogArticleTime;
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
        $this->blogArticleTime             = 'blog_article_time';
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
        // 
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
            $allWrittenBlogArticles = $this->modelNameBlogArticles::select(
                $this->blogArticleId,
                $this->blogArticleTitle,
                $this->blogArticleTime,
                $this->blogCreatedAt,
                $this->blogUpdatedAt,
                $this->blogArticleShortDescription,
                $this->blogArticleSlug,
            )
            ->where($this->blogCategoryId, '=', '1')
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
            $allAudioBlogArticles = $this->modelNameBlogArticles::select(
                $this->blogArticleId,
                $this->blogArticleTitle,
                $this->blogArticleTime,
                $this->blogCreatedAt,
                $this->blogUpdatedAt,
                $this->blogArticleShortDescription,
                $this->blogArticleSlug,
            )
            ->where($this->blogCategoryId, '=', '2')
            ->where($this->blogArticleIsAudio, '=', '1')
            ->where($this->blogArticleIsActive, '<>', '0')
            ->orderBy('created_at', 'DESC')
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
            $allVideoBlogArticles = $this->modelNameBlogArticles::select(
                $this->blogArticleId,
                $this->blogArticleTitle,
                $this->blogArticleTime,
                $this->blogCreatedAt,
                $this->blogUpdatedAt,
                $this->blogArticleShortDescription,
                $this->blogArticleSlug,
            )
            ->where($this->blogCategoryId, '=', '3')
            ->where($this->blogArticleIsVideo, '=', '1')
            ->where($this->blogArticleIsActive, '<>', '0')
            ->orderBy('created_at', 'DESC')
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
    public function displaySingleBlogArticle($id)
    {
        if (response($this->index())->status() === 200) 
        {
            $displayBlogArticle = $this->modelNameBlogArticles::select(
                $this->blogArticleId,
                $this->blogArticleTitle,
                $this->blogArticleAuthor,
                $this->blogCreatedAt,
                $this->blogArticleTime,
                $this->blogArticleShortDescription,
                $this->blogArticleContent,
                $this->blogArticleRatingSystem,
                $this->blogArticleLikes,
                $this->blogArticleDislikes,
                $this->blogCreatedAt,
                $this->blogUpdatedAt,
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
                $this->results     => $displayBlogArticle,
            ], 200);
            if ($displayBlogArticle->isEmpty()) 
            {
                return response([
                    $this->notifyCode  => 'INFO_0001',
                    $this->userMessage => __('blog_articles.index.info_0001_admin_message.message_2'),
                    $this->results     => $displayBlogArticle,
                ], 200);
            }
            else 
            {
                return response([
                    $this->notifyCode  => 'INFO_0002',
                    $this->userMessage => __('blog_articles.index.info_0002_admin_message.message_2'),
                    $this->results     => $displayBlogArticle,
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
