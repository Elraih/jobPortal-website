<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GovernoratesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $governorates = [
            "Cairo",
            "Alexandria",
            "Giza",
            "Qalyubia",
            "Sharqia",
            "Dakahlia",
            "Beheira",
            "Kafr El Sheikh",
            "Gharbia",
            "Monufia",
            "Faiyum",
            "Beni Suef",
            "Minya",
            "Assiut",
            "Sohag",
            "Qena",
            "Luxor",
            "Aswan",
            "Red Sea",
            "New Valley",
            "Matrouh",
            "North Sinai",
            "South Sinai",
            "Damietta",
            "Port Said",
            "Ismailia",
            "Suez"
          ];

          foreach($governorates as $governorate){
            DB::table('governorates')->updateOrInsert(
                ['name' => $governorate ],
                ['created_at' => now(), 'updated_at'=> now()]
            );
        }
          
    }
}
