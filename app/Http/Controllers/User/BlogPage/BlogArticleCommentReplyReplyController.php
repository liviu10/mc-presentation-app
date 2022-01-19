<?php

namespace App\Http\Controllers\User\BlogPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogArticleCommentReplyReply;

class BlogArticleCommentReplyReplyController extends Controller
{
    protected $modelNameBlogArticleCommentReplyReply;

    /**
     * Instantiate the variables that will be used to get the model.
     * 
     * @return Collection
     */
    public function __construct()
    {
        $this->modelNameBlogArticleCommentReplyReply = new BlogArticleCommentReplyReply();
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try 
        {
            $request->validate([
                'full_name'              => 'required|regex:/^[a-zA-Z_ ]+$/u|max:255',
                'email'                  => 'required|email:filter|max:255',
                'reply_to_comment_reply' => 'required|min:5',
            ]);
            if (is_null($request->get('comment_reply_is_public')) && is_null($request->get('privacy_policy'))) 
            {
                $records = $this->modelNameBlogArticleCommentReplyReply->create([
                    'blog_article_comment_reply_id' => $request->get('blog_article_comment_reply_id'),
                    'full_name'                     => $request->get('full_name'),
                    'email'                         => $request->get('email'),
                    'reply_to_comment_reply'        => $request->get('reply_to_comment_reply'),
                    'comment_reply_is_public'       => '0',
                    'privacy_policy'                => '0',
                ]);
            }
            if ($request->get('comment_reply_is_public') === 1 && is_null($request->get('privacy_policy'))) 
            {
                $records = $this->modelNameBlogArticleCommentReplyReply->create([
                    'blog_article_comment_reply_id' => $request->get('blog_article_comment_reply_id'),
                    'full_name'                     => $request->get('full_name'),
                    'email'                         => $request->get('email'),
                    'reply_to_comment_reply'        => $request->get('reply_to_comment_reply'),
                    'comment_reply_is_public'       => '1',
                    'privacy_policy'                => '0',
                ]);
            }
            if (is_null($request->get('comment_reply_is_public')) || $request->get('privacy_policy') === 1) 
            {
                $records = $this->modelNameBlogArticleCommentReplyReply->create([
                    'blog_article_comment_reply_id' => $request->get('blog_article_comment_reply_id'),
                    'full_name'                     => $request->get('full_name'),
                    'email'                         => $request->get('email'),
                    'reply_to_comment_reply'        => $request->get('reply_to_comment_reply'),
                    'comment_reply_is_public'       => '0',
                    'privacy_policy'                => '1',
                ]);
            }
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
     * Display the last inserted comment reply.
     *
     * @return Illuminate\Http\Response
     */
    public function displayLastInsertedCommentReply()
    {
        $displayLastInsertedReplyToCommentReply = $this->modelNameBlogArticleCommentReplyReply::select(
            'id',
            'blog_article_comment_reply_id',
            'full_name',
            'email',
            'reply_to_comment_reply',
        )
        ->IsCommentReplyPublic()
        ->get();
        
        if ($displayLastInsertedReplyToCommentReply->isEmpty()) 
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
                'records'            => $displayLastInsertedReplyToCommentReply,
            ], 200);
        }
    }
}
