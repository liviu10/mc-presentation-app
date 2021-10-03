<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogSubcategory extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'blog_subcategories';

    /**
     * The primary key associated with the table.
     * 
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     * 
     * @var string
     */
    protected $fillable = [
        'blog_category_id',
        'blog_subcategory_title',
        'blog_subcategory_short_description',
        'blog_subcategory_description',
        'blog_subcategory_is_active',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Eloquent relationship between Blog Categories and Subcategories.
     * Many blog subcategories may have only one blog category.
     */
    public function blog_category()
    {
        return $this->belongsTo('App\Models\BlogCategory');
    }

    /**
     * Eloquent relationship between Blog Subcategories and Articles.
     * One blog subcategory may have one or many blog articles.
     */
    public function blog_articles()
    {
        return $this->hasMany('App\Models\BlogArticle');
    }
}
