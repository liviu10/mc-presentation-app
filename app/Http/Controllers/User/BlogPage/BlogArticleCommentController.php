<?php

namespace App\Http\Controllers\User\BlogPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogArticleComment;

class BlogArticleCommentController extends Controller
{
    protected $modelNameBlogArticleComment;

    /**
     * Instantiate the variables that will be used to get the model.
     * 
     * @return Collection
     */
    public function __construct()
    {
        $this->modelNameBlogArticleComment = new BlogArticleComment();
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
                'full_name'      => 'required|regex:/^[a-zA-Z_ ]+$/u|max:255',
                'email'          => 'required|email:filter|max:255',
                'comment'        => 'required|min:5',
            ]);
            if (is_null($request->get('comment_is_public')) && is_null($request->get('privacy_policy'))) 
            {
                $records = $this->modelNameBlogArticleComment->create([
                    'blog_article_id'   => $request->get('blog_article_id'),
                    'full_name'         => $request->get('full_name'),
                    'email'             => $request->get('email'),
                    'comment'           => $request->get('comment'),
                    'comment_is_public' => '0',
                    'privacy_policy'    => '0',
                ]);
            }
            if ($request->get('comment_is_public') === 1 && is_null($request->get('privacy_policy'))) 
            {
                $records = $this->modelNameBlogArticleComment->create([
                    'blog_article_id'   => $request->get('blog_article_id'),
                    'full_name'         => $request->get('full_name'),
                    'email'             => $request->get('email'),
                    'comment'           => $request->get('comment'),
                    'comment_is_public' => '1',
                    'privacy_policy'    => '0',
                ]);
            }
            if (is_null($request->get('comment_is_public')) || $request->get('privacy_policy') === 1) 
            {
                $records = $this->modelNameBlogArticleComment->create([
                    'blog_article_id'   => $request->get('blog_article_id'),
                    'full_name'         => $request->get('full_name'),
                    'email'             => $request->get('email'),
                    'comment'           => $request->get('comment'),
                    'comment_is_public' => '0',
                    'privacy_policy'    => '1',
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
}
