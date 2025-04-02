<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('password123'),
            'gender' => 'Nam',
            'dob' => Carbon::createFromFormat('m/d/Y', '10/27/2003')->format('Y-m-d'), 
            'age' => '22'
        ]);
    }
}
