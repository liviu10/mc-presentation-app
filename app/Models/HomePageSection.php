<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomePageSection extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'home_page_sections';

    /**
     * The primary key associated with the table.
     * 
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The foreign key associated with the table.
     * 
     * @var string
     */
    protected $foreignKey = 'home_page_id';
    
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
        'home_page_id',
        'section_name',
        'section_description',
        'section_slug_name',
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

    /**
     * Eloquent relationship between home_page_sections and home_page_section_contents.
     * One home page section may have one or more home page section contents.
     */
    public function home_page_section_contents()
    {
        return $this->hasMany('App\Models\HomePageSectionContent');
    }

    /**
     * Eloquent relationship between home_page_sections and home_page.
     * One or many home page section(s) may have only one home page.
     */
    public function home_page()
    {
        return $this->belongsTo('App\Models\HomePage');
    }
}