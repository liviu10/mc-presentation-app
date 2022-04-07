<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsletterLog extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'newsletter_logs';

    /**
     * The primary key associated with the table.
     * 
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * The attributes that are mass assignable.
     * 
     * @var string
     */
    protected $fillable = [
        'newsletter_campaign_id',
        'newsletter_subscriber_id',
        'email_status',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    /**
     * Eloquent relationship between newsletter_logs and newsletter_campaign.
     * One or many newsletter log(s) may have only one newsletter campaign.
     */
    public function newsletter_campaign()
    {
        return $this->belongsTo('App\Models\NewsletterCampaign');
    }

    /**
     * Eloquent relationship between newsletter_logs and newsletter_subscribers.
     * One or many newsletter log(s) may have only one newsletter subscribers.
     */
    public function newsletter_subscriber()
    {
        return $this->belongsTo('App\Models\NewsletterSubscriber');
    }
}
