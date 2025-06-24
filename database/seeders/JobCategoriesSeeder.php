<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Real Estate',
            'Sales',
            'Retail',
            'Software & IT',
            'Customer Service',
            'Accounting & Finance',
            'Engineering',
            'Healthcare',
            'Human Resources',
            'Marketing',
            'Media & Design',
            'Education & Training',
            'Logistics & Supply Chain',
            'Legal',
            'Manufacturing',
            'Project Management',
            'Operations',
            'Business Development',
            'Research & Development',
            'Security & Safety',
            'Skilled Trades',
            'Telecommunications',
            'Writing & Translation',
            'Hospitality & Tourism',
            'Other',
        ];

        foreach($categories as $name){
            DB::table('job_categories')->updateOrInsert(
                ['name' => $name],
                ['created_at' => now(), 'updated_at'=> now()]
            );
        }

    }
}
