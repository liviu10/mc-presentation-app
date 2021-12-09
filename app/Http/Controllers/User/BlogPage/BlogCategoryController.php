<?php

namespace App\Http\Controllers\User\BlogPage;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\ErrorAndNotificationSystem;
use Illuminate\Support\Facades\DB;

class BlogCategoryController extends Controller
{
    protected $modelNameBlogCategories;
    protected $modelNameErrorSystem;

    /**
     * Instantiate the variables that will be used to get the model and table name as well as the table's columns.
     * 
     * @return Collection
     */
    public function __construct()
    {
        $this->modelNameBlogCategories      = new BlogCategory();
        $this->modelNameErrorSystem         = new ErrorAndNotificationSystem();
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
        // TODO: Limit blog_subcategories to 3 records for each blog_category record
        $allBlogCategoriesAndSubcategories = $this->modelNameBlogCategories::select(
            'id',
            'blog_category_title',
            'blog_category_short_description',
            'blog_image_card_url',
            'blog_category_path'
        )
        ->where('blog_category_is_active', '<>', '0')
        ->whereIn('blog_category_title', ['ARTICOLE', 'AUDIO', 'VIDEO'])
        ->with([
            'blog_subcategories' => function ($query) {
                $query->select('blog_category_id', 'blog_subcategory_title', 'blog_subcategory_slug')
                    ->where('blog_subcategory_is_active', '<>', '0');
            }
        ])
        ->get();

        return ($allBlogCategoriesAndSubcategories->isEmpty()) ? response([], 404)->json() : response()->json($allBlogCategoriesAndSubcategories);
    }
}
