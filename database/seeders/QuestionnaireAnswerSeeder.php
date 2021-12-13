<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuestionnaireAnswer;

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
                'questionnaire_question_id' => '1',
                'answer_1'                   => 'Familia mea',
                'answer_2'                   => 'Pasiunile mele',
                'answer_3'                   => 'Banii',
                'answer_4'                   => 'Altceva',
                'answer_5'                   => '',
                'answer_6'                   => '',
                'answer_7'                   => '',
                'answer_8'                   => '',
                'answer_9'                   => '',
                'answer_10'                  => '',
            ],
            [
                'questionnaire_question_id' => '2',
                'answer_1'                   => 'Ceva care să îmi ofere și mai multă energie',
                'answer_2'                   => 'Ceva liniștitor',
                'answer_3'                   => 'Melodii pe care pot dansa',
                'answer_4'                   => 'Nu ascult muzică',
                'answer_5'                   => '',
                'answer_6'                   => '',
                'answer_7'                   => '',
                'answer_8'                   => '',
                'answer_9'                   => '',
                'answer_10'                  => '',
            ],
            [
                'questionnaire_question_id' => '3',
                'answer_1'                   => 'Ceva care să mă binedispună',
                'answer_2'                   => 'Ceva care să îmi dea energie',
                'answer_3'                   => 'Ceva care să mă liniștească',
                'answer_4'                   => 'Altele / Nu ascult muzică (te rog să scrii)',
                'answer_5'                   => '',
                'answer_6'                   => '',
                'answer_7'                   => '',
                'answer_8'                   => '',
                'answer_9'                   => '',
                'answer_10'                  => '',
            ],
            [
                'questionnaire_question_id' => '4',
                'answer_1'                   => 'Rock soft sau hard rock',
                'answer_2'                   => 'Country / Pop',
                'answer_3'                   => 'Hip hop / Dance',
                'answer_4'                   => 'Clasică / Blues / Jazz / Folk',
                'answer_5'                   => 'Altele / Nu ascult muzică (te rog să scrii)',
                'answer_6'                   => '',
                'answer_7'                   => '',
                'answer_8'                   => '',
                'answer_9'                   => '',
                'answer_10'                  => '',
            ],
            [
                'questionnaire_question_id' => '5',
                'answer_1'                   => 'Introduceți unul sau câteva cuvinte...',
                'answer_2'                   => '',
                'answer_3'                   => '',
                'answer_4'                   => '',
                'answer_5'                   => '',
                'answer_6'                   => '',
                'answer_7'                   => '',
                'answer_8'                   => '',
                'answer_9'                   => '',
                'answer_10'                  => '',
            ],
            [
                'questionnaire_question_id' => '6',
                'answer_1'                   => 'Introduceți unul sau câteva cuvinte...',
                'answer_2'                   => '',
                'answer_3'                   => '',
                'answer_4'                   => '',
                'answer_5'                   => '',
                'answer_6'                   => '',
                'answer_7'                   => '',
                'answer_8'                   => '',
                'answer_9'                   => '',
                'answer_10'                  => '',
            ],
        ];
        QuestionnaireAnswer::insert($records);
    }
}
