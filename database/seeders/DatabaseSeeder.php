<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Imran Haq Bahu',
            'email' => 'imran@gmail.com',
            'password' => Hash::make('password'),
            'myAccount' => 50000,
        ]);
        Category::create([
            'name' => 'Cotton'
        ]);
        Supplier::create([
            'name' => 'Bismillah Cloth House',
            'balance' => 10000,
        ]);
    }
}
