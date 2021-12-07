<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuestionnaireQuestionType;

class QuestionnaireQuestionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuestionnaireQuestionType::truncate();
        $records = [
            [
                'id'                           => '1',
                'question_type'                => 'Single or Multiple choice questions',
                'question_type_specifications' => 'Multiple choice questions are the most popular survey question type. They allow your respondents to select one or more options from a list of answers that you define. They’re intuitive, easy to use in different ways, help produce easy-to-analyze data, and provide mutually exclusive choices. Because the answer options are fixed, your respondents have an easier survey-taking experience.',
            ],
            [
                'id'                           => '2',
                'question_type'                => 'Rating scale questions',
                'question_type_specifications' => 'In rating scale questions (sometimes referred to as ordinal questions), the question displays a scale of answer options from any range (0 to 100, 1 to 10, etc.). The respondent selects the number that most accurately represents their response.',
            ],
            [
                'id'                           => '3',
                'question_type'                => 'Likert scale questions',
                'question_type_specifications' => 'Chances are you’ve seen this question type before. Likert scale questions are the “do you agree or disagree” questions you often see in surveys, and are used to gauge respondents’ opinions and feelings.',
            ],
            [
                'id'                           => '4',
                'question_type'                => 'Matrix questions',
                'question_type_specifications' => 'If you want to ask a few questions in a row that have the same response options, matrix questions are your best option. A series of Likert scale questions or a series of rating scale questions can work well as a matrix question. Matrix questions can simplify a lot of content, but it’s important to use them carefully. Very large matrices, like the one below, can be confusing and difficult to take on mobile devices.',
            ],
            [
                'id'                           => '5',
                'question_type'                => 'Dropdown questions',
                'question_type_specifications' => 'The dropdown question is an easy way to display a long list of multiple choice answers without overwhelming your respondents. With it, you can give them a scrollable list of answers to choose from.',
            ],
            [
                'id'                           => '6',
                'question_type'                => 'Open-ended questions',
                'question_type_specifications' => 'Open-ended survey questions require respondents to type their answer into a comment box and don’t provide specific pre-set answer options. Responses are then viewed individually or by text analysis tools.',
            ],
            [
                'id'                           => '7',
                'question_type'                => 'Demographic questions',
                'question_type_specifications' => 'Use demographic survey questions if you’re interested in gathering information about a respondent’s background or income level. When properly used, these types of questions in a questionnaire allow you to gain better insights on your target audience. Demographic questions are powerful tools to segment your audience based on who they are and what they do, allowing you to take an even deeper dive in on your data.',
            ],
            [
                'id'                           => '8',
                'question_type'                => 'Ranking questions',
                'question_type_specifications' => 'A ranking question asks respondents to order answer choices by way of preference. This allows you to not only understand how respondents feel about each answer option, but it also helps you understand each one’s relative popularity.',
            ],
            [
                'id'                           => '9',
                'question_type'                => 'Image choice questions',
                'question_type_specifications' => 'Our image choice question type allows you to use images as answer options. This works great when you want respondents to evaluate the visual qualities of something, such as an ad or a logo. It can also provide a breath of fresh air for respondents, as it gives them a break from reading.',
            ],
            [
                'id'                           => '10',
                'question_type'                => 'Click map questions',
                'question_type_specifications' => 'Want to get real-time, gut reaction feedback on an image? Use a click map question! Add an image to your survey and ask survey takers to click a certain spot on the image. For example, you could ask what item on a shelf is most appealing, or which part of your website is most user friendly.',
            ],
            [
                'id'                           => '11',
                'question_type'                => 'File upload questions',
                'question_type_specifications' => 'Need respondents to upload their resume? A headshot? Their ID? You can collect whatever you need as a PDF, PNG, or Doc file. And once your responses come back, you can easily download the files.',
            ],
            [
                'id'                           => '12',
                'question_type'                => 'Slider questions',
                'question_type_specifications' => 'Give respondents a chance to evaluate something on a numerical scale with our slider question type. They’re interactive, which can make them fun to answer, and they allow you to quantify respondent sentiment at both an individual and aggregate level.',
            ],
            [
                'id'                           => '13',
                'question_type'                => 'Benchmarkable questions',
                'question_type_specifications' => 'Benchmarkable questions aren’t necessarily presented in a specific format, but they’re special in that they allow you to compare yourself to other survey creators who asked the same question.',
            ],
        ];
        QuestionnaireQuestionType::insert($records);
    }
}
