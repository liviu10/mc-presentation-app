<?php

namespace App\Listeners;

use App\Events\SendNewsletter;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use App\Console\Commands;

class SendNewsletterHistory
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        // 
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SendNewsletter  $event
     * @return void
     */
    public function handle(SendNewsletter $event)
    {
        $newsletterSubscriberInfo = $event->newsletterSubscriber;

        foreach ($newsletterSubscriberInfo[0]['newsletter_subscribers'] as $subscriberLog)
        {
            // The email provider and the domain does not exist in the accepted domain list
            $completeEmailProvider = substr(strstr($subscriberLog['email'], '@'), 1);
            escapeshellcmd(exec('ping ' . escapeshellarg($completeEmailProvider), $output, $value));
            if ($value === 1) 
            {
                $newsletterSubscriberHistory = DB::table('newsletter_logs')->insert([
                    'newsletter_campaign_id' => $subscriberLog['newsletter_campaign_id'],
                    'newsletter_subscriber_id' => $subscriberLog['id'],
                    'subscriber_full_name' => $subscriberLog['full_name'],
                    'subscriber_email_address' => $subscriberLog['email'],
                    'email_status' => 'Error: Retry 1',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
            else
            {
                $newsletterSubscriberHistory = DB::table('newsletter_logs')->insert([
                    'newsletter_campaign_id' => $subscriberLog['newsletter_campaign_id'],
                    'newsletter_subscriber_id' => $subscriberLog['id'],
                    'subscriber_full_name' => $subscriberLog['full_name'],
                    'subscriber_email_address' => $subscriberLog['email'],
                    'email_status' => 'Success: Sent',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }
        return $newsletterSubscriberHistory;
    }
}
