<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogArticleCommentReplyReply;

class BlogArticleCommentReplyRepliesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BlogArticleCommentReplyReply::truncate();
        $records = [
            [
                'id'                            => '1',
                'blog_article_comment_reply_id' => '1',
                'full_name'                     => 'Dinu Mariana',
                'email'                         => 'dinu.mariana@gmail.com',
                'reply_to_comment_reply'        => '(First comment reply) Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam aliquam libero inventore eveniet ad soluta harum minima consequatur? Expedita quam omnis et, explicabo ut ea nostrum dolor illo optio nihil hic suscipit mollitia veniam. Ipsa id quos quisquam eaque, tenetur ullam est unde ducimus quod repellendus cumque odit. Earum, praesentium esse labore ex laboriosam natus, aperiam necessitatibus unde quae rem placeat facere dolor dignissimos incidunt perspiciatis cum quo culpa eaque laborum tempora reiciendis nihil adipisci impedit quaerat! Omnis qui fuga fugiat! Dolore sunt, fugit vel qui accusamus minima rem quod accusantium quisquam totam mollitia iusto! Architecto eligendi molestias autem quasi ducimus possimus eaque fuga distinctio nobis, quibusdam velit expedita obcaecati. Dolorum aperiam fugit quisquam earum molestias ad laborum neque, debitis ullam cum officia sequi voluptatibus assumenda possimus, quaerat unde quis quae ex veritatis exercitationem. Nesciunt harum culpa minima rem velit, maiores, provident et nostrum accusamus omnis, perferendis dignissimos non. Et!',
                'comment_reply_is_public'       => '1',
                'privacy_policy'                => '1',
                'created_at'                    => '2021-09-04 12:45:00',
                'updated_at'                    => '2021-09-04 12:45:00',
            ],
        ];
        BlogArticleCommentReplyReply::insert($records);
    }
}
