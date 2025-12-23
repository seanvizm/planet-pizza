<?php

namespace App\Services;

use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Services\Payment\PaymentService;
use Illuminate\Support\Str;

/**
 * Order Service
 * Handles order creation and management
 * Implements Dependency Inversion Principle
 */
class OrderService
{
    private OrderRepository $orderRepository;
    private PizzaPriceCalculator $priceCalculator;

    public function __construct(
        OrderRepository $orderRepository,
        PizzaPriceCalculator $priceCalculator
    ) {
        $this->orderRepository = $orderRepository;
        $this->priceCalculator = $priceCalculator;
    }

    /**
     * Create new order
     *
     * @param array $orderData
     * @param array $cartItems
     * @param string $paymentMethod
     * @param array $paymentDetails
     * @return array
     */
    public function createOrder(
        array $orderData,
        array $cartItems,
        string $paymentMethod,
        array $paymentDetails = []
    ): array {
        // Calculate total price
        $totalPrice = $this->priceCalculator->calculateCartTotal($cartItems);

        // Process payment
        $paymentService = PaymentService::createWithMethod($paymentMethod);
        $paymentResult = $paymentService->processPayment($totalPrice, $paymentDetails);

        if (!$paymentResult['success']) {
            return [
                'success' => false,
                'message' => $paymentResult['message'],
                'order' => null
            ];
        }

        // Create order
        $order = $this->orderRepository->create([
            'name' => $orderData['name'],
            'email' => $orderData['email'],
            'city' => $orderData['city'] ?? '',
            'state' => $orderData['state'] ?? '',
            'zip' => $orderData['zip'] ?? '',
            'address' => $orderData['address'],
            'ref' => $paymentResult['reference'],
            'cart_items' => json_encode($cartItems),
            'total_price' => $totalPrice,
            'payment_method' => $paymentMethod,
            'payment_status' => 'paid'
        ]);

        return [
            'success' => true,
            'message' => 'Order created successfully',
            'order' => $order,
            'payment_reference' => $paymentResult['reference']
        ];
    }

    /**
     * Get order by reference
     *
     * @param string $reference
     * @return Order|null
     */
    public function getOrderByReference(string $reference): ?Order
    {
        return $this->orderRepository->findByReference($reference);
    }

    /**
     * Get customer orders
     *
     * @param string $email
     * @return \Illuminate\Support\Collection
     */
    public function getCustomerOrders(string $email)
    {
        return $this->orderRepository->getByEmail($email);
    }
}
