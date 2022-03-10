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

        $newsletterSubscriberHistory = DB::table('newsletter_logs')->insert([
            'newsletter_campaign_id' => $newsletterSubscriberInfo[0]['newsletter_subscribers'][0]['newsletter_campaign_id'],
            'full_name' => $newsletterSubscriberInfo[0]['newsletter_subscribers'][0]['full_name'],
            'email' => $newsletterSubscriberInfo[0]['newsletter_subscribers'][0]['email'],
            'status' => 'trimis',
        ]);

        return $newsletterSubscriberHistory;
    }
}
