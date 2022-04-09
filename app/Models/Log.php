<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'logs';

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
        'status',
        'details',
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
     * Eloquent polymorphic relationship between newsletter_campaign and newsletter_logs.
     *
     */
    public function logable()
    {
        return $this->morphTo();
    }
}
