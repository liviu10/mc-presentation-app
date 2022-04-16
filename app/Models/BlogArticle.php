<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Log;

class BlogArticle extends Model
{
    use HasFactory, SoftDeletes;

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
     * The foreign key associated with the table.
     * 
     * @var string
     */
    protected $foreignKey = 'blog_subcategory_id';
    
    /**
     * The data type of the database table foreign key.
     *
     * @var string
     */
    protected $foreignKeyType = 'int';

    /**
     * The attributes that are mass assignable.
     * 
     * @var string
     */
    protected $fillable = [
        'blog_subcategory_id',
        'blog_article_author',
        'blog_article_time',
        'blog_article_title',
        'blog_article_short_description',
        'blog_article_content',
        'blog_article_path',
        'blog_article_is_active',
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

    public function scopeIsActive ($query) 
    {
        return $query->where('blog_article_is_active', true);
    }

    public function scopeIsNotActive ($query) 
    {
        return $query->where('blog_article_is_active', false);
    }

    /**
     * Eloquent relationship between blog_articles and blog_article_comments.
     * One blog article may have one or more blog article comments.
     */
    public function blog_article_comments()
    {
        return $this->hasMany('App\Models\BlogArticleComment');
    }

    /**
     * Eloquent relationship between blog_articles and blog_article_rate.
     * One blog article may have one or more blog article rate.
     */
    public function blog_article_rate()
    {
        return $this->hasMany('App\Models\BlogArticleRate');
    }

    /**
     * Eloquent relationship between users and blog_article_like.
     * One blog article may have one or more blog article like.
     */
    public function blog_article_like()
    {
        return $this->hasMany('App\Models\BlogArticleLike');
    }

    /**
     * Eloquent relationship between users and blog_article_dislike.
     * One blog article may have one or more blog article dislike.
     */
    public function blog_article_dislike()
    {
        return $this->hasMany('App\Models\BlogArticleDislike');
    }

    /**
     * Eloquent relationship between blog_articles and blog_subcategories.
     * One or many blog article(s) may have only one blog subcategory.
     */
    public function blog_subcategory()
    {
        return $this->belongsTo('App\Models\BlogSubcategory');
    }

    /**
     * Eloquent polymorphic relationship between blog_articles and logs.
     *
     */
    public function log()
    {
        return $this->morphOne(Log::class, 'logable');
    }
}