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
     * @return Illuminate\Http\Response
     */
    public function getAllBlogMainCategoriesAndSubcategories()
    {
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

        if ($allBlogCategoriesAndSubcategories->isEmpty()) 
        {
            return response([
                'title'              => 'Resource(s) not found!',
                'notify_code'        => 'WAR_00001',
                'description'        => 'The blog resource(s) does not exist! Please try again later!',
                'http_response_code' => 404,
                'records'            => [],
            ], 404);
        }
        else 
        {
            return response([
                'title'              => 'Success!',
                'notify_code'        => 'INFO_00001',
                'description'        => 'The blog resource(s) was(were) successfully fetched!',
                'http_response_code' => 200,
                'records'            => $allBlogCategoriesAndSubcategories,
            ], 200);
        }
    }
}
