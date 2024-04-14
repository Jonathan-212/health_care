<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('payments')->insert([
            'name' => 'BCA Virtual Account',
            'number' => '0182301231232',
        ]);
        DB::table('payments')->insert([
            'name' => 'BCA Transfer',
            'number' => '601423143',
        ]);
        DB::table('payments')->insert([
            'name' => 'Mandiri Transfer',
            'number' => '8123921831',
        ]);
        DB::table('payments')->insert([
            'name' => 'Ovo',
            'number' => '008808123123213',
        ]);
        DB::table('payments')->insert([
            'name' => 'Gopay',
            'number' => '0123108123123213',
        ]);
    }
}
