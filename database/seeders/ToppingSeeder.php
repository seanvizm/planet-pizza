<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Topping;

class ToppingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $toppings = [
            ['name' => 'ham', 'price' => 1.00],
            ['name' => 'olives', 'price' => 1.00],
            ['name' => 'mushrooms', 'price' => 1.00],
            ['name' => 'bacon', 'price' => 1.00],
            ['name' => 'mince', 'price' => 1.00],
            ['name' => 'pepperoni', 'price' => 1.00],
            ['name' => 'spicy mince', 'price' => 1.00],
            ['name' => 'onion', 'price' => 1.00],
            ['name' => 'green pepper', 'price' => 1.00],
            ['name' => 'jalapenos', 'price' => 1.00],
            ['name' => 'extra cheese', 'price' => 1.00],
            ['name' => 'pineapple', 'price' => 1.00],
        ];

        foreach ($toppings as $topping) {
            Topping::create($topping);
        }
    }
}
