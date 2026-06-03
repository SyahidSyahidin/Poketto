<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    \App\Models\Product::insert([
        [
            'name'      => 'Produk A',
            'sku'       => 'SKU-001',
            'price'     => 50000,
            'stock'     => 100,
            'is_active' => true,
            'created_at'=> now(),
            'updated_at'=> now(),
        ],
        [
            'name'      => 'Produk B',
            'sku'       => 'SKU-002',
            'price'     => 75000,
            'stock'     => 50,
            'is_active' => true,
            'created_at'=> now(),
            'updated_at'=> now(),
        ],
    ]);
}
}
