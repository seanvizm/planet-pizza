<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Order;
use App\Models\Pizza;

class OrderFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test checkout page displays successfully
     */
    public function test_checkout_page_displays_successfully(): void
    {
        // Add items to cart
        session(['cart' => [
            1 => [
                'name' => 'Margherita',
                'quantity' => 2,
                'price' => 10.00,
                'image' => 'margherita.jpg',
                'toppings' => []
            ]
        ]]);

        $response = $this->get('/checkout');

        $response->assertStatus(200);
        $response->assertSee('Billing address');
        $response->assertSee('Payment');
        $response->assertSee('Your cart');
    }

    /**
     * Test mock PayPal payment order creation
     */
    public function test_creates_order_with_mock_paypal_payment(): void
    {
        $cartItems = [
            '1' => [
                'name' => 'Margherita',
                'quantity' => 2,
                'price' => 10.00,
                'image' => 'margherita.jpg',
                'toppings' => []
            ]
        ];

        session(['cart' => $cartItems]);

        $orderData = [
            'payment_method' => 'paypal',
            'transaction_id' => 'MOCK_PAYPAL_' . time(),
            'payment_status' => 'COMPLETED',
            'cart_items' => $cartItems,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'contact_no' => '+44 7700 900123',
            'city' => 'London',
            'state' => 'England',
            'zip' => 'SW1A 1AA',
            'address' => '10 Downing Street',
            'amount' => '20.00'
        ];

        $response = $this->postJson('/paypal-order', $orderData);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Order placed successfully'
        ]);

        // Verify order was created in database
        $this->assertDatabaseHas('orders', [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'payment_method' => 'paypal',
            'payment_status' => 'COMPLETED',
            'total_price' => '20.00'
        ]);

        // Verify cart is cleared
        $this->assertEmpty(session('cart'));
    }

    /**
     * Test mock card payment order creation
     */
    public function test_creates_order_with_mock_card_payment(): void
    {
        $cartItems = [
            '2' => [
                'name' => 'Pepperoni',
                'quantity' => 1,
                'price' => 12.00,
                'image' => 'pepperoni.jpg',
                'toppings' => []
            ]
        ];

        session(['cart' => $cartItems]);

        $orderData = [
            'payment_method' => 'card',
            'transaction_id' => 'MOCK_CARD_' . time(),
            'payment_status' => 'COMPLETED',
            'cart_items' => $cartItems,
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'jane.smith@example.com',
            'contact_no' => '+44 7700 900456',
            'city' => 'Manchester',
            'state' => 'England',
            'zip' => 'M1 1AA',
            'address' => '123 Main Street',
            'amount' => '12.00'
        ];

        $response = $this->postJson('/paypal-order', $orderData);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Order placed successfully'
        ]);

        // Verify order was created in database
        $this->assertDatabaseHas('orders', [
            'name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'payment_method' => 'card',
            'payment_status' => 'COMPLETED',
            'total_price' => '12.00'
        ]);
    }

    /**
     * Test order requires all checkout fields
     */
    public function test_order_includes_all_checkout_fields(): void
    {
        $cartItems = [
            '1' => [
                'name' => 'Margherita',
                'quantity' => 1,
                'price' => 10.00,
                'image' => 'margherita.jpg',
                'toppings' => []
            ]
        ];

        $orderData = [
            'payment_method' => 'paypal',
            'transaction_id' => 'MOCK_PAYPAL_TEST',
            'payment_status' => 'COMPLETED',
            'cart_items' => $cartItems,
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'contact_no' => '+44 7700 900000',
            'city' => 'Birmingham',
            'state' => 'England',
            'zip' => 'B1 1AA',
            'address' => '456 Test Avenue',
            'amount' => '10.00'
        ];

        $response = $this->postJson('/paypal-order', $orderData);

        $response->assertStatus(200);

        // Verify all fields are stored
        $order = Order::where('email', 'test@example.com')->first();
        $this->assertNotNull($order);
        $this->assertEquals('Test User', $order->name);
        $this->assertEquals('test@example.com', $order->email);
        $this->assertEquals('+44 7700 900000', $order->contact_no);
        $this->assertEquals('Birmingham', $order->city);
        $this->assertEquals('England', $order->state);
        $this->assertEquals('B1 1AA', $order->zip);
        $this->assertEquals('456 Test Avenue', $order->address);
        $this->assertEquals('MOCK_PAYPAL_TEST', $order->ref);
        $this->assertEquals('paypal', $order->payment_method);
        $this->assertEquals('COMPLETED', $order->payment_status);
        $this->assertEquals('10.00', $order->total_price);
    }

    /**
     * Test order with custom pizza and toppings
     */
    public function test_creates_order_with_custom_pizza_and_toppings(): void
    {
        $cartItems = [
            '3_1_2' => [
                'name' => 'Custom Pizza (+ Pepperoni, Mushrooms)',
                'quantity' => 1,
                'price' => 12.00,
                'image' => 'custom.jpg',
                'toppings' => ['Pepperoni', 'Mushrooms']
            ]
        ];

        session(['cart' => $cartItems]);

        $orderData = [
            'payment_method' => 'card',
            'transaction_id' => 'MOCK_CARD_CUSTOM',
            'payment_status' => 'COMPLETED',
            'cart_items' => $cartItems,
            'first_name' => 'Custom',
            'last_name' => 'Order',
            'email' => 'custom@example.com',
            'contact_no' => '+44 7700 900789',
            'city' => 'Leeds',
            'state' => 'England',
            'zip' => 'LS1 1AA',
            'address' => '789 Custom Road',
            'amount' => '12.00'
        ];

        $response = $this->postJson('/paypal-order', $orderData);

        $response->assertStatus(200);

        // Verify custom pizza order with toppings
        $order = Order::where('email', 'custom@example.com')->first();
        $this->assertNotNull($order);
        $cartData = is_array($order->cart_items) ? $order->cart_items : json_decode($order->cart_items, true);
        $this->assertIsArray($cartData);
        $this->assertArrayHasKey('3_1_2', $cartData);
        $this->assertEquals('Custom Pizza (+ Pepperoni, Mushrooms)', $cartData['3_1_2']['name']);
        $this->assertCount(2, $cartData['3_1_2']['toppings']);
    }

    /**
     * Test order handles empty cart gracefully
     */
    public function test_order_handles_empty_cart(): void
    {
        session(['cart' => []]);

        $orderData = [
            'payment_method' => 'paypal',
            'transaction_id' => 'MOCK_PAYPAL_EMPTY',
            'payment_status' => 'COMPLETED',
            'cart_items' => [],
            'first_name' => 'Empty',
            'last_name' => 'Cart',
            'email' => 'empty@example.com',
            'contact_no' => '+44 7700 900999',
            'city' => 'Liverpool',
            'state' => 'England',
            'zip' => 'L1 1AA',
            'address' => '999 Empty Street',
            'amount' => '0.00'
        ];

        $response = $this->postJson('/paypal-order', $orderData);

        $response->assertStatus(200);
        
        // Order should still be created even with empty cart
        $this->assertDatabaseHas('orders', [
            'email' => 'empty@example.com',
            'total_price' => '0.00'
        ]);
    }
}
