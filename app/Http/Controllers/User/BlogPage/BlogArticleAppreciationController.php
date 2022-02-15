<?php

namespace App\Http\Controllers\User\BlogPage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\BlogArticle;
use App\Models\BlogArticleAppreciation;

class BlogArticleAppreciationController extends Controller
{
    protected $modelNameUsers;
    protected $modelNameBlogArticles;
    protected $modelNameBlogArticleAppreciation;

    /**
     * Instantiate the variables that will be used to get the model.
     * 
     * @return Collection
     */
    public function __construct()
    {
        $this->modelNameUsers                   = new User();
        $this->modelNameBlogArticles            = new BlogArticle();
        $this->modelNameBlogArticleAppreciation = new BlogArticleAppreciation();
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
        //
    }

    /**
     * Store information about which user liked the article.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function likeTheArticle(Request $request)
    {
        //
    }

    /**
     * Store information about which user disliked the article.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dislikeTheArticle(Request $request)
    {
        //
    }

    /**
     * Store information about which user liked the comment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function likeTheComment(Request $request)
    {
        //
    }

    /**
     * Store information about which user disliked the comment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dislikeTheComment(Request $request)
    {
        //
    }

    /**
     * Store information about which user liked the comment reply.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function likeTheCommentReply(Request $request)
    {
        //
    }

    /**
     * Store information about which user disliked the comment reply.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dislikeTheCommentReply(Request $request)
    {
        //
    }
}
