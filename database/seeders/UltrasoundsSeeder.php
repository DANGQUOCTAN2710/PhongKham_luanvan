<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UltrasoundsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ultrasounds')->insert([
            [
                'code' => 'US001',
                'name' => 'Siêu âm tổng quát',
                'price' => 500000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'US002',
                'name' => 'Siêu âm tim',
                'price' => 700000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'US003',
                'name' => 'Siêu âm mạch máu',
                'price' => 600000,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
