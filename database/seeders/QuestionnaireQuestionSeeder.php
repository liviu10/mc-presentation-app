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
                'id'                => '1',
                'questionnaire_id'  => '1',
                'question_type_id'  => '1',
                'name'              => 'Ce te face pe tine fericit/fericită?*',
                'media_card_url'    => '/images/questionnaire/question1.jpg',
                'answer_suggestion' => 'Spune-mi sincer. Sunt curioasă. Pe mine mă face fericită iubirea oamenilor.',
            ],
            [
                'id'                => '2',
                'questionnaire_id'  => '1',
                'question_type_id'  => '1',
                'name'              => 'Ce tip de muzică asculți când ești fericit/fericită?*',
                'media_card_url'    => '/images/questionnaire/question2.jpg',
                'answer_suggestion' => 'Eu ascult muzică tot timpul și muzica mea de energizare este cea latino. Tu ce asculți?',
            ],
            [
                'id'                => '3',
                'questionnaire_id'  => '1',
                'question_type_id'  => '1',
                'name'              => 'Ce tip de muzică asculți când ai o zi proastă?*',
                'media_card_url'    => '/images/questionnaire/question3.jpg',
                'answer_suggestion' => 'Muzica de calitate și cea preferată te ajută să te binedispui. Eu ascult muzică mai ales când sunt supărată pentru a mă calma. Tu ce asculți în asemenea momente?',
            ],
            [
                'id'                => '4',
                'questionnaire_id'  => '1',
                'question_type_id'  => '1',
                'name'              => 'Ce gen de muzică te binedispune sau îți dă un vibe bun?*',
                'media_card_url'    => 'https://www.youtube.com/watch?v=0B_TDuvTduY',
                'answer_suggestion' => 'Mie îmi place rock and roll-ul foarte mult și îl ascult pentru energizare. Tu ce gen de muzică asculți?',
            ],
            [
                'id'                => '5',
                'questionnaire_id'  => '1',
                'question_type_id'  => '6',
                'name'              => 'Care este melodia ta preferată/ formația ta preferată sau interpretul tău preferat?*',
                'media_card_url'    => 'https://www.youtube.com/watch?v=q99yGrZivjA',
                'answer_suggestion' => 'Mie îmi plac multe melodii și ascult pe stare. Tu ai un stil preferat? Sunt curioasă de alegerea ta. Îmi poți scrie doar numele artistului/ artistei sau melodia și artistul/ artista care o cântă.',
            ],
            [
                'id'                => '6',
                'questionnaire_id'  => '1',
                'question_type_id'  => '6',
                'name'              => 'De ce îți place această melodie/ formație sau acest interpret?*',
                'media_card_url'    => '/images/questionnaire/question6.jpg',
                'answer_suggestion' => 'Scrie primul gând care îți vine în minte',
            ],
        ];
        QuestionnaireQuestion::insert($records);
    }
}
