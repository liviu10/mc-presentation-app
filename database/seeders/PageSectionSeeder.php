<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\PageSection;

class PageSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        PageSection::truncate();
        $records = [
            [
                'id'           => '1',
                'section_name' => 'Carousel',
                'section_slug' => 'carousel',
            ],
            [
                'id'           => '2',
                'section_name' => 'Jumbotron',
                'section_slug' => 'jumbotron',
            ],
            [
                'id'           => '3',
                'section_name' => 'Testimonials',
                'section_slug' => 'testimonials',
            ],
            [
                'id'           => '4',
                'section_name' => 'Terms and Conditions',
                'section_slug' => 'terms-and-conditions',
            ],
            [
                'id'           => '5',
                'section_name' => 'Footer',
                'section_slug' => 'Footer',
            ],
        ];
        PageSection::insert($records);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
