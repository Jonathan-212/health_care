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
            'name' => 'Kenzo Gandha',
            'email' => 'kenzo@gmail.com',
            'password' => bcrypt('kenzo123'),
            'date_of_birth' => '2004-05-12',
            'height' => 170,
            'weight' => 60,
            'phone' => '0812345678',
        ]);

        // Bedah, THT, Gizi, Akupuntur, Jantung, Gigi
        DB::table('users')->insert([
            'name' => 'Dr. Natanael, Sp.B',
            'email' => 'nathanael@gmail.com',
            'password' => bcrypt('nathanael123'),
            'date_of_birth' => '2004-05-12',
            'height' => 175,
            'weight' => 55,
            'phone' => '0812345678',
            'role' => 'doctor',
            'specialist' => 'Bedah',
        ]);
        DB::table('users')->insert([
            'name' => 'Dr. Mario, Sp.THT',
            'email' => 'mario@gmail.com',
            'password' => bcrypt('mariol123'),
            'date_of_birth' => '2004-05-12',
            'height' => 175,
            'weight' => 55,
            'phone' => '0812345678',
            'role' => 'doctor',
            'specialist' => 'THT',
        ]);
        DB::table('users')->insert([
            'name' => 'Dr. Feronika, Sp.GK',
            'email' => 'feronika@gmail.com',
            'password' => bcrypt('feronikal123'),
            'date_of_birth' => '2004-05-12',
            'height' => 175,
            'weight' => 55,
            'phone' => '0812345678',
            'role' => 'doctor',
            'specialist' => 'Gizi',
        ]);
        DB::table('users')->insert([
            'name' => 'Dr. Devon Wijaya, Sp.Ak',
            'email' => 'devon@gmail.com',
            'password' => bcrypt('devon123'),
            'date_of_birth' => '2004-05-12',
            'height' => 175,
            'weight' => 55,
            'phone' => '0812345678',
            'role' => 'doctor',
            'specialist' => 'Akupuntur',
        ]);
        DB::table('users')->insert([
            'name' => 'Dr. Rizky Muhammad, Sp.JP',
            'email' => 'rizky@gmail.com',
            'password' => bcrypt('rizkyl123'),
            'date_of_birth' => '2004-05-12',
            'height' => 175,
            'weight' => 55,
            'phone' => '0812345678',
            'role' => 'doctor',
            'specialist' => 'Jantung',
        ]);
        DB::table('users')->insert([
            'name' => 'Dr. Amelia, Sp.THT',
            'email' => 'amelia@gmail.com',
            'password' => bcrypt('amelia123'),
            'date_of_birth' => '2004-05-12',
            'height' => 175,
            'weight' => 55,
            'phone' => '0812345678',
            'role' => 'doctor',
            'specialist' => 'THT',
        ]);
        DB::table('users')->insert([
            'name' => 'Dr. Robiyanto, Sp.KG',
            'email' => 'robiyano@gmail.com',
            'password' => bcrypt('robiyanto123'),
            'date_of_birth' => '2004-05-12',
            'height' => 175,
            'weight' => 55,
            'phone' => '0812345678',
            'role' => 'doctor',
            'specialist' => 'Gigi',
        ]);
        DB::table('users')->insert([
            'name' => 'Dr. Richard, Sp.THT',
            'email' => 'richard@gmail.com',
            'password' => bcrypt('richard123'),
            'date_of_birth' => '2004-05-12',
            'height' => 175,
            'weight' => 55,
            'phone' => '0812345678',
            'role' => 'doctor',
            'specialist' => 'THT',
        ]);
        DB::table('users')->insert([
            'name' => 'Dr. Sean Martin, Sp.KG',
            'email' => 'sean@gmail.com',
            'password' => bcrypt('sean123'),
            'date_of_birth' => '2004-05-12',
            'height' => 175,
            'weight' => 55,
            'phone' => '0812345678',
            'role' => 'doctor',
            'specialist' => 'Gigi',
        ]);
        DB::table('users')->insert([
            'name' => 'Dr. Albert William, Sp.JP',
            'email' => 'albert@gmail.com',
            'password' => bcrypt('albert123'),
            'date_of_birth' => '2004-05-12',
            'height' => 175,
            'weight' => 55,
            'phone' => '0812345678',
            'role' => 'doctor',
            'specialist' => 'Jantung',
        ]);
    }
}
