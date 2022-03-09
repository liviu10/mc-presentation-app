<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeNewsletter extends Mailable
{
    use Queueable, SerializesModels;

    public $welcomeToNewsletterData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($welcomeToNewsletterData)
    {
        $this->welcomeToNewsletterData = $welcomeToNewsletterData;
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
        $mailSubject = 'Welcome to newsletter!';

        return $this->view('emails.welcomeNewsletter')
                    ->from($mailFromAddress, $mailFromName)
                    ->cc($mailFromAddress, $mailFromName)
                    ->bcc($mailFromAddress, $mailFromName)
                    ->replyTo($mailFromAddress, $mailFromName)
                    ->subject($mailSubject)
                    ->with('full_name', $this->welcomeToNewsletterData['full_name']);
    }
}
