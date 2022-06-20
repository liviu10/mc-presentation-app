<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Log;

class PageSection extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'page_sections';

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
        'section_name',
        'section_slug',
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
     * Eloquent relationship between page_sections and page_section_carousel.
     * One page section may have one or more page section content.
     *
     */
    public function page_section_carousel()
    {
        return $this->hasMany('App\Models\PageSectionCarousel');
    }

    /**
     * Eloquent relationship between page_sections and page_section_jumbotron.
     * One page section may have one or more page section content.
     *
     */
    public function page_section_jumbotron()
    {
        return $this->hasMany('App\Models\PageSectionJumbotron');
    }

    /**
     * Eloquent relationship between page_sections and page_section_testimonials.
     * One page section may have one or more page section content.
     *
     */
    public function page_section_testimonials()
    {
        return $this->hasMany('App\Models\PageSectionTestimonial');
    }

    /**
     * Eloquent relationship between page_sections and page_section_footer.
     * One page section may have one or more page section content.
     *
     */
    public function page_section_footer()
    {
        return $this->hasMany('App\Models\PageSectionFooter');
    }

    /**
     * Eloquent polymorphic relationship between page_sections and logs.
     *
     */
    public function log()
    {
        return $this->morphOne(Log::class, 'logable');
    }
}