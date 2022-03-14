<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Events\SendNewsletter;

class SendNewsletterCampaign extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $newsletterSubscriberData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($newsletterSubscriberData)
    {
        $this->newsletterSubscriberData = $newsletterSubscriberData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mailFromAddress = config('mail.from.address');
        $mailFromName = config('mail.from.name');
        $mailSubject = $this->newsletterSubscriberData[0]['campaign_name'];

        $newsletterSubscriber = $this->newsletterSubscriberData;

        // TODO: catch email errors and possible to retry sending the email for 3 times before doing ping and save it to logs
        event(new SendNewsletter($newsletterSubscriber));

        return $this->view('emails.sendNewsletterCampaign')
                    ->from($mailFromAddress, $mailFromName)
                    ->cc($mailFromAddress, $mailFromName)
                    ->bcc($mailFromAddress, $mailFromName)
                    ->replyTo($mailFromAddress, $mailFromName)
                    ->subject($mailSubject)
                    ->with('campaign_name', $this->newsletterSubscriberData[0]['campaign_name']);
    }
}
