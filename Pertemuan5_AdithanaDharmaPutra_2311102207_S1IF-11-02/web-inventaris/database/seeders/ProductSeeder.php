<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::truncate();
        
        $products = [
            [
                'name' => 'Indomie Mi Goreng Spesial',
                'description' => 'Mi instan goreng legendaris dengan bumbu spesial yang nikmat.',
                'price' => 3500,
                'stock' => 100,
            ],
            [
                'name' => 'Indomie Rasa Ayam Bawang',
                'description' => 'Mi instan kuah dengan cita rasa ayam bawang yang gurih dan klasik.',
                'price' => 3200,
                'stock' => 85,
            ],
            [
                'name' => 'Indomie Rasa Kari Ayam',
                'description' => 'Mi instan kuah dengan bumbu kari yang kental dan kaya rempah.',
                'price' => 3300,
                'stock' => 70,
            ],
            [
                'name' => 'Mie Sedaap Goreng',
                'description' => 'Mi goreng dengan tambahan bawang goreng kriuk yang melimpah.',
                'price' => 3400,
                'stock' => 95,
            ],
            [
                'name' => 'Mie Sedaap Soto Madura',
                'description' => 'Mi kuah dengan rasa soto Madura yang autentik dan segar.',
                'price' => 3200,
                'stock' => 60,
            ],
            [
                'name' => 'Sarimi Gelas Rasa Baso Sapi',
                'description' => 'Mi instan praktis dalam kemasan gelas, cocok untuk camilan cepat.',
                'price' => 2500,
                'stock' => 50,
            ],
            [
                'name' => 'Supermi Rasa Ayam Spesial',
                'description' => 'Mi instan kuah legendaris Indonesia dengan rasa ayam yang gurih.',
                'price' => 3100,
                'stock' => 40,
            ],
            [
                'name' => 'Lemonilo Mie Goreng',
                'description' => 'Mie instan sehat tanpa proses penggorengan dan tanpa pengawet.',
                'price' => 8500,
                'stock' => 30,
            ],
            [
                'name' => 'Pop Mie Rasa Baso',
                'description' => 'Mi instan cup praktis dengan rasa baso sapi yang populer.',
                'price' => 5500,
                'stock' => 120,
            ],
            [
                'name' => 'Mi ABC Selera Pedas Gulai Ayam',
                'description' => 'Mi instan kuah dengan rasa gulai ayam yang pedas menantang.',
                'price' => 3000,
                'stock' => 45,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
