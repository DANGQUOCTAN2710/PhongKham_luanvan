<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiagnosticImagingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['code' => 'XR001', 'name' => 'X-Quang phổi', 'price' => 500000],
            ['code' => 'XR002', 'name' => 'X-Quang sọ', 'price' => 450000],
            ['code' => 'XR003', 'name' => 'X-Quang cổ', 'price' => 400000],
            ['code' => 'XR004', 'name' => 'X-Quang bụng', 'price' => 550000],
            ['code' => 'CT001', 'name' => 'CT - Bụng', 'price' => 1500000],
            ['code' => 'CT002', 'name' => 'CT - Não', 'price' => 1800000],
            ['code' => 'CT003', 'name' => 'CT - Ngực', 'price' => 1600000],
            ['code' => 'MRI001', 'name' => 'MRI - Bụng', 'price' => 2500000],
            ['code' => 'MRI002', 'name' => 'MRI - Não', 'price' => 2700000],
        ];

        DB::table('diagnostic_imagings')->insert($data);
    }
}
