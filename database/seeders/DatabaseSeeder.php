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
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            ErrorAndNotificationSystemSeeder::class,
            BlogCategoriesSeeder::class,
            BlogSubcategoriesSeeder::class,
            BlogArticlesSeeder::class,
            BlogArticleCommentsSeeder::class,
            BlogArticleCommentRepliesSeeder::class,
            QuestionnaireSeeder::class,
            // QuestionnaireQuestionTypeSeeder::class,
            QuestionnaireQuestionSeeder::class,
            QuestionnaireMediaTypeSeeder::class,
            QuestionnaireAnswerSeeder::class,
            NewsletterCampaignSeeder::class
        ]);
    }
}
