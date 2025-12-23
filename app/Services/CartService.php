<?php

namespace App\Services;

use App\Repositories\PizzaRepository;
use App\Repositories\ToppingRepository;

/**
 * Cart Service
 * Manages shopping cart operations
 */
class CartService
{
    private PizzaRepository $pizzaRepository;
    private ToppingRepository $toppingRepository;
    private PizzaPriceCalculator $priceCalculator;

    public function __construct(
        PizzaRepository $pizzaRepository,
        ToppingRepository $toppingRepository,
        PizzaPriceCalculator $priceCalculator
    ) {
        $this->pizzaRepository = $pizzaRepository;
        $this->toppingRepository = $toppingRepository;
        $this->priceCalculator = $priceCalculator;
    }

    /**
     * Add pizza to cart
     *
     * @param int $pizzaId
     * @param array $toppingIds
     * @param int $quantity
     * @return array
     */
    public function addToCart(int $pizzaId, array $toppingIds = [], int $quantity = 1): array
    {
        $pizza = $this->pizzaRepository->find($pizzaId);

        if (!$pizza) {
            return [
                'success' => false,
                'message' => 'Pizza not found'
            ];
        }

        try {
            $price = $this->priceCalculator->calculate($pizzaId, $toppingIds);

            $toppingNames = [];
            if (!empty($toppingIds)) {
                $toppings = $this->toppingRepository->findMany($toppingIds);
                $toppingNames = $toppings->pluck('name')->toArray();
            }

            $itemName = $pizza->pizza_name;
            if (!empty($toppingNames)) {
                $itemName .= ' (+ ' . implode(', ', $toppingNames) . ')';
            }

            $cart = session()->get('cart', []);
            
            // Create unique key for this pizza+toppings combination
            $cartKey = $pizzaId . '_' . implode('_', $toppingIds);

            if (isset($cart[$cartKey])) {
                $cart[$cartKey]['quantity'] += $quantity;
            } else {
                $cart[$cartKey] = [
                    'pizza_id' => $pizzaId,
                    'name' => $itemName,
                    'price' => $price,
                    'quantity' => $quantity,
                    'image' => $pizza->image,
                    'toppings' => $toppingNames
                ];
            }

            session()->put('cart', $cart);

            return [
                'success' => true,
                'message' => 'Pizza added to cart',
                'cart' => $cart
            ];

        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Update cart item quantity
     *
     * @param string $cartKey
     * @param int $quantity
     * @return bool
     */
    public function updateQuantity(string $cartKey, int $quantity): bool
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$cartKey])) {
            if ($quantity <= 0) {
                unset($cart[$cartKey]);
            } else {
                $cart[$cartKey]['quantity'] = $quantity;
            }

            session()->put('cart', $cart);
            return true;
        }

        return false;
    }

    /**
     * Remove item from cart
     *
     * @param string $cartKey
     * @return bool
     */
    public function removeFromCart(string $cartKey): bool
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$cartKey])) {
            unset($cart[$cartKey]);
            session()->put('cart', $cart);
            return true;
        }

        return false;
    }

    /**
     * Clear cart
     *
     * @return void
     */
    public function clearCart(): void
    {
        session()->forget('cart');
    }

    /**
     * Get cart contents
     *
     * @return array
     */
    public function getCart(): array
    {
        return session()->get('cart', []);
    }

    /**
     * Get cart total
     *
     * @return float
     */
    public function getCartTotal(): float
    {
        $cart = $this->getCart();
        return $this->priceCalculator->calculateCartTotal($cart);
    }

    /**
     * Get cart count
     *
     * @return int
     */
    public function getCartCount(): int
    {
        return count($this->getCart());
    }
}
