<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogArticle extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'blog_articles';

    /**
     * The primary key associated with the table.
     * 
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * The attributes that are mass assignable.
     * 
     * @var string
     */
    protected $fillable = [
        'blog_category_id',
        'blog_subcategory_id',
        'blog_article_title',
        'blog_article_short_description',
        'blog_article_content',
        'blog_article_slug',
        'blog_article_is_audio',
        'blog_article_is_video',
        'blog_article_is_active',
        'blog_article_reading_time',
    ];

    /**
     * The attributes that are mass assignable.
     * 
     * @var string
     */
    protected $attributes = [
        'blog_article_is_audio'  => false,
        'blog_article_is_video'  => false,
        'blog_article_is_active' => false,
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
     * Cast timestamp columns.
     */
    protected $casts = [
        'created_at' => 'date:d.m.Y',
        'updated_at' => 'date:d.m.Y',
    ];

    /**
     * Eloquent relationship between Blog Subcategories and Articles.
     * Many blog articles may have only one blog subcategory.
     */
    public function blog_subcategory()
    {
        return $this->belongsTo('App\Models\BlogSubcategory');
    }

    /**
     * Eloquent relationship between Blog Articles and Article Comments.
     * One blog article may have one or many blog article comments.
     */
    public function blog_article_comments()
    {
        return $this->hasMany('App\Models\BlogArticleComment');
    }
}
