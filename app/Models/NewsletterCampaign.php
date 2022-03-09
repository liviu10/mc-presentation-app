<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsletterCampaign extends Model
{
    use HasFactory;

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
}
