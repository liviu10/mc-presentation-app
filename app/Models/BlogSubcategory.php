<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Log;

class BlogSubcategory extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'blog_subcategories';

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
    protected $foreignKey = 'blog_category_id';
    
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
        'blog_category_id',
        'blog_subcategory_title',
        'blog_subcategory_short_description',
        'blog_subcategory_is_active',
        'blog_subcategory_path',
    ];

    /**
     * The attributes that are mass assignable.
     * 
     * @var string
     */
    protected $attributes = [
        'blog_subcategory_is_active' => false,
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
        return $query->where('blog_subcategory_is_active', true);
    }

    public function scopeIsNotActive ($query) 
    {
        return $query->where('blog_subcategory_is_active', false);
    }

    public function scopeIsWrittenArticle ($query) 
    {
        return $query->where('blog_category_id', '=', 1);
    }

    public function scopeIsAudioArticle ($query) 
    {
        return $query->where('blog_category_id', '=', 2);
    }

    public function scopeIsVideoArticle ($query) 
    {
        return $query->where('blog_category_id', '=', 3);
    }

    /**
     * Eloquent relationship between blog_subcategories and blog_articles.
     * One blog subcategory may have one or more blog articles.
     */
    public function blog_articles()
    {
        return $this->hasMany('App\Models\BlogArticle');
    }

    /**
     * Eloquent relationship between blog_subcategories and blog_categories.
     * One or many blog subcategory(ies) may have only one blog category.
     */
    public function blog_category()
    {
        return $this->belongsTo('App\Models\BlogCategory');
    }

    /**
     * Eloquent polymorphic relationship between blog_subcategories and logs.
     *
     */
    public function log()
    {
        return $this->morphOne(Log::class, 'logable');
    }
}