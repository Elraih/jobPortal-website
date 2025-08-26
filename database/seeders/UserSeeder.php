<?php

namespace Database\Seeders;

use App\Enums\UserRoles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            DB::table('users')->updateOrInsert(
        ['email' => 'company2@company.com'],
        [
            'email_verified_at' => now(),
            'password' => Hash::make('company2'),
            'role' => UserRoles::Company,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->updateOrInsert(
            ['email' => 'company@company.com'],
            [
                'email_verified_at' => now(),
                'password' => Hash::make('company'),
                'role' => UserRoles::Company,
                'created_at' => now(),
                'updated_at' => now()
            ]);


        DB::table('users')->updateOrInsert(
            ['email' => 'admin@admin.com'],
            [
                'email_verified_at' => now(),
                'password' => Hash::make('admin'),
                'role' => UserRoles::Admin,
                'created_at' => now(),
                'updated_at' => now()
            ]);
    }
}
