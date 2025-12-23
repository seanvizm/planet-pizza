<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\PizzaPriceCalculator;
use App\Repositories\PizzaRepository;
use App\Repositories\ToppingRepository;
use App\Models\Pizza;
use App\Models\Topping;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PizzaPriceCalculatorTest extends TestCase
{
    use RefreshDatabase;

    private PizzaPriceCalculator $calculator;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->calculator = new PizzaPriceCalculator(
            new ToppingRepository(),
            new PizzaRepository()
        );

        // Seed test data
        $this->seed(\Database\Seeders\ToppingSeeder::class);
        $this->seed(\Database\Seeders\PizzaSeeder::class);
    }

    /**
     * Test preset pizza price calculation
     */
    public function test_calculates_preset_pizza_price_correctly(): void
    {
        $margherita = Pizza::where('pizza_name', 'Margherita')->first();
        
        $price = $this->calculator->calculate($margherita->id);
        
        $this->assertEquals(10.00, $price);
    }

    /**
     * Test custom pizza with no toppings
     */
    public function test_calculates_custom_pizza_with_no_toppings(): void
    {
        $custom = Pizza::where('type', 'custom')->first();
        
        $price = $this->calculator->calculate($custom->id, []);
        
        $this->assertEquals(10.00, $price);
    }

    /**
     * Test custom pizza with toppings
     */
    public function test_calculates_custom_pizza_with_toppings(): void
    {
        $custom = Pizza::where('type', 'custom')->first();
        $toppings = Topping::limit(3)->pluck('id')->toArray();
        
        $price = $this->calculator->calculate($custom->id, $toppings);
        
        // Base £10 + 3 toppings at £1 each = £13
        $this->assertEquals(13.00, $price);
    }

    /**
     * Test maximum toppings limit
     */
    public function test_throws_exception_for_more_than_four_toppings(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Maximum 4 toppings allowed');
        
        $custom = Pizza::where('type', 'custom')->first();
        $toppings = Topping::limit(5)->pluck('id')->toArray();
        
        $this->calculator->calculate($custom->id, $toppings);
    }

    /**
     * Test cart total calculation
     */
    public function test_calculates_cart_total_correctly(): void
    {
        $cartItems = [
            '1' => ['price' => 10.00, 'quantity' => 2],
            '2' => ['price' => 13.00, 'quantity' => 1],
        ];

        $total = $this->calculator->calculateCartTotal($cartItems);
        
        // (10 * 2) + (13 * 1) = 33
        $this->assertEquals(33.00, $total);
    }

    /**
     * Test cart breakdown
     */
    public function test_gets_cart_breakdown_with_details(): void
    {
        $cartItems = [
            '1' => ['name' => 'Margherita', 'price' => 10.00, 'quantity' => 1],
            '2' => ['name' => 'Romana', 'price' => 13.00, 'quantity' => 2],
        ];

        $breakdown = $this->calculator->getCartBreakdown($cartItems);
        
        $this->assertArrayHasKey('items', $breakdown);
        $this->assertArrayHasKey('subtotal', $breakdown);
        $this->assertArrayHasKey('total', $breakdown);
        $this->assertEquals(36.00, $breakdown['total']);
    }

    /**
     * Test invalid pizza ID
     */
    public function test_throws_exception_for_invalid_pizza_id(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Pizza with ID 999 not found');
        
        $this->calculator->calculate(999, []);
    }
}

