<?php

namespace App\Http\Controllers\User\BlogPage;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;

class BlogCategoryController extends Controller
{
    protected $modelNameBlogCategories;

    /**
     * Instantiate the variables that will be used to get the model.
     * 
     * @return Collection
     */
    public function __construct()
    {
        $this->modelNameBlogCategories = new BlogCategory();
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
     * @return Illuminate\Http\JsonResponse
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
        ->IsActive()
        ->whereIn('blog_category_title', ['ARTICOLE', 'AUDIO', 'VIDEO'])
        ->with([
            'blog_subcategories' => function ($query) {
                $query->select('blog_category_id', 'blog_subcategory_title', 'blog_subcategory_path')->IsActive();
            }
        ])
        ->get();

        return ($allBlogCategoriesAndSubcategories->isEmpty()) ? response([], 404)->json() : response()->json($allBlogCategoriesAndSubcategories);
    }
}
