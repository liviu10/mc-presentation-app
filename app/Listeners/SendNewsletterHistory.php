<?php

namespace App\Listeners;

use App\Events\SendNewsletter;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

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
            $newsletterSubscriberHistory = DB::table('newsletter_logs')->insert([
                'newsletter_campaign_id' => $subscriberLog['newsletter_campaign_id'],
                'full_name' => $subscriberLog['full_name'],
                'email' => $subscriberLog['email'],
                'status' => 'trimis',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
        return $newsletterSubscriberHistory;
    }
}
