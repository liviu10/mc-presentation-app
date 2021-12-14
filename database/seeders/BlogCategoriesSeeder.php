<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogCategory;

class BlogCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BlogCategory::truncate();
        $records = [
            [
                'id'                              => '1',
                'blog_category_title'             => 'Articole',
                'blog_category_short_description' => 'Vrei să reduci stresul și să-ți îmbunătățești creativitatea și sănătatea? Citește! 5 minute pe zi face minuni. Vrei să intri în lumea Mariei, o călătorie cu multe povestiri? Vrei să știi despre ce e vorba într-o carte doar citind o recenzie scurtă?',
                'blog_category_description'       => '',
                'blog_category_is_active'         => '1',
                'blog_image_card_url'             => '/images/cards/Card-img0_400.webp',
                'blog_category_path'              => '/blog/article',
                'created_at'                      => '2021-09-01 00:00:00',
                'updated_at'                      => '2021-09-01 00:00:00',
            ],
            [
                'id'                              => '2',
                'blog_category_title'             => 'Audio',
                'blog_category_short_description' => 'Îți place să asculți muzică acasă sau în mașină? Vrei să auzi o glumă bună sau o poveste haioasă când ești stresat / stresată?',
                'blog_category_description'       => '',
                'blog_category_is_active'         => '1',
                'blog_image_card_url'             => '/images/cards/Card-img1_400.webp',
                'blog_category_path'              => '/blog/audio',
                'created_at'                      => '2021-09-01 00:00:00',
                'updated_at'                      => '2021-09-01 00:00:00',
            ],
            [
                'id'                              => '3',
                'blog_category_title'             => 'Video',
                'blog_category_short_description' => 'Ești o persoană vizuală, care mai degrabă se uită la un video decât citește un articol? Vrei să vezi persoana care te ghidează? Ai văzut vreodată dansuri simple relaționate cu stările emoționale? Vrei să te bucuri de un video Experiențial?',
                'blog_category_description'       => '',
                'blog_category_is_active'         => '1',
                'blog_image_card_url'             => '/images/cards/Card-img2_400.webp',
                'blog_category_path'              => '/blog/video',
                'created_at'                      => '2021-09-01 00:00:00',
                'updated_at'                      => '2021-09-01 00:00:00',
            ],
        ];
        BlogCategory::insert($records);
    }
}
