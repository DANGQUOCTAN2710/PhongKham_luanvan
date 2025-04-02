<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClinicalTestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $clinicalTests = [
            ['code' => 'HH1', 'category' => 'Thường quy', 'name' => 'Công thức máu, CBC', 'price' => 150000],
            ['code' => 'SH14', 'category' => 'Chức năng gan', 'name' => 'Bilirubin(T/D/I)', 'price' => 170000],
            ['code' => 'SH10', 'category' => 'Chức năng gan', 'name' => 'AST', 'price' => 200000],
            ['code' => 'SH11', 'category' => 'Chức năng gan', 'name' => 'ALT', 'price' => 150000],
            ['code' => 'SH12', 'category' => 'Chức năng gan', 'name' => 'ALT', 'price' => 140000],
            ['code' => '294', 'category' => 'Tiêu hóa', 'name' => 'Test H.Pylori', 'price' => 150000],
            ['code' => 'SH4', 'category' => 'Chức năng thận', 'name' => 'Urea/BUN', 'price' => 120000],
            ['code' => 'SH5', 'category' => 'Chức năng thận', 'name' => 'Creatinine', 'price' => 150000],
            ['code' => 'SH7', 'category' => 'Chức năng thận', 'name' => 'Uric acid', 'price' => 200000],
            ['code' => 'SH8', 'category' => 'Chức năng thận', 'name' => 'Ion đồ', 'price' => 200000],
            ['code' => 'SH34', 'category' => 'Chức năng thận', 'name' => 'TPT nước tiểu', 'price' => 100000],
            ['code' => 'MD6', 'category' => 'Viêm gan siêu vi(A,B,C,D,E)', 'name' => 'HBsAG', 'price' => 80000],
            ['code' => 'MD3', 'category' => 'Viêm gan siêu vi(A,B,C,D,E)', 'name' => 'Anti HBs', 'price' => 250000],
            ['code' => 'MD4', 'category' => 'Viêm gan siêu vi(A,B,C,D,E)', 'name' => 'HBeAg', 'price' => 100000],
            ['code' => 'MD5', 'category' => 'Viêm gan siêu vi(A,B,C,D,E)', 'name' => 'Anti HBe', 'price' => 100000],
            ['code' => 'MD9', 'category' => 'Viêm gan siêu vi(A,B,C,D,E)', 'name' => 'Anti HCV', 'price' => 100000],
            ['code' => 'MD12', 'category' => 'Chức năng tuyến giáp', 'name' => 'T3', 'price' => 100000],
            ['code' => 'MD16', 'category' => 'Chức năng tuyến giáp', 'name' => 'Free T3', 'price' => 100000],
            ['code' => 'MD13', 'category' => 'Chức năng tuyến giáp', 'name' => 'T4', 'price' => 100000],

        ];

        foreach ($clinicalTests as $test) {
            DB::table('clinical_tests')->insert([
                'code' => $test['code'],
                'category' => $test['category'],
                'name' => $test['name'],
                'price' => $test['price'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
