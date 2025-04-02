<?php

namespace Database\Seeders;

use App\Models\Medicine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Medicine::insert([
            [
                'name' => 'Paracetamol',
                'dosage' => '500mg',
                'unit' => 'Viên',
                'instructions' => 'Uống 1 viên/lần, ngày 3 lần sau ăn',
                'price' => 10000,
                'stock' => 500,
                'status' => 'Còn hàng',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Amoxicillin',
                'dosage' => '250mg',
                'unit' => 'Viên',
                'instructions' => 'Uống 1 viên/lần, ngày 2 lần sau ăn',
                'price' => 15000,
                'stock' => 300,
                'status' => 'Còn hàng',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);//
    }
}
