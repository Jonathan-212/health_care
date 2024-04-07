<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            'name' => 'Jonathan Gandha',
            'email' => 'frevia212@gmail.com',
            'password' => bcrypt('jonathan123'),
            'date_of_birth' => '2004-05-12',
            'height' => 170,
            'weight' => 60,
            'phone' => '0812345678',
        ]);

        DB::table('users')->insert([
            'name' => 'Nathanael',
            'email' => 'nathanael@gmail.com',
            'password' => bcrypt('nathanael123'),
            'date_of_birth' => '2004-05-12',
            'height' => 175,
            'weight' => 55,
            'phone' => '0812345678',
            'role' => 'doctor',
        ]);
    }
}
