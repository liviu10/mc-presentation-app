<?php

namespace App\Models\Questionnaire;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionnaireAnswer extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'questionnaire_answers';

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
    protected $foreignKey = 'questionnaire_question_id';

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
        'id',
        'questionnaire_question_id',
        'answer_1',
        'answer_2',
        'answer_3',
        'answer_4',
        'answer_5',
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
     * Eloquent relationship between questionnaire_answers and questionnaire_questions.
     * Many questionnaire answers may have only one questionnaire question.
     *
     */
    public function questionnaire_question()
    {
        return $this->belongsTo('App\Models\Questionnaire\QuestionnaireQuestion');
    }

    /**
     * Eloquent relationship between questionnaire_answers and questionnaire_responses.
     * One questionnaire answer may have one or many questionnaire response.
     *
     */
    public function questionnaire_responses()
    {
        return $this->hasMany('App\Models\Questionnaire\QuestionnaireResponse');
    }
}
