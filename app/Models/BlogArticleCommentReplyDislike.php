<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogArticleCommentReplyDislike extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'blog_article_comment_reply_dislike';

    /**
     * The primary key associated with the table.
     * 
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The foreign key associated with the table.
     * 
     * @var array
     */
    protected $foreignKey = [
        'user_id',
        'blog_article_comment_reply_id'
    ];
    
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
        'user_id',
        'blog_article_comment_reply_id',
        'blog_article_comment_reply_dislikes',
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
     * Eloquent relationship between blog_article_appreciation and user.
     * One or many blog article appreciation may have only one user.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Eloquent relationship between blog_article_appreciation and blog_article_comment_replies.
     * One or many blog article comment reply like(s) appreciation may have only one blog article comment reply.
     */
    public function blog_article_comment()
    {
        return $this->belongsTo('App\Models\BlogArticleCommentReply');
    }
}