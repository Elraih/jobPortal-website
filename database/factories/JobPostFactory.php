<?php

namespace Database\Factories;

use App\Models\Governorate;
use App\Models\JobCategory;
use App\Models\JobType;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobPost>
 */
class JobPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         $title = fake()->sentence;
        return [
            'user_id' => User::where('role', 'company')->inRandomOrder()->value('id'),
        'job_category_id' => JobCategory::inRandomOrder()->value('id'),
        'job_type_id' => JobType::inRandomOrder()->value('id'),
        'governorate_id' => Governorate::inRandomOrder()->value('id'),
        'title' => $title,
        'slug' => Str::slug($title) . '-' . Str::uuid(),
        'requirements' => fake()->paragraphs(3, true),
        'description' => fake()->paragraphs(4, true),
        'skills' => json_encode(fake()->randomElements([
            'Laravel', 'Vue.js', 'Tailwind CSS', 'PHP', 'Docker', 'MySQL', 'Redis', 'Git'
        ], 3)),
        'salary' => fake()->optional()->numberBetween(1000, 10000),
        'application_deadline' => fake()->optional()->dateTimeBetween('now', '+3 months')->format('Y-m-d'),
        'status' => fake()->randomElement(['open', 'closed', 'draft']),
        ];
    }
}
