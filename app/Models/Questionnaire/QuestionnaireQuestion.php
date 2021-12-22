<?php

namespace App\Models\Questionnaire;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionnaireQuestion extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'questionnaire_questions';

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
        'question_type_id',
        'name',
        'answer_suggestion',
        'questionnaire_media_type_id',
        'media_card_url',
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
        return $this->belongsTo('App\Models\Questionnaire\Questionnaire');
    }

    /**
     * Eloquent relationship between questionnaire_questions and questionnaire_media_type.
     * Many questionnaire questions may have only one questionnaire media type.
     *
     */
    public function questionnaire_media_type()
    {
        return $this->belongsTo('App\Models\Questionnaire\QuestionnaireMediaType');
    }

    /**
     * Eloquent relationship between questionnaire_questions and questionnaire_answers.
     * One questionnaire question may have one or more questionnaire answers.
     *
     */
    public function questionnaire_answers()
    {
        return $this->hasMany('App\Models\Questionnaire\QuestionnaireAnswer');
    }
}
