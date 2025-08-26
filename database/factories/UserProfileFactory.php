<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProfile>
 */
class UserProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::where('role', 'job_seeker')->inRandomOrder()->value('id'),
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'gender' => fake()->randomElement(['male', 'femal']),
            'about_me' => fake()->paragraph,
            'date_of_birth' => fake()->date('Y-m-d', '-18 years'),
            'avatar' => fake()->imageUrl(300, 300, 'people', true, 'avatar'),
        ];
    }
}
