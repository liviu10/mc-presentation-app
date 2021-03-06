<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Log;

class BlogCategory extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'blog_categories';

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
        'blog_category_title',
        'blog_category_short_description',
        'blog_category_is_active',
        'blog_image_card_url',
        'blog_category_path',
    ];

    /**
     * The attributes that are mass assignable.
     * 
     * @var string
     */
    protected $attributes = [
        'blog_category_is_active' => false,
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
        return $query->where('blog_category_is_active', true);
    }

    public function scopeIsNotActive ($query) 
    {
        return $query->where('blog_category_is_active', false);
    }

    /**
     * Eloquent relationship between blog_categories and blog_subcategories.
     * One blog category may have one or more blog subcategories.
     *
     */
    public function blog_subcategories()
    {
        return $this->hasMany('App\Models\BlogSubcategory');
    }

    /**
     * Eloquent polymorphic relationship between blog_categories and logs.
     *
     */
    public function log()
    {
        return $this->morphOne(Log::class, 'logable');
    }
}