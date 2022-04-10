<?php

namespace App\Http\Controllers\User\BlogPage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogArticleRate;
use App\Models\BlogArticleLike;
use App\Models\BlogArticleDislike;
use App\Models\BlogArticleCommentLike;
use App\Models\BlogArticleCommentDislike;
use App\Models\BlogArticleCommentReplyLike;
use App\Models\BlogArticleCommentReplyDislike;

class BlogArticleAppreciationController extends Controller
{
    protected $modelNameBlogArticleRate;
    protected $modelNameBlogArticleLike;
    protected $modelNameBlogArticleDislike;
    protected $modelNameBlogArticleCommentLike;
    protected $modelNameBlogArticleCommentDislike;
    protected $modelNameBlogArticleCommentReplyLike;
    protected $modelNameBlogArticleCommentReplyDislike;

    /**
     * Instantiate the variables that will be used to get the model.
     * 
     * @return Collection
     */
    public function __construct()
    {
        $this->modelNameBlogArticleRate                = new BlogArticleRate();
        $this->modelNameBlogArticleLike                = new BlogArticleLike();
        $this->modelNameBlogArticleDislike             = new BlogArticleDislike();
        $this->modelNameBlogArticleCommentLike         = new BlogArticleCommentLike();
        $this->modelNameBlogArticleCommentDislike      = new BlogArticleCommentDislike();
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
        $requestUserId = $request->get('user_id');
        $requestBlogArticleId = $request->get('blog_article_id');

        $alreadyRatedTheArticle = $this->modelNameBlogArticleRate->select('user_id', 'blog_article_id')
                                    ->where('user_id', '=', $requestUserId)
                                    ->where('blog_article_id', '=', $requestBlogArticleId)
                                    ->count();

        if ($alreadyRatedTheArticle !== 0) {
            return response(false, 406);
        }
        else {
            $this->modelNameBlogArticleRate->create([
                'user_id'                    => $request->get('user_id'),
                'blog_article_id'            => $request->get('blog_article_id'),
                'blog_article_rating_system' => $request->get('blog_article_rating_system'),
            ]);
            $averageBlogArticleRates = collect($this->modelNameBlogArticleRate->select('blog_article_rating_system')->get())->avg('blog_article_rating_system');
            return response($averageBlogArticleRates);
        }
    }

