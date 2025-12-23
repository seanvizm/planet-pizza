<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pizza;

class PizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pizzas = [
            [
                'pizza_name' => 'Margherita',
                'pizza_description' => 'Classic pizza with tomato sauce, mozzarella, and basil',
                'price' => 10.00,
                'type' => 'preset',
                'default_toppings' => json_encode([]),
                'image' => 'pizza-1.jpg'
            ],
            [
                'pizza_name' => 'Romana',
                'pizza_description' => 'Delicious pizza with ham, olives, and mushrooms',
                'price' => 13.00,
                'type' => 'preset',
                'default_toppings' => json_encode(['ham', 'olives', 'mushrooms']),
                'image' => 'pizza-2.jpg'
            ],
            [
                'pizza_name' => 'Americana',
                'pizza_description' => 'Hearty pizza with bacon, mince, and pepperoni',
                'price' => 13.00,
                'type' => 'preset',
                'default_toppings' => json_encode(['bacon', 'mince', 'pepperoni']),
                'image' => 'pizza-3.jpg'
            ],
            [
                'pizza_name' => 'Mexicana',
                'pizza_description' => 'Spicy pizza with spicy mince, onion, green pepper, and jalapenos',
                'price' => 15.00,
                'type' => 'preset',
                'default_toppings' => json_encode(['spicy mince', 'onion', 'green pepper', 'jalapenos']),
                'image' => 'pizza-4.jpg'
            ],
            [
                'pizza_name' => 'Make Your Own',
                'pizza_description' => 'Create your custom pizza with up to 4 toppings of your choice (£10 + £1 per topping)',
                'price' => 10.00,
                'type' => 'custom',
                'default_toppings' => json_encode([]),
                'image' => 'pizza-5.jpg'
            ],
        ];

        foreach ($pizzas as $pizza) {
            Pizza::create($pizza);
        }
    }
}
