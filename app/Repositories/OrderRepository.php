<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Support\Collection;

/**
 * Order Repository (Repository Pattern)
 * Encapsulates data access logic for orders
 */
class OrderRepository
{
    /**
     * Create a new order
     *
     * @param array $data
     * @return Order
     */
    public function create(array $data): Order
    {
        return Order::create($data);
    }

    /**
     * Find order by ID
     *
     * @param int $id
     * @return Order|null
     */
    public function find(int $id): ?Order
    {
        return Order::find($id);
    }

    /**
     * Find order by reference
     *
     * @param string $reference
     * @return Order|null
     */
    public function findByReference(string $reference): ?Order
    {
        return Order::where('ref', $reference)->first();
    }

    /**
     * Get all orders
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return Order::latest()->get();
    }

    /**
     * Get orders by email
     *
     * @param string $email
     * @return Collection
     */
    public function getByEmail(string $email): Collection
    {
        return Order::where('email', $email)->latest()->get();
    }

    /**
     * Update order
     *
     * @param Order $order
     * @param array $data
     * @return bool
     */
    public function update(Order $order, array $data): bool
    {
        return $order->update($data);
    }

    /**
     * Delete order
     *
     * @param Order $order
     * @return bool
     */
    public function delete(Order $order): bool
    {
        return $order->delete();
    }
}
