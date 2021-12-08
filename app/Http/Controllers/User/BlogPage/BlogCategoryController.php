<?php

namespace App\Http\Controllers\User\BlogPage;

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
        //
    }

    /**
     * Display a listing of all blog main categories and subcategories.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllBlogMainCategoriesAndSubcategories()
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
