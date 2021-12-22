<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Questionnaire\QuestionnaireQuestion;

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
                'id'                          => '1',
                'questionnaire_id'            => '1',
                'question_type_id'            => '1',
                'name'                        => 'Ce te face pe tine fericit/fericită?*',
                'answer_suggestion'           => 'Spune-mi sincer. Sunt curioasă. Pe mine mă face fericită iubirea oamenilor.',
                'questionnaire_media_type_id' => '2',
                'media_card_url'              => '/images/questionnaire/question1.jpg',
            ],
            // [
            //     'id'                          => '2',
            //     'questionnaire_id'            => '1',
            //     'question_type_id'            => '1',
            //     'name'                        => 'Ce tip de muzică asculți când ești fericit/fericită?*',
            //     'answer_suggestion'           => 'Eu ascult muzică tot timpul și muzica mea de energizare este cea latino. Tu ce asculți?',
            //     'questionnaire_media_type_id' => '2',
            //     'media_card_url'              => '/images/questionnaire/question2.jpg',
            // ],
            // [
            //     'id'                          => '3',
            //     'questionnaire_id'            => '1',
            //     'question_type_id'            => '1',
            //     'name'                        => 'Ce tip de muzică asculți când ai o zi proastă?*',
            //     'answer_suggestion'           => 'Muzica de calitate și cea preferată te ajută să te binedispui. Eu ascult muzică mai ales când sunt supărată pentru a mă calma. Tu ce asculți în asemenea momente?',
            //     'questionnaire_media_type_id' => '2',
            //     'media_card_url'              => '/images/questionnaire/question3.jpg',
            // ],
            // [
            //     'id'                          => '4',
            //     'questionnaire_id'            => '1',
            //     'question_type_id'            => '1',
            //     'name'                        => 'Ce gen de muzică te binedispune sau îți dă un vibe bun?*',
            //     'answer_suggestion'           => 'Mie îmi place rock and roll-ul foarte mult și îl ascult pentru energizare. Tu ce gen de muzică asculți?',
            //     'questionnaire_media_type_id' => '3',
            //     'media_card_url'              => 'https://www.youtube.com/embed/0B_TDuvTduY',
            // ],
            // [
            //     'id'                          => '5',
            //     'questionnaire_id'            => '1',
            //     'question_type_id'            => '6',
            //     'name'                        => 'Care este melodia ta preferată/ formația ta preferată sau interpretul tău preferat?*',
            //     'answer_suggestion'           => 'Mie îmi plac multe melodii și ascult pe stare. Tu ai un stil preferat? Sunt curioasă de alegerea ta. Îmi poți scrie doar numele artistului/ artistei sau melodia și artistul/ artista care o cântă.',
            //     'questionnaire_media_type_id' => '3',
            //     'media_card_url'              => 'https://www.youtube.com/embed/q99yGrZivjA',
            // ],
            // [
            //     'id'                          => '6',
            //     'questionnaire_id'            => '1',
            //     'question_type_id'            => '6',
            //     'name'                        => 'De ce îți place această melodie/ formație sau acest interpret?*',
            //     'answer_suggestion'           => 'Scrie primul gând care îți vine în minte',
            //     'questionnaire_media_type_id' => '2',
            //     'media_card_url'              => '/images/questionnaire/question6.jpg',
            // ],
            // [
            //     'id'                          => '7',
            //     'questionnaire_id'            => '1',
            //     'question_type_id'            => '1',
            //     'name'                        => 'Ce stare ai în ultima perioadă? Cum te simți?*',
            //     'answer_suggestion'           => 'Eu mă simt obosită în ultimul timp. Tu cum te simți? Spune sincer.',
            //     'questionnaire_media_type_id' => '2',
            //     'media_card_url'              => '/images/questionnaire/question7.jpg',
            // ],
            // [
            //     'id'                          => '8',
            //     'questionnaire_id'            => '1',
            //     'question_type_id'            => '1',
            //     'name'                        => 'Este ceva ce te nemulțumește în ultimul timp?*',
            //     'answer_suggestion'           => 'Este ceva care nu își dă pace și nu știi cum să scapi de acest lucru? Spune-mi sincer ce este.',
            //     'questionnaire_media_type_id' => '2',
            //     'media_card_url'              => '/images/questionnaire/question8.jpg',
            // ],
            // [
            //     'id'                          => '9',
            //     'questionnaire_id'            => '1',
            //     'question_type_id'            => '1',
            //     'name'                        => 'Ce parte a corpului te doare cel mai des?*',
            //     'answer_suggestion'           => 'Pe mine mă doare spatele cel mai mult fiindcă stau mult pe scaun. Pe tine?',
            //     'questionnaire_media_type_id' => '2',
            //     'media_card_url'              => '/images/questionnaire/question9.jpg',
            // ],
            // [
            //     'id'                          => '10',
            //     'questionnaire_id'            => '1',
            //     'question_type_id'            => '1',
            //     'name'                        => 'Cât timp petreci în fața ecranului( TV, telefon, calculator) zilnic?*',
            //     'answer_suggestion'           => 'Răspunde sincer',
            //     'questionnaire_media_type_id' => '2',
            //     'media_card_url'              => '/images/questionnaire/question10.jpg',
            // ],
            // [
            //     'id'                          => '11',
            //     'questionnaire_id'            => '1',
            //     'question_type_id'            => '1',
            //     'name'                        => 'Îți place să faci mișcare?*',
            //     'answer_suggestion'           => 'Mișcare înseamnă și plimbare lejeră sau făcut curățenie prin casă',
            //     'questionnaire_media_type_id' => '3',
            //     'media_card_url'              => 'https://www.youtube.com/embed/nm0jvyv3UOk',
            // ],
            // [
            //     'id'                          => '12',
            //     'questionnaire_id'            => '1',
            //     'question_type_id'            => '1',
            //     'name'                        => 'Ce îți place să faci în timpul liber?*',
            //     'answer_suggestion'           => 'Mie îmi place să citesc sau să mă uit la filme. Ție? Alege activitatea care îți place cel mai mult.',
            //     'questionnaire_media_type_id' => '2',
            //     'media_card_url'              => '/images/questionnaire/question12.jpg',
            // ],
            // [
            //     'id'                          => '13',
            //     'questionnaire_id'            => '1',
            //     'question_type_id'            => '1',
            //     'name'                        => 'Ce stare ai dimineața când te trezești?*',
            //     'answer_suggestion'           => 'Alege starea cea mai frecventă. Eu mă trezesc de obicei obosită.',
            //     'questionnaire_media_type_id' => '2',
            //     'media_card_url'              => '/images/questionnaire/question13.jpg',
            // ],
            // [
            //     'id'                          => '14',
            //     'questionnaire_id'            => '1',
            //     'question_type_id'            => '1',
            //     'name'                        => 'Ce stare ai seara înainte de culcare?*',
            //     'answer_suggestion'           => 'Alege starea pe care o ai cel mai des. Eu sunt foarte obosită mai mereu înainte de culcare.',
            //     'questionnaire_media_type_id' => '2',
            //     'media_card_url'              => '/images/questionnaire/question14.jpg',
            // ],
            // [
            //     'id'                          => '15',
            //     'questionnaire_id'            => '1',
            //     'question_type_id'            => '6',
            //     'name'                        => 'Ce spun cei dragi despre tine? Enumeră 2 calități și un defect.*',
            //     'answer_suggestion'           => 'Primele calități si primul defect pe care ți le spun constant.',
            //     'questionnaire_media_type_id' => '1',
            //     'media_card_url'              => '',
            // ],
            // [
            //     'id'                          => '16',
            //     'questionnaire_id'            => '1',
            //     'question_type_id'            => '2',
            //     'name'                        => 'Cum evaluezi acest chestionar pe o scală de la 1 — foarte plictisitor la 5 — interesant?*',
            //     'answer_suggestion'           => 'Apreciez părerea ta și îți mulțumesc pentru asta.',
            //     'questionnaire_media_type_id' => '2',
            //     'media_card_url'              => '/images/questionnaire/question16.jpg',
            // ],
            // [
            //     'id'                          => '17',
            //     'questionnaire_id'            => '1',
            //     'question_type_id'            => '6',
            //     'name'                        => 'Când este ziua ta de naștere?*',
            //     'answer_suggestion'           => 'Este suficient să scrii ziua și luna. Eu sunt născută pe 1 iunie.',
            //     'questionnaire_media_type_id' => '2',
            //     'media_card_url'              => '/images/questionnaire/question17.jpg',
            // ],
            // [
            //     'id'                          => '18',
            //     'questionnaire_id'            => '1',
            //     'question_type_id'            => '6',
            //     'name'                        => 'În ce localitate locuiești?*',
            //     'answer_suggestion'           => 'Dacă este o localitate pe care nu o știe toată lumea, specifică te rog și județul.',
            //     'questionnaire_media_type_id' => '2',
            //     'media_card_url'              => '/images/questionnaire/question18.jpg',
            // ],
            // [
            //     'id'                          => '19',
            //     'questionnaire_id'            => '1',
            //     'question_type_id'            => '6',
            //     'name'                        => 'Cum te numești? Să facem cunoștință.*',
            //     'answer_suggestion'           => 'Eu sunt Mădălina. Tu? Este suficient prenumele tău.',
            //     'questionnaire_media_type_id' => '2',
            //     'media_card_url'              => '/images/questionnaire/question19.jpg',
            // ],
            // [
            //     'id'                          => '20',
            //     'questionnaire_id'            => '1',
            //     'question_type_id'            => '6',
            //     'name'                        => 'Adresa ta de e-mail*',
            //     'answer_suggestion'           => 'Pentru a-ți trimite rezultatul la chestionar și pentru a păstra legătura',
            //     'questionnaire_media_type_id' => '2',
            //     'media_card_url'              => '/images/questionnaire/question20.jpg',
            // ],
        ];
        QuestionnaireQuestion::insert($records);
    }
}
