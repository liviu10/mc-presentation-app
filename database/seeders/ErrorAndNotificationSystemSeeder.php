<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ErrorAndNotificationSystem;
use Illuminate\Support\Facades\DB;

class ErrorAndNotificationSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ErrorAndNotificationSystem::truncate();
        $records = [
            [
                'id'                       => '1',
                'notify_code'              => 'INFO_0001',
                'notify_short_description' => 'The table you are looking for is empty!',
                'notify_reference'         => '!!! Insert documentation link here !!!',
                'created_at'               => '2021-09-26 00:00:00',
                'updated_at'               => '2021-09-26 00:00:00',
            ],
            [
                'id'                       => '2',
                'notify_code'              => 'INFO_0002',
                'notify_short_description' => 'The record(s) was(were) successfully fetched from the database!',
                'notify_reference'         => '!!! Insert documentation link here !!!',
                'created_at'               => '2021-09-26 00:00:00',
                'updated_at'               => '2021-09-26 00:00:00',
            ],
            [
                'id'                       => '3',
                'notify_code'              => 'INFO_0003',
                'notify_short_description' => 'The record(s) was (were) successfully inserted in the database!',
                'notify_reference'         => '!!! Insert documentation link here !!!',
                'created_at'               => '2021-09-26 00:00:00',
                'updated_at'               => '2021-09-26 00:00:00',
            ],
            [
                'id'                       => '4',
                'notify_code'              => 'INFO_0004',
                'notify_short_description' => 'The record(s) you are looking for does not exist in the database!',
                'notify_reference'         => '!!! Insert documentation link here !!!',
                'created_at'               => '2021-09-26 00:00:00',
                'updated_at'               => '2021-09-26 00:00:00',
            ],
            [
                'id'                       => '5',
                'notify_code'              => 'INFO_0005',
                'notify_short_description' => 'The record(s) you are trying to delete does not exist in the database!',
                'notify_reference'         => '!!! Insert documentation link here !!!',
                'created_at'               => '2021-09-26 00:00:00',
                'updated_at'               => '2021-09-26 00:00:00',
            ],
            [
                'id'                       => '6',
                'notify_code'              => 'INFO_0006',
                'notify_short_description' => 'The record(s) you have selected was (were) successfully deleted from the database!',
                'notify_reference'         => '!!! Insert documentation link here !!!',
                'created_at'               => '2021-09-26 00:00:00',
                'updated_at'               => '2021-09-26 00:00:00',
            ],
            [
                'id'                       => '7',
                'notify_code'              => 'INFO_0007',
                'notify_short_description' => 'The records were successfully deleted from the database!',
                'notify_reference'         => '!!! Insert documentation link here !!!',
                'created_at'               => '2021-09-26 00:00:00',
                'updated_at'               => '2021-09-26 00:00:00',
            ],
            [
                'id'                       => '8',
                'notify_code'              => 'ERR_0001',
                'notify_short_description' => 'The table you are looking for does not exist in the database!',
                'notify_reference'         => '!!! Insert documentation link here !!!',
                'created_at'               => '2021-09-26 00:00:00',
                'updated_at'               => '2021-09-26 00:00:00',
            ],
            [
                'id'                       => '9',
                'notify_code'              => 'ERR_0002',
                'notify_short_description' => 'One or more column(s) is (are) missing from the table!',
                'notify_reference'         => '!!! Insert documentation link here !!!',
                'created_at'               => '2021-09-26 00:00:00',
                'updated_at'               => '2021-09-26 00:00:00',
            ],
            [
                'id'                       => '10',
                'notify_code'              => 'ERR_0003',
                'notify_short_description' => 'Integrity constraint violation! The record(s) already exists in the database!',
                'notify_reference'         => '!!! Insert documentation link here !!!',
                'created_at'               => '2021-09-26 00:00:00',
                'updated_at'               => '2021-09-26 00:00:00',
            ],
        ];
        ErrorAndNotificationSystem::insert($records);
    }
}