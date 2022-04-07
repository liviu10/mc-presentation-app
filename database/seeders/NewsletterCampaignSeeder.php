<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\NewsletterCampaign;

class NewsletterCampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        NewsletterCampaign::truncate();
        $records = [
            [
                'id'                   => '1',
                'campaign_name'        => 'General newsletter campaign',
                'campaign_description' => 'This is a general newsletter campaign which will always be active. User will automatically subscribe to this campaign if no other newsletter campaign is active.',
                'campaign_is_active'   => '1',
                'valid_from'           => '2022-01-01 00:00:00',
                'valid_to'             => '2099-12-31 11:59:59',
                'occur_times'          => '',
                'occur_when'           => '',
                'occur_day'            => '',
                'occur_hour'           => '',
                'created_at'           => '2022-01-01 00:00:00',
                'updated_at'           => '2022-01-01 00:00:00',
            ],
            [
                'id'                   => '2',
                'campaign_name'        => 'First newsletter campaign',
                'campaign_description' => 'This is the first newsletter campaign which user can subscribe to.',
                'campaign_is_active'   => '1',
                'valid_from'           => '2022-01-01 00:00:00',
                'valid_to'             => '2022-12-31 11:59:59',
                'occur_times'          => '1',
                'occur_when'           => '2',
                'occur_day'            => '3',
                'occur_hour'           => '19:00',
                'created_at'           => '2022-01-01 00:00:00',
                'updated_at'           => '2022-01-01 00:00:00',
            ],
        ];
        NewsletterCampaign::insert($records);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
