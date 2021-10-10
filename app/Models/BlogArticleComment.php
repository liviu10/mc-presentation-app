<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogArticleComment extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'blog_article_comments';

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
        'blog_article_id',
        'full_name',
        'email',
        'comment',
        'comment_is_public',
        'privacy_policy',
    ];

    /**
     * The attributes that are mass assignable.
     * 
     * @var string
     */
    protected $attributes = [
        'comment_is_public' => false,
        'privacy_policy'    => false,
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
     * Eloquent relationship between Blog Articles and Article Comments.
     * Many blog articles comments may have only one blog article.
     */
    public function blog_article()
    {
        return $this->belongsTo('App\Models\BlogArticle');
    }

    /**
     * Eloquent relationship between Blog Article Comments and Article Comment Replies.
     * One blog article comment may have one or many blog article comment replies.
     */
    public function blog_article_comment_replies()
    {
        return $this->hasMany('App\Models\BlogArticleCommentReply');
    }
}
