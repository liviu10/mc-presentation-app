<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Log;

class NewsletterSubscriber extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'newsletter_subscribers';

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
        'full_name',
        'email',
        'privacy_policy',
        'valid_email',
    ];

    /**
     * The attributes that are mass assignable.
     * 
     * @var string
     */
    protected $attributes = [
        'privacy_policy' => false,
        'valid_email' => false,
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

    public function scopeIsValidEmail ($query) 
    {
        return $query->where('valid_email', true);
    }

    public function scopeIsNotValidEmail ($query) 
    {
        return $query->where('valid_email', false);
    }

    /**
     * Eloquent relationship between newsletter_subscribers and newsletter_campaign.
     * One or many newsletter subscriber(s) may have only one newsletter campaign.
     */
    public function newsletter_campaign()
    {
        return $this->belongsTo('App\Models\NewsletterCampaign');
    }

    /**
     * Eloquent relationship between newsletter_subscribers and newsletter_logs.
     * One newsletter subscribers may have one or more newsletter log(s).
     *
     */
    public function newsletter_logs()
    {
        return $this->hasMany('App\Models\NewsletterLogs');
    }

    /**
     * Eloquent polymorphic relationship between newsletter_subscribers and newsletter_logs.
     *
     */
    public function log()
    {
        return $this->morphOne(Log::class, 'logable');
    }
}
