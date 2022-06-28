<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\PageSectionContact;

class PageSectionContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        PageSectionContact::truncate();
        $records = [
            [
                'id'              => '1',
                'page_section_id' => '2',
                'title'           => 'Contact',
                'paragraph_1'     => 'Ți-a atras ceva atenția pe site și nu ai găsit informația completă? Sau ai o curiozitate legată de mine sau de activitatea mea?',
                'paragraph_2'     => 'Ai vreo propunere, recomandare sau părere care vrei să ajungă la mine?',
                'paragraph_3'     => 'Te rog lasă-mi mesajul tău mai jos și îți răspund cât mai rapid.',
                'paragraph_4'     => 'Mulțumesc!',
                'image_url'       => config('app.url') . '/images/pages/contact_me/dance-question-mark_600.webp',
            ],
        ];
        PageSectionContact::insert($records);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
