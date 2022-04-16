<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\BlogArticleComment;

class BlogArticleCommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        BlogArticleComment::truncate();
        $records = [
            [
                'id'                  => '1',
                'blog_article_id'     => '1',
                'full_name'           => 'Liviu Voica',
                'email'               => 'voica.liviu10@gmail.com',
                'comment'             => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam aliquam libero inventore eveniet ad soluta harum minima consequatur? Expedita quam omnis et, explicabo ut ea nostrum dolor illo optio nihil hic suscipit mollitia veniam. Ipsa id quos quisquam eaque, tenetur ullam est unde ducimus quod repellendus cumque odit. Earum, praesentium esse labore ex laboriosam natus, aperiam necessitatibus unde quae rem placeat facere dolor dignissimos incidunt perspiciatis cum quo culpa eaque laborum tempora reiciendis nihil adipisci impedit quaerat! Omnis qui fuga fugiat! Dolore sunt, fugit vel qui accusamus minima rem quod accusantium quisquam totam mollitia iusto! Architecto eligendi molestias autem quasi ducimus possimus eaque fuga distinctio nobis, quibusdam velit expedita obcaecati. Dolorum aperiam fugit quisquam earum molestias ad laborum neque, debitis ullam cum officia sequi voluptatibus assumenda possimus, quaerat unde quis quae ex veritatis exercitationem. Nesciunt harum culpa minima rem velit, maiores, provident et nostrum accusamus omnis, perferendis dignissimos non. Et!',
                'comment_is_public'   => '1',
                'privacy_policy'      => '1',
                'created_at'          => '2021-09-04 12:45:00',
                'updated_at'          => '2021-09-04 12:45:00',
            ],
            [
                'id'                  => '2',
                'blog_article_id'     => '1',
                'full_name'           => 'Popescu Adrian George',
                'email'               => 'popescu.george@gmail.com',
                'comment'             => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam aliquam libero inventore eveniet ad soluta harum minima consequatur? Expedita quam omnis et, explicabo ut ea nostrum dolor illo optio nihil hic suscipit mollitia veniam. Ipsa id quos quisquam eaque, tenetur ullam est unde ducimus quod repellendus cumque odit. Earum, praesentium esse labore ex laboriosam natus, aperiam necessitatibus unde quae rem placeat facere dolor dignissimos incidunt perspiciatis cum quo culpa eaque laborum tempora reiciendis nihil adipisci impedit quaerat! Omnis qui fuga fugiat! Dolore sunt, fugit vel qui accusamus minima rem quod accusantium quisquam totam mollitia iusto! Architecto eligendi molestias autem quasi ducimus possimus eaque fuga distinctio nobis, quibusdam velit expedita obcaecati. Dolorum aperiam fugit quisquam earum molestias ad laborum neque, debitis ullam cum officia sequi voluptatibus assumenda possimus, quaerat unde quis quae ex veritatis exercitationem. Nesciunt harum culpa minima rem velit, maiores, provident et nostrum accusamus omnis, perferendis dignissimos non. Et!',
                'comment_is_public'   => '0',
                'privacy_policy'      => '1',
                'created_at'          => '2021-09-04 15:37:00',
                'updated_at'          => '2021-09-04 15:37:00',
            ],
            [
                'id'                  => '3',
                'blog_article_id'     => '1',
                'full_name'           => 'Alina Ionescu',
                'email'               => 'aline_ionescu@yahoo.com',
                'comment'             => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam aliquam libero inventore eveniet ad soluta harum minima consequatur? Expedita quam omnis et, explicabo ut ea nostrum dolor illo optio nihil hic suscipit mollitia veniam. Ipsa id quos quisquam eaque, tenetur ullam est unde ducimus quod repellendus cumque odit. Earum, praesentium esse labore ex laboriosam natus, aperiam necessitatibus unde quae rem placeat facere dolor dignissimos incidunt perspiciatis cum quo culpa eaque laborum tempora reiciendis nihil adipisci impedit quaerat! Omnis qui fuga fugiat! Dolore sunt, fugit vel qui accusamus minima rem quod accusantium quisquam totam mollitia iusto! Architecto eligendi molestias autem quasi ducimus possimus eaque fuga distinctio nobis, quibusdam velit expedita obcaecati. Dolorum aperiam fugit quisquam earum molestias ad laborum neque, debitis ullam cum officia sequi voluptatibus assumenda possimus, quaerat unde quis quae ex veritatis exercitationem. Nesciunt harum culpa minima rem velit, maiores, provident et nostrum accusamus omnis, perferendis dignissimos non. Et!',
                'comment_is_public'   => '1',
                'privacy_policy'      => '1',
                'created_at'          => '2021-09-04 17:56:00',
                'updated_at'          => '2021-09-04 17:56:00',
            ],
            [
                'id'                  => '4',
                'blog_article_id'     => '4',
                'full_name'           => 'Liviu Voica',
                'email'               => 'voica.liviu10@gmail.com',
                'comment'             => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam aliquam libero inventore eveniet ad soluta harum minima consequatur? Expedita quam omnis et, explicabo ut ea nostrum dolor illo optio nihil hic suscipit mollitia veniam. Ipsa id quos quisquam eaque, tenetur ullam est unde ducimus quod repellendus cumque odit. Earum, praesentium esse labore ex laboriosam natus, aperiam necessitatibus unde quae rem placeat facere dolor dignissimos incidunt perspiciatis cum quo culpa eaque laborum tempora reiciendis nihil adipisci impedit quaerat! Omnis qui fuga fugiat! Dolore sunt, fugit vel qui accusamus minima rem quod accusantium quisquam totam mollitia iusto! Architecto eligendi molestias autem quasi ducimus possimus eaque fuga distinctio nobis, quibusdam velit expedita obcaecati. Dolorum aperiam fugit quisquam earum molestias ad laborum neque, debitis ullam cum officia sequi voluptatibus assumenda possimus, quaerat unde quis quae ex veritatis exercitationem. Nesciunt harum culpa minima rem velit, maiores, provident et nostrum accusamus omnis, perferendis dignissimos non. Et!',
                'comment_is_public'   => '1',
                'privacy_policy'      => '1',
                'created_at'          => '2021-09-04 12:45:00',
                'updated_at'          => '2021-09-04 12:45:00',
            ],
            [
                'id'                  => '5',
                'blog_article_id'     => '7',
                'full_name'           => 'George Mavrocordat',
                'email'               => 'geo_md10@gmail.com',
                'comment'             => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam aliquam libero inventore eveniet ad soluta harum minima consequatur? Expedita quam omnis et, explicabo ut ea nostrum dolor illo optio nihil hic suscipit mollitia veniam. Ipsa id quos quisquam eaque, tenetur ullam est unde ducimus quod repellendus cumque odit. Earum, praesentium esse labore ex laboriosam natus, aperiam necessitatibus unde quae rem placeat facere dolor dignissimos incidunt perspiciatis cum quo culpa eaque laborum tempora reiciendis nihil adipisci impedit quaerat! Omnis qui fuga fugiat! Dolore sunt, fugit vel qui accusamus minima rem quod accusantium quisquam totam mollitia iusto! Architecto eligendi molestias autem quasi ducimus possimus eaque fuga distinctio nobis, quibusdam velit expedita obcaecati. Dolorum aperiam fugit quisquam earum molestias ad laborum neque, debitis ullam cum officia sequi voluptatibus assumenda possimus, quaerat unde quis quae ex veritatis exercitationem. Nesciunt harum culpa minima rem velit, maiores, provident et nostrum accusamus omnis, perferendis dignissimos non. Et!',
                'comment_is_public'   => '1',
                'privacy_policy'      => '1',
                'created_at'          => '2021-09-04 12:45:00',
                'updated_at'          => '2021-09-04 12:45:00',
            ],
        ];
        BlogArticleComment::insert($records);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
