<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Experience>
 */
class ExperienceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $isCurrent = fake()->boolean(30); // 30% chance it's the current job
        $startDate = fake()->dateTimeBetween('-10 years', '-1 year');
        $endDate = $isCurrent ? null : fake()->dateTimeBetween($startDate, 'now');

    return [
        
        'user_id' => User::factory()->state(['role' => 'jobseeker']),
        'job_title' => fake()->jobTitle,
        'employeer' => fake()->company,
        'city' => fake()->city,
        'country' => fake()->country,
        'description' => fake()->sentence(10),
        'start_date' => $startDate->format('Y-m-d'),
        'end_date' => $endDate ? $endDate->format('Y-m-d') : null,
        'current_job' => $isCurrent ? 1 : 0,
    ];
    }
}
