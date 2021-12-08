<?php

namespace App\Http\Controllers\User\BlogPage;

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
        // 
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
