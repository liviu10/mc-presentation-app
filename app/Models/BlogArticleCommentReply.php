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

    /**
     * Eloquent relationship between Blog Article Comments and Article Comment Replies.
     * Many blog articles comment replies may have only one blog article comment.
     */
    public function blog_article_comment()
    {
        return $this->belongsTo('App\Models\BlogArticleComment');
    }
}
