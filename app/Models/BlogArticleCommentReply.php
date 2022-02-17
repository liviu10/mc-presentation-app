<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogArticleCommentReply extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'blog_article_comment_replies';

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
    protected $foreignKey = 'blog_article_comment_id';
    
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
        'blog_article_comment_id',
        'full_name',
        'email',
        'comment_reply',
        'comment_reply_is_public',
        'privacy_policy',
    ];

    /**
     * The attributes that are mass assignable.
     * 
     * @var string
     */
    protected $attributes = [
        'comment_reply_is_public' => false,
        'privacy_policy'          => false,
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

    public function scopeIsCommentReplyPublic ($query) 
    {
        return $query->where('comment_reply_is_public', true);
    }

    public function scopeIsNotCommentReplyPublic ($query) 
    {
        return $query->where('comment_reply_is_public', false);
    }

    /**
     * Eloquent relationship between blog_article_comment_replies and blog_article_comment_reply_likes.
     * One blog article comment reply may have one or more blog article comment reply likes.
     */
    public function blog_article_comment_reply_like()
    {
        return $this->hasMany('App\Models\BlogArticleCommentReplyLike');
    }

    /**
     * Eloquent relationship between blog_article_comments and blog_article_comment_dislikes.
     * One blog article comment may have one or more blog article comment dislikes.
     */
    public function blog_article_comment_reply_dislike()
    {
        return $this->hasMany('App\Models\BlogArticleCommentReplyDislike');
    }

    /**
     * Eloquent relationship between blog_article_comment_replies and blog_article_comment_reply_dislikes.
     * One blog article comment reply may have one or more blog article comment reply dislikes.
     */
    public function blog_article_comment()
    {
        return $this->belongsTo('App\Models\BlogArticleComment');
    }
}