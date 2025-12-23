<?php

namespace App\Services;

use App\Models\Pizza;
use App\Repositories\ToppingRepository;
use App\Repositories\PizzaRepository;

/**
 * Pizza Price Calculator Service
 * Implements Single Responsibility Principle
 */
class PizzaPriceCalculator
{
    private ToppingRepository $toppingRepository;
    private PizzaRepository $pizzaRepository;

    public function __construct(
        ToppingRepository $toppingRepository,
        PizzaRepository $pizzaRepository
    ) {
        $this->toppingRepository = $toppingRepository;
        $this->pizzaRepository = $pizzaRepository;
    }

    /**
     * Calculate price for a pizza
     *
     * @param int $pizzaId
     * @param array $toppingIds
     * @return float
     * @throws \InvalidArgumentException
     */
    public function calculate(int $pizzaId, array $toppingIds = []): float
    {
        $pizza = $this->pizzaRepository->find($pizzaId);

        if (!$pizza) {
            throw new \InvalidArgumentException("Pizza with ID {$pizzaId} not found");
        }

        // For preset pizzas, return fixed price
        if (!$pizza->isCustom()) {
            return (float) $pizza->price;
        }

        // For custom pizzas, validate and calculate
        return $this->calculateCustomPizza($pizza, $toppingIds);
    }

    /**
     * Calculate price for custom pizza
     *
     * @param Pizza $pizza
     * @param array $toppingIds
     * @return float
     * @throws \InvalidArgumentException
     */
    private function calculateCustomPizza(Pizza $pizza, array $toppingIds): float
    {
        $toppingCount = count($toppingIds);

        if ($toppingCount > 4) {
            throw new \InvalidArgumentException('Maximum 4 toppings allowed for custom pizza');
        }

        if ($toppingCount === 0) {
            return (float) $pizza->price;
        }

        // Validate all toppings exist and are available
        $toppings = $this->toppingRepository->findMany($toppingIds);

        if ($toppings->count() !== $toppingCount) {
            throw new \InvalidArgumentException('One or more selected toppings are not available');
        }

        // Calculate: Base price + (£1 per topping)
        $basePrice = (float) $pizza->price;
        $toppingPrice = $toppings->sum('price');

        return $basePrice + $toppingPrice;
    }

    /**
     * Calculate total for cart items
     *
     * @param array $cartItems
     * @return float
     */
    public function calculateCartTotal(array $cartItems): float
    {
        $total = 0;

        foreach ($cartItems as $item) {
            $price = $item['price'] ?? 0;
            $quantity = $item['quantity'] ?? 1;
            $total += ($price * $quantity);
        }

        return round($total, 2);
    }

    /**
     * Get price breakdown for cart
     *
     * @param array $cartItems
     * @return array
     */
    public function getCartBreakdown(array $cartItems): array
    {
        $subtotal = 0;
        $items = [];

        foreach ($cartItems as $id => $item) {
            $itemTotal = ($item['price'] ?? 0) * ($item['quantity'] ?? 1);
            $subtotal += $itemTotal;

            $items[] = [
                'id' => $id,
                'name' => $item['name'] ?? 'Unknown',
                'price' => $item['price'] ?? 0,
                'quantity' => $item['quantity'] ?? 1,
                'total' => $itemTotal
            ];
        }

        return [
            'items' => $items,
            'subtotal' => round($subtotal, 2),
            'total' => round($subtotal, 2) // Can add tax/delivery here
        ];
    }
}
