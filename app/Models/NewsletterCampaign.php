<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Log;

class NewsletterCampaign extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'newsletter_campaigns';

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
        'campaign_name',
        'campaign_description',
        'campaign_is_active',
        'valid_from',
        'valid_to',
        'occur_times',
        'occur_when',
        'occur_day',
        'occur_hour',
    ];

    /**
     * The attributes that are mass assignable.
     * 
     * @var string
     */
    protected $attributes = [
        'campaign_is_active' => false,
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
        'deleted_at',
    ];


    public function scopeIsActive ($query) 
    {
        return $query->where('campaign_is_active', true);
    }

    public function scopeIsNotActive ($query) 
    {
        return $query->where('campaign_is_active', false);
    }

    /**
     * Eloquent relationship between newsletter_campaign and newsletter_subscribers.
     * One newsletter campaign may have one or more newsletter subscriber(s).
     *
     */
    public function newsletter_subscribers()
    {
        return $this->hasMany('App\Models\NewsletterSubscriber');
    }

    /**
     * Eloquent relationship between newsletter_campaign and newsletter_logs.
     * One newsletter campaign may have one or more newsletter log(s).
     *
     */
    public function newsletter_logs()
    {
        return $this->hasMany('App\Models\NewsletterLogs');
    }

    /**
     * Eloquent polymorphic relationship between newsletter_campaign and logs.
     *
     */
    public function log()
    {
        return $this->morphOne(Log::class, 'logable');
    }
}
