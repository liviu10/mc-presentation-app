<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\PageSectionTestimonial;

class PageSectionTestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        PageSectionTestimonial::truncate();
        $records = [
            [
                'id'              => '1',
                'page_section_id' => '3',
                'name'            => 'Voica Liviu',
                'occupation'      => 'Developer',
                'description'     => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, autem. Repellendus rerum deleniti dolores sed aperiam tempora reprehenderit iste dolorem? In, ut veniam modi ab unde optio illo nostrum at molestiae vel porro, voluptatibus accusamus dolorem hic inventore neque quae eveniet libero error. Temporibus, natus laborum facilis, eum dolor id ipsa dignissimos et, sunt quo autem. Voluptatum modi magni iusto optio eaque atque dolore dignissimos accusamus, eligendi ipsum fugiat cupiditate repudiandae nihil. Vel, tenetur aliquid.',
            ],
            [
                'id'              => '2',
                'page_section_id' => '3',
                'name'            => 'Popescu George',
                'occupation'      => 'Developer',
                'description'     => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, autem. Repellendus rerum deleniti dolores sed aperiam tempora reprehenderit iste dolorem? In, ut veniam modi ab unde optio illo nostrum at molestiae vel porro, voluptatibus accusamus dolorem hic inventore neque quae eveniet libero error. Temporibus, natus laborum facilis, eum dolor id ipsa dignissimos et, sunt quo autem. Voluptatum modi magni iusto optio eaque atque dolore dignissimos accusamus, eligendi ipsum fugiat cupiditate repudiandae nihil. Vel, tenetur aliquid.',
            ],
            [
                'id'              => '3',
                'page_section_id' => '3',
                'name'            => 'Andreea Ionescu',
                'occupation'      => 'Developer',
                'description'     => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, autem. Repellendus rerum deleniti dolores sed aperiam tempora reprehenderit iste dolorem? In, ut veniam modi ab unde optio illo nostrum at molestiae vel porro, voluptatibus accusamus dolorem hic inventore neque quae eveniet libero error. Temporibus, natus laborum facilis, eum dolor id ipsa dignissimos et, sunt quo autem. Voluptatum modi magni iusto optio eaque atque dolore dignissimos accusamus, eligendi ipsum fugiat cupiditate repudiandae nihil. Vel, tenetur aliquid.',
            ],
        ];
        PageSectionTestimonial::insert($records);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
