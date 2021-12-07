<?php

namespace App\Models;

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
     * @var array
     */
    protected $foreignKey = [
        'questionnaire_id',
        'question_type_id',
    ];

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
        'question_name',
        'question_media_card_url',
        'question_answer_suggestion',
        'questionnaire_question_is_active',
    ];

    /**
     * The attributes that are mass assignable.
     * 
     * @var string
     */
    protected $attributes = [
        'questionnaire_question_is_active' => false,
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

    /**
     * Eloquent relationship between questionnaire_questions and questionnaire_question_types.
     * Many questionnaire questions may have only one questionnaire question type.
     *
     */
    public function questionnaire_question_type()
    {
        return $this->belongsTo('App\Models\QuestionnaireQuestionType');
    }
}
