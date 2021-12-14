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
                'blog_category_title'             => 'ARTICOLE',
                'blog_category_short_description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatem quas natus neque aperiam, dolor unde a nostrum, perspiciatis corporis veritatis eius. Doloremque iure consequatur nulla, magni nihil quo labore natus!',
                'blog_category_description'       => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius corporis velit enim animi. Reiciendis nesciunt libero magnam quaerat! Nulla, dolore sint deserunt quas iure sed magnam consectetur architecto eligendi iste? Dignissimos, velit, molestiae repellendus cupiditate nobis eos corporis ipsam possimus qui unde veritatis temporibus, dolorum saepe accusamus laudantium quibusdam iusto autem placeat eaque error quia provident dolore laboriosam minus? Fugit corrupti nam ex, officia sapiente aspernatur eos at suscipit eveniet quasi quisquam ea fugiat reprehenderit provident. Minima, laudantium exercitationem ducimus ratione natus tempore! Asperiores, consequuntur! Ad culpa nihil nemo magni iste, deserunt quis? Esse quia totam ea magni quas ipsam cumque minus officiis unde quos sapiente laboriosam debitis iste reiciendis beatae ut vel perspiciatis quisquam aperiam similique, assumenda molestiae maiores cupiditate! Tempore repellat minima facere repellendus distinctio soluta aut magni velit nostrum nisi assumenda, quaerat quisquam officia nihil voluptatum, culpa, illo dolore obcaecati quos dolores esse blanditiis voluptatem nam! Voluptates unde eius consequuntur, est dicta ullam iste commodi temporibus! Consequuntur, numquam. Tempora, culpa repudiandae ipsa earum magnam animi. Enim facere commodi harum ipsam quos fugit earum amet temporibus voluptas voluptatibus, tenetur ducimus, alias, nam saepe hic id pariatur labore veritatis maiores optio ipsa aliquam consectetur porro est. Aut iusto atque labore! Fugit alias eligendi eveniet omnis nesciunt dolorum mollitia aut at ducimus, aliquid delectus minima non officiis natus sed repellat aliquam pariatur voluptatum cupiditate incidunt ad et dignissimos. Reprehenderit, corporis veritatis fugit ab alias perferendis repellat aspernatur ea dolorem ratione officiis. Molestiae veniam assumenda tenetur non voluptatum iste magni nemo!',
                'blog_category_is_active'         => '1',
                'blog_image_card_url'             => '/images/cards/Card-img0_400.webp',
                'blog_category_path'              => '/blog/article',
                'created_at'                      => '2021-09-01 00:00:00',
                'updated_at'                      => '2021-09-01 00:00:00',
            ],
            [
                'id'                              => '2',
                'blog_category_title'             => 'AUDIO',
                'blog_category_short_description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatem quas natus neque aperiam, dolor unde a nostrum, perspiciatis corporis veritatis eius. Doloremque iure consequatur nulla, magni nihil quo labore natus!',
                'blog_category_description'       => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius corporis velit enim animi. Reiciendis nesciunt libero magnam quaerat! Nulla, dolore sint deserunt quas iure sed magnam consectetur architecto eligendi iste? Dignissimos, velit, molestiae repellendus cupiditate nobis eos corporis ipsam possimus qui unde veritatis temporibus, dolorum saepe accusamus laudantium quibusdam iusto autem placeat eaque error quia provident dolore laboriosam minus? Fugit corrupti nam ex, officia sapiente aspernatur eos at suscipit eveniet quasi quisquam ea fugiat reprehenderit provident. Minima, laudantium exercitationem ducimus ratione natus tempore! Asperiores, consequuntur! Ad culpa nihil nemo magni iste, deserunt quis? Esse quia totam ea magni quas ipsam cumque minus officiis unde quos sapiente laboriosam debitis iste reiciendis beatae ut vel perspiciatis quisquam aperiam similique, assumenda molestiae maiores cupiditate! Tempore repellat minima facere repellendus distinctio soluta aut magni velit nostrum nisi assumenda, quaerat quisquam officia nihil voluptatum, culpa, illo dolore obcaecati quos dolores esse blanditiis voluptatem nam! Voluptates unde eius consequuntur, est dicta ullam iste commodi temporibus! Consequuntur, numquam. Tempora, culpa repudiandae ipsa earum magnam animi. Enim facere commodi harum ipsam quos fugit earum amet temporibus voluptas voluptatibus, tenetur ducimus, alias, nam saepe hic id pariatur labore veritatis maiores optio ipsa aliquam consectetur porro est. Aut iusto atque labore! Fugit alias eligendi eveniet omnis nesciunt dolorum mollitia aut at ducimus, aliquid delectus minima non officiis natus sed repellat aliquam pariatur voluptatum cupiditate incidunt ad et dignissimos. Reprehenderit, corporis veritatis fugit ab alias perferendis repellat aspernatur ea dolorem ratione officiis. Molestiae veniam assumenda tenetur non voluptatum iste magni nemo!',
                'blog_category_is_active'         => '1',
                'blog_image_card_url'             => '/images/cards/Card-img1_400.webp',
                'blog_category_path'              => '/blog/audio',
                'created_at'                      => '2021-09-01 00:00:00',
                'updated_at'                      => '2021-09-01 00:00:00',
            ],
            [
                'id'                              => '3',
                'blog_category_title'             => 'VIDEO',
                'blog_category_short_description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatem quas natus neque aperiam, dolor unde a nostrum, perspiciatis corporis veritatis eius. Doloremque iure consequatur nulla, magni nihil quo labore natus!',
                'blog_category_description'       => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius corporis velit enim animi. Reiciendis nesciunt libero magnam quaerat! Nulla, dolore sint deserunt quas iure sed magnam consectetur architecto eligendi iste? Dignissimos, velit, molestiae repellendus cupiditate nobis eos corporis ipsam possimus qui unde veritatis temporibus, dolorum saepe accusamus laudantium quibusdam iusto autem placeat eaque error quia provident dolore laboriosam minus? Fugit corrupti nam ex, officia sapiente aspernatur eos at suscipit eveniet quasi quisquam ea fugiat reprehenderit provident. Minima, laudantium exercitationem ducimus ratione natus tempore! Asperiores, consequuntur! Ad culpa nihil nemo magni iste, deserunt quis? Esse quia totam ea magni quas ipsam cumque minus officiis unde quos sapiente laboriosam debitis iste reiciendis beatae ut vel perspiciatis quisquam aperiam similique, assumenda molestiae maiores cupiditate! Tempore repellat minima facere repellendus distinctio soluta aut magni velit nostrum nisi assumenda, quaerat quisquam officia nihil voluptatum, culpa, illo dolore obcaecati quos dolores esse blanditiis voluptatem nam! Voluptates unde eius consequuntur, est dicta ullam iste commodi temporibus! Consequuntur, numquam. Tempora, culpa repudiandae ipsa earum magnam animi. Enim facere commodi harum ipsam quos fugit earum amet temporibus voluptas voluptatibus, tenetur ducimus, alias, nam saepe hic id pariatur labore veritatis maiores optio ipsa aliquam consectetur porro est. Aut iusto atque labore! Fugit alias eligendi eveniet omnis nesciunt dolorum mollitia aut at ducimus, aliquid delectus minima non officiis natus sed repellat aliquam pariatur voluptatum cupiditate incidunt ad et dignissimos. Reprehenderit, corporis veritatis fugit ab alias perferendis repellat aspernatur ea dolorem ratione officiis. Molestiae veniam assumenda tenetur non voluptatum iste magni nemo!',
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
