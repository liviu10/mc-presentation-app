<?php

namespace App\Http\Controllers\User\HomePage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsletterSubscriber;

class SubscribeToNewsletterController extends Controller
{
    protected $modelNameNewsletterSubscriber;

    /**
     * Instantiate the variables that will be used to get the model.
     * 
     * @return Collection
     */
    public function __construct()
    {
        $this->modelNameNewsletterSubscriber = new NewsletterSubscriber();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\ResponseJson
     */
    public function store(Request $request)
    {
        try 
        {
            $request->validate([
                'full_name'      => 'required|regex:/^[a-zA-Z_ ]+$/u|max:255',
                'email'          => 'required|email:filter|max:255|unique:newsletter',
            ]);
            $records = $this->modelNameNewsletterSubscriber->create([
                'newsletter_campaigns_id' => 1,
                'full_name'               => $request->get('full_name'),
                'email'                   => $request->get('email'),
                'privacy_policy'          => $request->get('privacy_policy'),
            ]);
            $apiInsertSingleRecord = [
                'newsletter_campaigns_id' => $records['newsletter_campaigns_id'],
                'full_name' => $records['full_name'],
                'email' => $records['email'],
                'privacy_policy' => $records['privacy_policy'],
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
     * Remove the specified resource from storage.
     *
     * @param  string  $email
     * @return \Illuminate\Http\ResponseJson
     */
    public function destroy($email)
    {
        try
        {
            $apiDisplayAllRecords = $this->modelNameNewsletterSubscriber->pluck('id');
            if ($apiDisplayAllRecords->isEmpty()) 
            {
                return response([], 404)->json();
            }
            $getEmailAddress = $this->modelNameNewsletterSubscriber->where('email', '=', $email)->pluck('email')[0];
            if (is_null($getEmailAddress)) 
            {
                return response([], 404)->json();
            }
            else 
            {
                $findUserIdByEmailAddress = $this->modelNameNewsletterSubscriber->where('email', '=', $email)->pluck('id')[0];
                $apiDeleteSingleRecord = $this->modelNameNewsletterSubscriber->find($findUserIdByEmailAddress)->delete();
                return response(true);
            }
        }
        catch (\Illuminate\Database\QueryException $mysqlError) 
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                return response([], 500)->json();
            }
        }
    }
}
