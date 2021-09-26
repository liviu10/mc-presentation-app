<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogCategoryConfiguration;
use Illuminate\Support\Facades\DB;

class BlogCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        BlogCategoryConfiguration::truncate();
        $records = [
            [
                'id'                        => '1',
                'blog_category_code'        => 'ART_01',
                'blog_category_title'       => 'ARTICOLE',
                'blog_category_description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore iusto, magni quae, et laborum recusandae, cumque aperiam hic suscipit odio mollitia fugit aliquam velit nihil.',
                'blog_category_is_active'   => '1',
                'blog_image_card_url'       => '/images/cards/Card-img0.png',
                'blog_category_path'        => '/blog/article',
                'created_at'                => '2021-09-26 00:00:00',
                'updated_at'                => '2021-09-26 00:00:00',
            ],
            [
                'id'                        => '2',
                'blog_category_code'        => 'AUD_01',
                'blog_category_title'       => 'AUDIO',
                'blog_category_description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore iusto, magni quae, et laborum recusandae, cumque aperiam hic suscipit odio mollitia fugit aliquam velit nihil.',
                'blog_category_is_active'   => '1',
                'blog_image_card_url'       => '/images/cards/Card-img1.png',
                'blog_category_path'        => '/blog/audio',
                'created_at'                => '2021-09-26 00:00:00',
                'updated_at'                => '2021-09-26 00:00:00',
            ],
            [
                'id'                        => '3',
                'blog_category_code'        => 'VID_01',
                'blog_category_title'       => 'VIDEO',
                'blog_category_description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore iusto, magni quae, et laborum recusandae, cumque aperiam hic suscipit odio mollitia fugit aliquam velit nihil.',
                'blog_category_is_active'   => '1',
                'blog_image_card_url'       => '/images/cards/Card-img2.png',
                'blog_category_path'        => '/blog/video',
                'created_at'                => '2021-09-26 00:00:00',
                'updated_at'                => '2021-09-26 00:00:00',
            ],
        ];
        BlogCategoryConfiguration::insert($records);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
