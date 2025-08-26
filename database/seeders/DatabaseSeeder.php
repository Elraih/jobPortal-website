<?php

namespace Database\Seeders;

use App\Models\CompanyProfile;
use App\Models\ContactInfo;
use App\Models\Experience;
use App\Models\JobApplication;
use App\Models\JobPost;
use App\Models\Location;
use App\Models\User;
use App\Models\UserProfile;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            JobCategoriesSeeder::class,
            JobTypesSeeder::class,
            GovernoratesSeeder::class,
            UserSeeder::class,
        ]);
        // User::factory(10)->create();
        // User::factory()->count(20)->create();
        // UserProfile::factory()->count(10)->create();
        // CompanyProfile::factory()->count(10)->create();
        // ContactInfo::factory()->count(10)->create();
        // Experience::factory()->count(10)->create();
        // JobPost::factory()->count(10)->create();
        // Location::factory()->count(10)->create();
        // JobApplication::factory()->count(10)->create();
    }
}
