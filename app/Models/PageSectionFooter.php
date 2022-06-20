<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Log;

class PageSectionFooter extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'page_section_footer';

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
        'label_for_menu_1',
        'link_for_menu_1',
        'label_for_menu_2',
        'link_for_menu_2',
        'contact_email_address',
        'label_for_social_media',
        'label_for_social_media_1',
        'link_to_social_media_1',
        'label_for_social_media_2',
        'link_to_social_media_2',
        'copyright_caption',
        'copyright_caption_url',
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
     * Eloquent relationship between page_sections and page_section_footer.
     * One page section may have one or more page section content.
     *
     */
    public function page_sections()
    {
        return $this->belongsTo('App\Models\PageSection');
    }

    /**
     * Eloquent polymorphic relationship between page_section_footer and logs.
     *
     */
    public function log()
    {
        return $this->morphOne(Log::class, 'logable');
    }
}