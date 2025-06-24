<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobTypes = [
            'Full Time', 
            'Part Time', 
            'Intership', 
            'Temporary', 
            'Freelance'
        ];

        foreach($jobTypes as $type){
            DB::table('job_types')->updateOrInsert(
                ['job_type' => $type],
                ['created_at' => now(), 'updated_at'=> now()]
            );
        }
    }
}
