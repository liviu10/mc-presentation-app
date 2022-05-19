<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AcceptedDomainSeeder::class,
            BlogArticlesSeeder::class,
            BlogCategoriesSeeder::class,
            BlogSubcategoriesSeeder::class,
            ErrorAndNotificationSystemSeeder::class,
            NewsletterCampaignSeeder::class,
            NewsletterKpiSeeder::class,
            QuestionnaireSeeder::class,
            UserRoleTypeSeeder::class,
            UserSeeder::class,
        ]);
    }
}
