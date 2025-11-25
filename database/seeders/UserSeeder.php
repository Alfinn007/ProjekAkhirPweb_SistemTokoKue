<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Asepz Bengsin',
            'email' => 'asepzz@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Aguez Galon',
            'email' => 'aghoss@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        Category::create(['name' => 'Kue Kering']);
        Category::create(['name' => 'Bolu']);
        Category::create(['name' => 'Roti']);
    }
}
