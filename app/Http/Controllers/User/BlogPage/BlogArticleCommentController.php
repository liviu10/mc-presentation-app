<?php

namespace App\Http\Controllers\User\BlogPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogArticleComment;
use App\Models\BlogArticleCommentReply;

class BlogArticleCommentController extends Controller
{
    protected $modelNameBlogArticleComment;
    protected $modelNameBlogArticleCommentReply;

    /**
     * Instantiate the variables that will be used to get the model.
     * 
     * @return Collection
     */
    public function __construct()
    {
        $this->modelNameBlogArticleComment = new BlogArticleComment();
        $this->modelNameBlogArticleCommentReply = new BlogArticleCommentReply();
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
     * Add a new comment to the selected blog article.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addNewComment(Request $request)
    {
        try 
        {
            $request->validate([
                'full_name'      => 'required|regex:/^[a-zA-Z_ ]+$/u|max:255',
                'email'          => 'required|email:filter|max:255',
                'comment'        => 'required|min:5',
            ]);
            $records = $this->modelNameBlogArticleComment->create([
                'blog_article_id'   => $request->get('blog_article_id'),
                'full_name'         => $request->get('full_name'),
                'email'             => $request->get('email'),
                'comment'           => $request->get('comment'),
                'comment_is_public' => $request->get('comment_is_public'),
                'privacy_policy'    => $request->get('privacy_policy'),
            ]);
            $apiInsertSingleRecord = [
                'full_name' => $records['full_name'],
            ];
            return response()->json($apiInsertSingleRecord);
        }
        catch  (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                return response([], 500)->json();
            }
            if ($mysqlError->getCode() === '42S22') 
            {
                return response([], 500)->json();
            }
        }
    }

    /**
     * Respond to a comment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function respondToComment(Request $request)
    {
        try 
        {
            $request->validate([
                'full_name'      => 'required|regex:/^[a-zA-Z_ ]+$/u|max:255',
                'email'          => 'required|email:filter|max:255',
                'comment_reply'  => 'required|min:5',
            ]);
            $records = $this->modelNameBlogArticleCommentReply->create([
                'blog_article_comment_id' => $request->get('blog_article_comment_id'),
                'full_name'               => $request->get('full_name'),
                'email'                   => $request->get('email'),
                'comment_reply'           => $request->get('comment_reply'),
                'comment_reply_is_public' => $request->get('comment_reply_is_public'),
                'privacy_policy'          => $request->get('privacy_policy_comment_reply'),
            ]);
            $apiInsertSingleRecord = [
                'full_name' => $records['full_name'],
            ];
            return response()->json($apiInsertSingleRecord);
        }
        catch  (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                return response([], 500)->json();
            }
            if ($mysqlError->getCode() === '42S22') 
            {
                return response([], 500)->json();
            }
        }
    }

    /**
     * Respond to a comment reply.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function respondToCommentReply(Request $request)
    {
        // try 
        // {
        //     $request->validate([
        //         'full_name'      => 'required|regex:/^[a-zA-Z_ ]+$/u|max:255',
        //         'email'          => 'required|email:filter|max:255',
        //         'comment_reply'  => 'required|min:5',
        //     ]);
        //     $records = $this->modelNameBlogArticleCommentReply->create([
        //         'blog_article_comment_id' => $request->get('blog_article_comment_reply_id'),
        //         'full_name'               => $request->get('full_name'),
        //         'email'                   => $request->get('email'),
        //         'comment_reply'           => $request->get('respond_to_comment_reply'),
        //         'comment_reply_is_public' => $request->get('respond_to_comment_reply_is_public'),
        //         'privacy_policy'          => $request->get('privacy_policy_respond_to_comment_reply'),
        //     ]);
        //     $apiInsertSingleRecord = [
        //         'full_name' => $records['full_name'],
        //     ];
        //     return response()->json($apiInsertSingleRecord);
        // }
        // catch  (\Illuminate\Database\QueryException $mysqlError)
        // {
        //     if ($mysqlError->getCode() === '42S02') 
        //     {
        //         return response([], 500)->json();
        //     }
        //     if ($mysqlError->getCode() === '42S22') 
        //     {
        //         return response([], 500)->json();
        //     }
        // }
    }

    /**
     * Display the last inserted comment.
     *
     * @return Illuminate\Http\Response
     */
    public function displayLastInsertedComment($id)
    {
        $displayLastInsertedComment = $this->modelNameBlogArticleComment::select(
            'id',
            'blog_article_id',
            'full_name',
            'email',
            'comment',
        )
        ->IsCommentPublic()
        ->get();
        
        if ($displayLastInsertedComment->isEmpty()) 
        {
            return response([
                'title'              => 'Resource(s) not found!',
                'notify_code'        => 'WAR_00001',
                'description'        => 'The blog resource(s) does not exist! Please try again later!',
                'http_response_code' => 404,
                'records'            => [],
            ], 404);
        }
        else 
        {
            return response([
                'title'              => 'Success!',
                'notify_code'        => 'INFO_00001',
                'description'        => 'The blog resource(s) was(were) successfully fetched!',
                'http_response_code' => 200,
                'records'            => $displayLastInsertedComment,
            ], 200);
        }
    }

    /**
     * Display the last inserted comment reply.
     *
     * @return Illuminate\Http\Response
     */
    public function displayLastInsertedCommentReply()
    {
        $displayLastInsertedCommentReply = $this->modelNameBlogArticleCommentReply::select(
            'id',
            'blog_article_id',
            'full_name',
            'email',
            'comment_reply',
        )
        ->IsCommentReplyPublic()
        ->get();
        
        if ($displayLastInsertedCommentReply->isEmpty()) 
        {
            return response([
                'title'              => 'Resource(s) not found!',
                'notify_code'        => 'WAR_00001',
                'description'        => 'The blog resource(s) does not exist! Please try again later!',
                'http_response_code' => 404,
                'records'            => [],
            ], 404);
        }
        else 
        {
            return response([
                'title'              => 'Success!',
                'notify_code'        => 'INFO_00001',
                'description'        => 'The blog resource(s) was(were) successfully fetched!',
                'http_response_code' => 200,
                'records'            => $displayLastInsertedCommentReply,
            ], 200);
        }
    }
}
