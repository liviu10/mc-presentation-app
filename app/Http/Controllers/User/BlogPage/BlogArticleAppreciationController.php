<?php

namespace App\Http\Controllers\User\BlogPage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\BlogArticle;
use App\Models\BlogArticleRate;
use App\Models\BlogArticleLike;
use App\Models\BlogArticleDislike;
use App\Models\BlogArticleComment;
use App\Models\BlogArticleCommentLike;
use App\Models\BlogArticleCommentDislike;
use App\Models\BlogArticleCommentReply;
use App\Models\BlogArticleCommentReplyLike;
use App\Models\BlogArticleCommentReplyDislike;

class BlogArticleAppreciationController extends Controller
{
    protected $modelNameUsers;
    protected $modelNameBlogArticles;
    protected $modelNameBlogArticleRate;
    protected $modelNameBlogArticleLike;
    protected $modelNameBlogArticleDislike;
    protected $modelNameBlogArticleComment;
    protected $modelNameBlogArticleCommentLike;
    protected $modelNameBlogArticleCommentDislike;
    protected $modelNameBlogArticleCommentReply;
    protected $modelNameBlogArticleCommentReplyLike;
    protected $modelNameBlogArticleCommentReplyDislike;

    /**
     * Instantiate the variables that will be used to get the model.
     * 
     * @return Collection
     */
    public function __construct()
    {
        $this->modelNameUsers                          = new User();
        $this->modelNameBlogArticles                   = new BlogArticle();
        $this->modelNameBlogArticleRate                = new BlogArticleRate();
        $this->modelNameBlogArticleLike                = new BlogArticleLike();
        $this->modelNameBlogArticleDislike             = new BlogArticleDislike();
        $this->modelNameBlogArticleComment             = new BlogArticleComment();
        $this->modelNameBlogArticleCommentLike         = new BlogArticleCommentLike();
        $this->modelNameBlogArticleCommentDislike      = new BlogArticleCommentDislike();
        $this->modelNameBlogArticleCommentReply        = new BlogArticleCommentReply();
        $this->modelNameBlogArticleCommentReplyLike    = new BlogArticleCommentReplyLike();
        $this->modelNameBlogArticleCommentReplyDislike = new BlogArticleCommentReplyDislike();
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
     * Store information about which user rated the article.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function rateTheArticle(Request $request)
    {
        dd($request->all());
    }

    /**
     * Store information about which user liked the article.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function likeTheArticle(Request $request)
    {
        dd($request->all());
    }

    /**
     * Store information about which user disliked the article.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dislikeTheArticle(Request $request)
    {
        dd($request->all());
    }

    /**
     * Store information about which user liked the comment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function likeTheComment(Request $request)
    {
        dd($request->all());
    }

    /**
     * Store information about which user disliked the comment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dislikeTheComment(Request $request)
    {
        dd($request->all());
    }

    /**
     * Store information about which user liked the comment reply.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function likeTheCommentReply(Request $request)
    {
        dd($request->all());
    }

    /**
     * Store information about which user disliked the comment reply.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dislikeTheCommentReply(Request $request)
    {
        dd($request->all());
    }
}
