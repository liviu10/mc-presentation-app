<?php

namespace Database\Factories;

use App\Models\NewsletterSubscriber;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsletterSubscriberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NewsletterSubscriber::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'newsletter_campaign_id' => 2,
            'full_name'              => $this->faker->name,
            'email'                  => $this->faker->unique()->safeEmail,
            'privacy_policy'         => 1,
            'created_at'             => now(),
        ];
    }
}
