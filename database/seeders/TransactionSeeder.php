<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    \App\Models\Transaction::create([
        'user_id' => 1,
        'category_id' => 1, // Gaji (dari seeder sebelumnya)
        'amount' => 5000000,
        'description' => 'Gaji Bulan Januari',
        'date' => now()->format('Y-m-d'),
    ]);

    \App\Models\Transaction::create([
        'user_id' => 1,
        'category_id' => 2, // Makanan
        'amount' => 50000,
        'description' => 'Makan Siang Nasi Padang',
        'date' => now()->format('Y-m-d'),
    ]);
}
}
