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
     * The foreign key associated with the table.
     * 
     * @var string
     */
    protected $foreignKey = 'blog_article_id';
    
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
    ];

    public function scopeIsCommentPublic ($query) 
    {
        return $query->where('comment_is_public', true);
    }

    public function scopeIsNotCommentPublic ($query) 
    {
        return $query->where('comment_is_public', false);
    }

    /**
     * Eloquent relationship between blog_article_comments and blog_article_comment_replies.
     * One blog article comment may have one or more blog article comment replies.
     */
    public function blog_article_comment_replies()
    {
        return $this->hasMany('App\Models\BlogArticleCommentReply');
    }

    /**
     * Eloquent relationship between blog_article_comments and blog_article_comment_likes.
     * One blog article comment may have one or more blog article comment likes.
     */
    public function blog_article_comment_like()
    {
        return $this->hasMany('App\Models\BlogArticleCommentLike');
    }

    /**
     * Eloquent relationship between blog_article_comments and blog_article_comment_dislikes.
     * One blog article comment may have one or more blog article comment dislikes.
     */
    public function blog_article_comment_dislike()
    {
        return $this->hasMany('App\Models\BlogArticleCommentDislike');
    }

    /**
     * Eloquent relationship between blog_article_comments and blog_articles.
     * One or many blog article comment(s) may have only one blog article.
     */
    public function blog_article()
    {
        return $this->belongsTo('App\Models\BlogArticle');
    }
}