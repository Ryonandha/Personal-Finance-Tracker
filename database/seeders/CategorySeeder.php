<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $categories = [
        ['name' => 'Gaji', 'type' => 'income'],
        ['name' => 'Makanan', 'type' => 'expense'],
        ['name' => 'Transportasi', 'type' => 'expense'],
        ['name' => 'Hiburan', 'type' => 'expense'],
    ];

    foreach ($categories as $category) {
        \App\Models\Category::create($category);
    }
}
}
