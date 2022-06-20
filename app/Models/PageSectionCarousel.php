<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Log;

class PageSectionCarousel extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'page_section_carousel';

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
     * The foreign key associated with the table.
     * 
     * @var string
     */
    protected $foreignKey = 'page_section_id';
    
    /**
     * The data type of the database table foreign key.
     *
     * @var string
     */
    protected $foreignKeyType = 'int';

    /**
     * The attributes that are mass assignable.
     * 
     * @var string
     */
    protected $fillable = [
        'page_section_id',
        'image_path',
        'caption_text_1',
        'caption_text_2',
        'caption_text_3',
        'caption_text_4',
        'button_label',
        'link_to_blog_article',
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
    public function page_sections()
    {
        return $this->belongsTo('App\Models\PageSection');
    }

    /**
     * Eloquent polymorphic relationship between page_section_carousel and logs.
     *
     */
    public function log()
    {
        return $this->morphOne(Log::class, 'logable');
    }
}