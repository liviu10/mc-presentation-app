<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendNewsletterCampaign;
use App\Models\NewsletterCampaign;

class SendNewsletter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will be executed on a certain day, every week and will automatically send an email newsletter to all subscribers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->modelNameNewsletterCampaign = new NewsletterCampaign();
        $activeCampaignSubscribers = $this->modelNameNewsletterCampaign
                                    ->select('id', 'campaign_name', 'valid_from', 'valid_to')
                                    ->isActive()
                                    ->where('id', '<>', 1)
                                    ->with('newsletter_subscribers')
                                    ->get()
                                    ->toArray();

        // Get all the email addresses
        $emailAddresses = [];
        foreach ($activeCampaignSubscribers[0]['newsletter_subscribers'] as $newsletterRecipient) 
        {
            $emailAddresses[$newsletterRecipient['id']] = $newsletterRecipient['email'];
        }

        // Send the email newsletter to all the subscribers of the currently active campaign
        foreach ($emailAddresses as $emailAddress) 
        {
            $sendNewsletterEmail = new SendNewsletterCampaign($activeCampaignSubscribers);
        }

        Mail::to($emailAddress)->send($sendNewsletterEmail);

        return Command::SUCCESS;
    }
}
