<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionnaireContact extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'questionnaire_contact';

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
     * @var int
     */
    protected $foreignKey = 'questionnaire_id';

    /**
     * The data type of the foreign key.
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
        'questionnaire_id',
        'full_name',
        'email',
        'telephone_number',
        'privacy_policy',
    ];

    /**
     * The attributes that are mass assignable.
     * 
     * @var string
     */
    protected $attributes = [
        'privacy_policy' => false,
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
     * Eloquent relationship between questionnaire_questions and questionnaires.
     * Many questionnaire questions may have only one questionnaire.
     *
     */
    public function questionnaire()
    {
        return $this->belongsTo('App\Models\Questionnaire');
    }
}
