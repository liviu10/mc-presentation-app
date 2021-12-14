<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogSubcategory;

class BlogSubcategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BlogSubcategory::truncate();
        $records = [
            [
                'id'                                 => '1',
                'blog_category_id'                   => '1',
                'blog_subcategory_title'             => 'Recomandări nutriționale',
                'blog_subcategory_short_description' => '',
                'blog_subcategory_description'       => '',
                'blog_subcategory_is_active'         => '1',
                'blog_subcategory_path'              => '/blog/subcategory/1/all-written-articles',
                'created_at'                         => '2021-09-01 00:00:00',
                'updated_at'                         => '2021-09-01 00:00:00',
            ],
            [
                'id'                                 => '2',
                'blog_category_id'                   => '1',
                'blog_subcategory_title'             => 'Povestirile Mariei',
                'blog_subcategory_short_description' => '',
                'blog_subcategory_description'       => '',
                'blog_subcategory_is_active'         => '1',
                'blog_subcategory_path'              => '/blog/subcategory/2/all-written-articles',
                'created_at'                         => '2021-09-01 00:00:00',
                'updated_at'                         => '2021-09-01 00:00:00',
            ],
            [
                'id'                                 => '3',
                'blog_category_id'                   => '1',
                'blog_subcategory_title'             => 'Recenzii cărți',
                'blog_subcategory_short_description' => '',
                'blog_subcategory_description'       => '',
                'blog_subcategory_is_active'         => '1',
                'blog_subcategory_path'              => '/blog/subcategory/3/all-written-articles',
                'created_at'                         => '2021-09-01 00:00:00',
                'updated_at'                         => '2021-09-01 00:00:00',
            ],
            [
                'id'                                 => '4',
                'blog_category_id'                   => '2',
                'blog_subcategory_title'             => 'Glume',
                'blog_subcategory_short_description' => '',
                'blog_subcategory_description'       => '',
                'blog_subcategory_is_active'         => '1',
                'blog_subcategory_path'              => '/blog/subcategory/5/all-audio-articles',
                'created_at'                         => '2021-09-01 00:00:00',
                'updated_at'                         => '2021-09-01 00:00:00',
            ],
            [
                'id'                                 => '5',
                'blog_category_id'                   => '2',
                'blog_subcategory_title'             => 'Povești',
                'blog_subcategory_short_description' => '',
                'blog_subcategory_description'       => '',
                'blog_subcategory_is_active'         => '1',
                'blog_subcategory_path'              => '/blog/subcategory/6/all-audio-articles',
                'created_at'                         => '2021-09-01 00:00:00',
                'updated_at'                         => '2021-09-01 00:00:00',
            ],
            [
                'id'                                 => '6',
                'blog_category_id'                   => '2',
                'blog_subcategory_title'             => 'Recomandări muzicale',
                'blog_subcategory_short_description' => '',
                'blog_subcategory_description'       => '',
                'blog_subcategory_is_active'         => '1',
                'blog_subcategory_path'              => '/blog/subcategory/7/all-audio-articles',
                'created_at'                         => '2021-09-01 00:00:00',
                'updated_at'                         => '2021-09-01 00:00:00',
            ],
            [
                'id'                                 => '7',
                'blog_category_id'                   => '3',
                'blog_subcategory_title'             => 'Dans experiențial',
                'blog_subcategory_short_description' => '',
                'blog_subcategory_description'       => '',
                'blog_subcategory_is_active'         => '1',
                'blog_subcategory_path'              => '/blog/subcategory/8/all-video-articles',
                'created_at'                         => '2021-09-01 00:00:00',
                'updated_at'                         => '2021-09-01 00:00:00',
            ],
            [
                'id'                                 => '8',
                'blog_category_id'                   => '3',
                'blog_subcategory_title'             => 'Povestea de joi desenată',
                'blog_subcategory_short_description' => '',
                'blog_subcategory_description'       => '',
                'blog_subcategory_is_active'         => '1',
                'blog_subcategory_path'              => '/blog/subcategory/9/all-video-articles',
                'created_at'                         => '2021-09-01 00:00:00',
                'updated_at'                         => '2021-09-01 00:00:00',
            ],
            [
                'id'                                 => '9',
                'blog_category_id'                   => '3',
                'blog_subcategory_title'             => 'Experiențe și evenimente',
                'blog_subcategory_short_description' => '',
                'blog_subcategory_description'       => '',
                'blog_subcategory_is_active'         => '1',
                'blog_subcategory_path'              => '/blog/subcategory/10/all-video-articles',
                'created_at'                         => '2021-09-01 00:00:00',
                'updated_at'                         => '2021-09-01 00:00:00',
            ],
        ];
        BlogSubcategory::insert($records);
    }
}
