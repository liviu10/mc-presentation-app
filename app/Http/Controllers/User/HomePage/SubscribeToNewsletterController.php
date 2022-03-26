<?php

namespace App\Http\Controllers\User\HomePage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsletterCampaign;
use App\Models\NewsletterSubscriber;
use App\Models\AcceptedDomain;
use App\Mail\WelcomeNewsletter;
use Illuminate\Support\Facades\Mail;

class SubscribeToNewsletterController extends Controller
{
    protected $modelNameNewsletterCampaign;
    protected $modelNameNewsletterSubscriber;
    protected $modelNameAcceptedDomain;
    protected $tableNameNewsletterSubscriber;

    /**
     * Instantiate the variables that will be used to get the model.
     * 
     * @return Collection
     */
    public function __construct()
    {
        $this->modelNameNewsletterCampaign = new NewsletterCampaign();
        $this->modelNameNewsletterSubscriber = new NewsletterSubscriber();
        $this->modelNameAcceptedDomain = new AcceptedDomain();
        $this->tableNameNewsletterSubscriber = $this->modelNameNewsletterSubscriber->getTable();
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
                'full_name' => 'required|regex:/^[a-zA-Z_ ]+$/u|max:255',
                'email'     => 'required|email:filter|max:255|unique:newsletter_subscribers',
            ]);

            // Check the email address against the accepted domains
            $getEmailAddressProvider = $this->modelNameAcceptedDomain->select('id', 'domain')->where('domain', '=', '.' . explode('.', substr(strstr($request->get('email'), '@'), 1))[0])->get()->toArray();
            $getEmailAddressDomain = $this->modelNameAcceptedDomain->select('id', 'domain')->where('domain', '=', '.' . explode('.', substr(strstr($request->get('email'), '@'), 1))[1])->get()->toArray();

            if (count($getEmailAddressProvider) === 1 && count($getEmailAddressDomain) === 1) 
            {
                // The email provider and the domain exist in the accepted domain list and the script will proceed with the rest of the flow
                $getCurrentActiveCampaignId = $this->modelNameNewsletterCampaign->select('id', 'campaign_is_active')->where('campaign_is_active', '=', 1)->get()->toArray();
                // Allocate user to the current active newsletter campaign
                if (count($getCurrentActiveCampaignId) !== 0 && count($getCurrentActiveCampaignId) > 1) {
                    $records = $this->modelNameNewsletterSubscriber->create([
                        'newsletter_campaign_id'  => array_slice($getCurrentActiveCampaignId, 1)[0]['id'],
                        'full_name'               => $request->get('full_name'),
                        'email'                   => $request->get('email'),
                        'privacy_policy'          => $request->get('privacy_policy'),
                    ]);
                }
                // Allocate user to the generic newsletter campaign
                else {
                    $records = $this->modelNameNewsletterSubscriber->create([
                        'newsletter_campaign_id'  => 1,
                        'full_name'               => $request->get('full_name'),
                        'email'                   => $request->get('email'),
                        'privacy_policy'          => $request->get('privacy_policy'),
                    ]);
                }

                $email = $records['email'];
                Mail::to($email)->send(new WelcomeNewsletter($records));

                $apiInsertSingleRecord = [
                    'newsletter_campaign_id' => $records['newsletter_campaign_id'],
                    'full_name' => $records['full_name'],
                    'email' => $records['email'],
                    'privacy_policy' => $records['privacy_policy'],
                ];
                $this->modelNameNewsletterSubscriber->find($records->id)->log()->create([ 
                    'status'  => 'User subscribed to newsletter',
                    'details' => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_super_admin', [
                        'record'         => $apiInsertSingleRecord['full_name'] . ' (id ' . $records->id . ')',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => $this->tableNameNewsletterSubscriber
                    ])
                ]);
                return response()->json($apiInsertSingleRecord);
            }
            else
            {
                // The email provider and the domain does not exist in the accepted domain list
                $completeEmailProvider = substr(strstr($request->get('email'), '@'), 1);
                escapeshellcmd(exec('ping ' . escapeshellarg($completeEmailProvider), $output, $value));
                if ($value === 1) 
                {
                    return response([], 406);
                }
            }
        }
        catch  (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                return response([], 500);
            }
            if ($mysqlError->getCode() === '42S22') 
            {
                return response([], 500);
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
                $this->modelNameNewsletterSubscriber->find($findUserIdByEmailAddress)->log()->create([ 
                    'status'  => 'User unsubscribed from newsletter',
                    'details' => __('error_and_notification_system.delete.info_00002_notify.user_has_rights.message_super_admin', [
                        'record'         => $email . ' (id ' . $findUserIdByEmailAddress . ')',
                        'databaseName'   => config('database.connections.mysql.database'),
                        'tableName'      => $this->tableNameNewsletterSubscriber
                    ])
                ]);
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
