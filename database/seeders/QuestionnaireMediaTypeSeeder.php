<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Questionnaire\QuestionnaireMediaType;

class QuestionnaireMediaTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuestionnaireMediaType::truncate();
        $records = [
            [
                'id'              => '1',
                'media_type_name' => 'No media',
            ],
            [
                'id'              => '2',
                'media_type_name' => 'Image',
            ],
            [
                'id'              => '3',
                'media_type_name' => 'Video',
            ],
        ];
        QuestionnaireMediaType::insert($records);
    }
}
