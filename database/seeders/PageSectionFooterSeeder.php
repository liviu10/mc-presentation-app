<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\PageSectionFooter;

class PageSectionFooterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        PageSectionFooter::truncate();
        $records = [
            [
                'id'                       => '1',
                'page_section_id'          => '5',
                'label_for_menu_1'         => 'Termeni și Condiții',
                'link_for_menu_1'          => config('app.url') . '/terms-and-conditions',
                'label_for_menu_2'         => 'Dezabonează-te de la newsletter',
                'link_for_menu_2'          => '',
                'contact_email_address'    => config('app.contact_email'),
                'label_for_social_media'   => 'Urmărește-mă pe: ',
                'link_to_social_media_1'   => 'https://www.facebook.com/groups/269560668238590/?ref=share',
                'label_for_social_media_1' => 'Urmărește-mă pe Facebook!',
                'link_to_social_media_2'   => 'https://www.youtube.com/channel/UCvyAUdyF4qG1j6S8IX67W5A/featured',
                'label_for_social_media_2' => 'Urmărește-mă pe Youtube!',
                'copyright_caption'        => 'Copyright &#169; ' . config('app.owner_name') . ' Toate drepturile rezervate',
                'copyright_caption_url'    => config('app.url'),
            ],
        ];
        PageSectionFooter::insert($records);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}