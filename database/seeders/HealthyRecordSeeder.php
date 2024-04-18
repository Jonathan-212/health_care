<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class HealthyRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('healthy_records')->insert([
            'patient_id' => '1',
            'heart_rate' => '75',
            'sistole_blood_pressure' => '110',
            'diastole_blood_pressure' => '90',
            'created_at' => '2024-04-16',
        ]);
        DB::table('healthy_records')->insert([
            'patient_id' => '1',
            'heart_rate' => '70',
            'sistole_blood_pressure' => '120',
            'diastole_blood_pressure' => '90',
            'created_at' => '2024-04-17',
        ]);
        DB::table('healthy_records')->insert([
            'patient_id' => '1',
            'heart_rate' => '80',
            'sistole_blood_pressure' => '128',
            'diastole_blood_pressure' => '93',
            'created_at' => '2024-04-18',
        ]);
        DB::table('healthy_records')->insert([
            'patient_id' => '1',
            'heart_rate' => '83',
            'sistole_blood_pressure' => '140',
            'diastole_blood_pressure' => '100',
            'created_at' => '2024-04-19',
        ]);
        DB::table('healthy_records')->insert([
            'patient_id' => '1',
            'heart_rate' => '75',
            'sistole_blood_pressure' => '130',
            'diastole_blood_pressure' => '90',
            'created_at' => '2024-04-20',
        ]);
    }
}
