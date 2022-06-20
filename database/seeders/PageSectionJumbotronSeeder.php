<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\PageSectionJumbotron;

class PageSectionJumbotronSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        PageSectionJumbotron::truncate();
        $records = [
            [
                'id'                       => '1',
                'page_section_id'          => '2',
                'description'              => 'Bine ai venit în călătoria ta experiențială! Urcă-te la bord și lasă-te purtat de tot ce vei experimenta. Aici vei regăsi diversitate de momente ca o shaorma cu de toate. În funcție de personalitatea ta vei afla cum muzica te poate influența și vei străluci în lumina inimii. Vor fi videouri săptămânale motivaționale, cu dans experiențial, cu recomandări nutriționale și cu multe altele. De asemenea poți citi povești de viață care să-ți dea de gândit și poți auzi unele lucruri haioase. Te-ai pregătit? Îndată am și pornit. Explorează-ți toate simțurile și pornește în călătoria ta!',
                'button_label'             => 'Să ne cunoaștem mai bine!',
                'button_url'               => config('app.url') . '/schedule-appointment',
                'link_to_social_media_1'   => 'https://www.facebook.com/groups/269560668238590/?ref=share',
                'label_for_social_media_1' => 'Urmărește-mă pe Facebook!',
                'link_to_social_media_2'   => 'https://www.youtube.com/channel/UCvyAUdyF4qG1j6S8IX67W5A/featured',
                'label_for_social_media_2' => 'Urmărește-mă pe Youtube!',
            ],
        ];
        PageSectionJumbotron::insert($records);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
