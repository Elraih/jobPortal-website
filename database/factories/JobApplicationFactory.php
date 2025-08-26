<?php

namespace Database\Factories;

use App\Models\JobPost;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobApplication>
 */
class JobApplicationFactory extends Factory
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
            'job_post_id' => JobPost::factory(),
            'resume_path' => fake()->filePath(), // Or a static string like 'resumes/sample.pdf'
            'status' => fake()->randomElement(['pending', 'reviewed', 'in consideration', 'rejected']),

        ];
    }
}
