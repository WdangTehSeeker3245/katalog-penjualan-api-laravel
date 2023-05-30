<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'nama' => 'Yakult',
            'id_kategori' => '2',
            'harga' => '5000',
            'deskripsi' => 'Minuman untuk menjaga kesehatan usus',
        ]);
    }
}
