<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Questionnaire\QuestionnaireAnswer;

class QuestionnaireAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuestionnaireAnswer::truncate();
        $records = [
            [
                'questionnaire_question_id'  => '1',
                'answer_1'                   => 'Varianta 1',
                'answer_2'                   => 'Varianta 2',
                'answer_3'                   => 'Varianta 3',
                'answer_4'                   => 'Varianta 4',
                'answer_5'                   => 'Altceva',
            ],
            [
                'questionnaire_question_id'  => '2',
                'answer_1'                   => 'Varianta 1',
                'answer_2'                   => 'Varianta 2',
                'answer_3'                   => 'Varianta 3',
                'answer_4'                   => 'Varianta 4',
                'answer_5'                   => 'Altceva',
            ],
            [
                'questionnaire_question_id'  => '3',
                'answer_1'                   => 'Varianta 1',
                'answer_2'                   => 'Varianta 2',
                'answer_3'                   => 'Varianta 3',
                'answer_4'                   => 'Varianta 4',
                'answer_5'                   => 'Altceva',
            ],
            [
                'questionnaire_question_id'  => '4',
                'answer_1'                   => 'Varianta 1',
                'answer_2'                   => 'Varianta 2',
                'answer_3'                   => 'Varianta 3',
                'answer_4'                   => 'Varianta 4',
                'answer_5'                   => 'Altceva',
            ],
            [
                'questionnaire_question_id'  => '5',
                'answer_1'                   => '',
                'answer_2'                   => '',
                'answer_3'                   => '',
                'answer_4'                   => '',
                'answer_5'                   => 'Introduceți unul sau câteva cuvinte...',
            ],
            [
                'questionnaire_question_id'  => '6',
                'answer_1'                   => '',
                'answer_2'                   => '',
                'answer_3'                   => '',
                'answer_4'                   => '',
                'answer_5'                   => 'Introduceți unul sau câteva cuvinte...',
            ],
            [
                'questionnaire_question_id'  => '7',
                'answer_1'                   => 'Varianta 1',
                'answer_2'                   => 'Varianta 2',
                'answer_3'                   => 'Varianta 3',
                'answer_4'                   => 'Varianta 4',
                'answer_5'                   => 'Altceva',
            ],
            [
                'questionnaire_question_id'  => '8',
                'answer_1'                   => 'Varianta 1',
                'answer_2'                   => 'Varianta 2',
                'answer_3'                   => 'Varianta 3',
                'answer_4'                   => 'Varianta 4',
                'answer_5'                   => 'Altceva',
            ],
            [
                'questionnaire_question_id'  => '9',
                'answer_1'                   => 'Varianta 1',
                'answer_2'                   => 'Varianta 2',
                'answer_3'                   => 'Varianta 3',
                'answer_4'                   => 'Varianta 4',
                'answer_5'                   => 'Altceva',
            ],
            [
                'questionnaire_question_id'  => '10',
                'answer_1'                   => 'Varianta 1',
                'answer_2'                   => 'Varianta 2',
                'answer_3'                   => 'Varianta 3',
                'answer_4'                   => 'Varianta 4',
                'answer_5'                   => 'Altceva',
            ],
            [
                'questionnaire_question_id'  => '11',
                'answer_1'                   => 'Varianta 1',
                'answer_2'                   => 'Varianta 2',
                'answer_3'                   => 'Varianta 3',
                'answer_4'                   => 'Varianta 4',
                'answer_5'                   => 'Altceva',
            ],
            [
                'questionnaire_question_id'  => '12',
                'answer_1'                   => 'Varianta 1',
                'answer_2'                   => 'Varianta 2',
                'answer_3'                   => 'Varianta 3',
                'answer_4'                   => 'Varianta 4',
                'answer_5'                   => 'Altceva',
            ],
            [
                'questionnaire_question_id'  => '13',
                'answer_1'                   => 'Varianta 1',
                'answer_2'                   => 'Varianta 2',
                'answer_3'                   => 'Varianta 3',
                'answer_4'                   => 'Varianta 4',
                'answer_5'                   => 'Altceva',
            ],
            [
                'questionnaire_question_id'  => '14',
                'answer_1'                   => 'Varianta 1',
                'answer_2'                   => 'Varianta 2',
                'answer_3'                   => 'Varianta 3',
                'answer_4'                   => 'Varianta 4',
                'answer_5'                   => 'Altceva',
            ],
            [
                'questionnaire_question_id'  => '15',
                'answer_1'                   => '',
                'answer_2'                   => '',
                'answer_3'                   => '',
                'answer_4'                   => '',
                'answer_5'                   => 'Introduceți unul sau câteva cuvinte...',
            ],
            [
                'questionnaire_question_id'  => '16',
                'answer_1'                   => 'Scara de masurare',
                'answer_2'                   => '',
                'answer_3'                   => '',
                'answer_4'                   => '',
                'answer_5'                   => '',
            ],
            [
                'questionnaire_question_id'  => '17',
                'answer_1'                   => '',
                'answer_2'                   => '',
                'answer_3'                   => '',
                'answer_4'                   => '',
                'answer_5'                   => 'Introduceți unul sau câteva cuvinte...',
            ],
            [
                'questionnaire_question_id'  => '18',
                'answer_1'                   => '',
                'answer_2'                   => '',
                'answer_3'                   => '',
                'answer_4'                   => '',
                'answer_5'                   => 'Introduceți unul sau câteva cuvinte...',
            ],
            [
                'questionnaire_question_id'  => '19',
                'answer_1'                   => '',
                'answer_2'                   => '',
                'answer_3'                   => '',
                'answer_4'                   => '',
                'answer_5'                   => 'Introduceți unul sau câteva cuvinte...',
            ],
            [
                'questionnaire_question_id'  => '20',
                'answer_1'                   => '',
                'answer_2'                   => '',
                'answer_3'                   => '',
                'answer_4'                   => '',
                'answer_5'                   => 'Introduceți unul sau câteva cuvinte...',
            ],
        ];
        QuestionnaireAnswer::insert($records);
    }
}
