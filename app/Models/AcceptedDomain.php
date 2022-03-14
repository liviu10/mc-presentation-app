<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcceptedDomain extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'accepted_domains';

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
        'domain',
        'type',
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

    public function scopeCountryCode ($query) 
    {
        return $query->where('country-code', true);
    }

    public function scopeGeneric ($query) 
    {
        return $query->where('generic', true);
    }

    public function scopeGenericRestricted ($query) 
    {
        return $query->where('generic-restricted', true);
    }

    public function scopeInfrastructure ($query) 
    {
        return $query->where('infrastructure', true);
    }

    public function scopeSponsored ($query) 
    {
        return $query->where('sponsored', true);
    }
}
