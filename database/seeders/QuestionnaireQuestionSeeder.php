<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuestionnaireQuestion;

class QuestionnaireQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuestionnaireQuestion::truncate();
        $records = [
            [
                'id'                              => '1',
                'questionnaire_id'                => '1',
                'question_type_id'                => '1',
                'question_name'                   => 'Ce te face pe tine fericit/fericită?*',
                'question_media_card_url'         => '/images/questionnaire/question1.jpg',
                'question_answer_suggestion'      => 'Spune-mi sincer. Sunt curioasă. Pe mine mă face fericită iubirea oamenilor.',
                'questionnaire_question_is_active'=> '1',
            ],
            [
                'id'                              => '2',
                'questionnaire_id'                => '1',
                'question_type_id'                => '1',
                'question_name'                   => 'Ce tip de muzică asculți când ești fericit/fericită?*',
                'question_media_card_url'         => '/images/questionnaire/question2.jpg',
                'question_answer_suggestion'      => 'Eu ascult muzică tot timpul și muzica mea de energizare este cea latino. Tu ce asculți?',
                'questionnaire_question_is_active'=> '1',
            ],
            [
                'id'                              => '3',
                'questionnaire_id'                => '1',
                'question_type_id'                => '1',
                'question_name'                   => 'Ce tip de muzică asculți când ai o zi proastă?*',
                'question_media_card_url'         => '/images/questionnaire/question3.jpg',
                'question_answer_suggestion'      => 'Muzica de calitate și cea preferată te ajută să te binedispui. Eu ascult muzică mai ales când sunt supărată pentru a mă calma. Tu ce asculți în asemenea momente?',
                'questionnaire_question_is_active'=> '1',
            ],
            [
                'id'                              => '4',
                'questionnaire_id'                => '1',
                'question_type_id'                => '1',
                'question_name'                   => 'Ce gen de muzică te binedispune sau îți dă un vibe bun?*',
                'question_media_card_url'         => 'https://www.youtube.com/watch?v=0B_TDuvTduY',
                'question_answer_suggestion'      => 'Mie îmi place rock and roll-ul foarte mult și îl ascult pentru energizare. Tu ce gen de muzică asculți?',
                'questionnaire_question_is_active'=> '1',
            ],
            [
                'id'                              => '5',
                'questionnaire_id'                => '1',
                'question_type_id'                => '6',
                'question_name'                   => 'Care este melodia ta preferată/ formația ta preferată sau interpretul tău preferat?*',
                'question_media_card_url'         => 'https://www.youtube.com/watch?v=q99yGrZivjA',
                'question_answer_suggestion'      => 'Mie îmi plac multe melodii și ascult pe stare. Tu ai un stil preferat? Sunt curioasă de alegerea ta. Îmi poți scrie doar numele artistului/ artistei sau melodia și artistul/ artista care o cântă.',
                'questionnaire_question_is_active'=> '1',
            ],
            [
                'id'                              => '6',
                'questionnaire_id'                => '1',
                'question_type_id'                => '6',
                'question_name'                   => 'De ce îți place această melodie/ formație sau acest interpret?*',
                'question_media_card_url'         => '/images/questionnaire/question6.jpg',
                'question_answer_suggestion'      => 'Scrie primul gând care îți vine în minte',
                'questionnaire_question_is_active'=> '1',
            ],
        ];
        QuestionnaireQuestion::insert($records);
    }
}
