<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        User::truncate();
        $records = [
            [
                'id'                    => '1',
                'name'                  => 'Webmaster',
                'nickname'              => 'webmaster_01',
                'email'                 => 'webmaster@localhost.com',
                'email_verified_at'     => '2021-10-01 00:00:00',
                'password'              => bcrypt('123@UserWebmaster'),
            ],
        ];
        User::insert($records);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
