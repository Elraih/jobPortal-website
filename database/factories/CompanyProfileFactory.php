<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyProfile>
 */
class CompanyProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::where('role', 'company')->inRandomOrder()->value('id'), // Create new user or pass manually later
            'name' => fake()->company,
            'about_us' => fake()->paragraph,
            'industry' => fake()->randomElement(['Technology', 'Finance', 'Healthcare', 'Education', 'Retail']),
            'company_size' => fake()->randomElement(['0-50', '51-100', '101-500', '501-1500', '+1500']),
            'logo' => fake()->imageUrl(200, 200, 'business', true, 'logo'),

        ];
    }
}