    /**
     * Remove the information about which user rated the article.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function removeTheRatedArticle(Request $request)
    {
        $this->modelNameBlogArticleRate->select('user_id', 'blog_article_id')
                ->where('user_id', '=', $request->get('user_id'))
                ->where('blog_article_id', '=', $request->get('blog_article_id'))
                ->delete();
        return response(true);
    }

    /**
     * Store information about which user liked the article.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function likeTheArticle(Request $request)
    {
        $requestUserId = $request->get('user_id');
        $requestBlogArticleId = $request->get('blog_article_id');

        $alreadyLikedTheArticle = $this->modelNameBlogArticleLike->select('user_id', 'blog_article_id')
                                    ->where('user_id', '=', $requestUserId)
                                    ->where('blog_article_id', '=', $requestBlogArticleId)
                                    ->count();

        if ($alreadyLikedTheArticle !== 0) {
            return response(false, 406);
        }
        else {
            $this->modelNameBlogArticleLike->create([
                'user_id'            => $request->get('user_id'),
                'blog_article_id'    => $request->get('blog_article_id'),
                'blog_article_likes' => $request->get('blog_article_likes'),
            ]);
            return response(true);
        }
    }

    /**
     * Remove the information about which user liked the article.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function removeTheLikedArticle(Request $request)
    {
        $this->modelNameBlogArticleLike->select('user_id', 'blog_article_id')
                ->where('user_id', '=', $request->get('user_id'))
                ->where('blog_article_id', '=', $request->get('blog_article_id'))
                ->delete();
        return response(true);
    }

    /**
     * Store information about which user disliked the article.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dislikeTheArticle(Request $request)
    {
        $requestUserId = $request->get('user_id');
        $requestBlogArticleId = $request->get('blog_article_id');

        $alreadyDislikedTheArticle = $this->modelNameBlogArticleDislike->select('user_id', 'blog_article_id')
                                        ->where('user_id', '=', $requestUserId)
                                        ->where('blog_article_id', '=', $requestBlogArticleId)
                                        ->count();

        if ($alreadyDislikedTheArticle !== 0) {
            return response(false, 406);
        }
        else {
            $this->modelNameBlogArticleDislike->create([
                'user_id'               => $request->get('user_id'),
                'blog_article_id'       => $request->get('blog_article_id'),
                'blog_article_dislikes' => $request->get('blog_article_dislikes'),
            ]);
            return response(true);
        }
    }

    /**
     * Remove the information about which user disliked the article.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function removeTheDislikedArticle(Request $request)
    {
        $this->modelNameBlogArticleDislike->select('user_id', 'blog_article_id')
                ->where('user_id', '=', $request->get('user_id'))
                ->where('blog_article_id', '=', $request->get('blog_article_id'))
                ->delete();
        return response(true);
    }

    /**
     * Store information about which user liked the comment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function likeTheComment(Request $request)
    {
        $requestUserId = $request->get('user_id');
        $requestBlogArticleCommentId = $request->get('blog_article_comment_id');

        $alreadyLikedTheComment = $this->modelNameBlogArticleCommentLike->select('user_id', 'blog_article_comment_id')
                                    ->where('user_id', '=', $requestUserId)
                                    ->where('blog_article_comment_id', '=', $requestBlogArticleCommentId)
                                    ->count();

        if ($alreadyLikedTheComment !== 0) {
            return response(false, 406);
        }
        else {
            $this->modelNameBlogArticleCommentLike->create([
                'user_id'                    => $request->get('user_id'),
                'blog_article_comment_id'    => $request->get('blog_article_comment_id'),
                'blog_article_comment_likes' => $request->get('blog_article_comment_likes'),
            ]);
            return response(true);
        }
    }

    /**
     * Remove the information about which user liked the comment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function removeTheLikedComment(Request $request)
    {
        $this->modelNameBlogArticleCommentLike->select('user_id', 'blog_article_comment_id')
                ->where('user_id', '=', $request->get('user_id'))
                ->where('blog_article_comment_id', '=', $request->get('blog_article_comment_id'))
                ->delete();
        return response(true);
    }

    /**
     * Store information about which user disliked the comment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dislikeTheComment(Request $request)
    {
        $requestUserId = $request->get('user_id');
        $requestBlogArticleCommentId = $request->get('blog_article_comment_id');

        $alreadyDislikedTheComment = $this->modelNameBlogArticleCommentDislike->select('user_id', 'blog_article_comment_id')
                                        ->where('user_id', '=', $requestUserId)
                                        ->where('blog_article_comment_id', '=', $requestBlogArticleCommentId)
                                        ->count();

        if ($alreadyDislikedTheComment !== 0) {
            return response(false, 406);
        }
        else {
            $this->modelNameBlogArticleCommentDislike->create([
                'user_id'                       => $request->get('user_id'),
                'blog_article_comment_id'       => $request->get('blog_article_comment_id'),
                'blog_article_comment_dislikes' => $request->get('blog_article_comment_dislikes'),
            ]);
            return response(true);
        }
    }

    /**
     * Remove the information about which user disliked the comment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function removeTheDislikedComment(Request $request)
    {
        $this->modelNameBlogArticleCommentDislike->select('user_id', 'blog_article_comment_id')
                ->where('user_id', '=', $request->get('user_id'))
                ->where('blog_article_comment_id', '=', $request->get('blog_article_comment_id'))
                ->delete();
        return response(true);
    }

    /**
     * Store information about which user liked the comment reply.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function likeTheCommentReply(Request $request)
    {
        $requestUserId = $request->get('user_id');
        $requestBlogArticleCommentReplyId = $request->get('blog_article_comment_reply_id');

        $alreadyLikedTheCommentReply = $this->modelNameBlogArticleCommentReplyLike->select('user_id', 'blog_article_comment_reply_id')
                                            ->where('user_id', '=', $requestUserId)
                                            ->where('blog_article_comment_reply_id', '=', $requestBlogArticleCommentReplyId)
                                            ->count();

        if ($alreadyLikedTheCommentReply !== 0) {
            return response(false, 406);
        }
        else {
            $this->modelNameBlogArticleCommentReplyLike->create([
                'user_id'                          => $request->get('user_id'),
                'blog_article_comment_reply_id'    => $request->get('blog_article_comment_reply_id'),
                'blog_article_comment_reply_likes' => $request->get('blog_article_comment_reply_likes'),
            ]);
            return response(true);
        }
    }

    /**
     * Remove the information about which user liked the comment reply.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function removeTheLikedCommentReply(Request $request)
    {
        $this->modelNameBlogArticleCommentReplyLike->select('user_id', 'blog_article_comment_reply_id')
                ->where('user_id', '=', $request->get('user_id'))
                ->where('blog_article_comment_reply_id', '=', $request->get('blog_article_comment_reply_id'))
                ->delete();
        return response(true);
    }

    /**
     * Store information about which user disliked the comment reply.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dislikeTheCommentReply(Request $request)
    {
        $requestUserId = $request->get('user_id');
        $requestBlogArticleCommentReplyId = $request->get('blog_article_comment_reply_id');

        $alreadyDislikedTheCommentReply = $this->modelNameBlogArticleCommentReplyDislike->select('user_id', 'blog_article_comment_reply_id')
                                                ->where('user_id', '=', $requestUserId)
                                                ->where('blog_article_comment_reply_id', '=', $requestBlogArticleCommentReplyId)
                                                ->count();

        if ($alreadyDislikedTheCommentReply !== 0) {
            return response(false, 406);
        }
        else {
            $this->modelNameBlogArticleCommentReplyDislike->create([
                'user_id'                             => $request->get('user_id'),
                'blog_article_comment_reply_id'       => $request->get('blog_article_comment_reply_id'),
                'blog_article_comment_reply_dislikes' => $request->get('blog_article_comment_reply_dislikes'),
            ]);
            return response(true);
        }
    }

    /**
     * Remove the information about which user disliked the comment reply.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function removeTheDislikedCommentReply(Request $request)
    {
        $this->modelNameBlogArticleCommentReplyDislike->select('user_id', 'blog_article_comment_reply_id')
                ->where('user_id', '=', $request->get('user_id'))
                ->where('blog_article_comment_reply_id', '=', $request->get('blog_article_comment_reply_id'))
                ->delete();
        return response(true);
    }
}
