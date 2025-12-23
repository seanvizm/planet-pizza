<?php

namespace App\Repositories;

use App\Models\Topping;
use Illuminate\Support\Collection;

/**
 * Topping Repository (Repository Pattern)
 * Encapsulates data access logic for toppings
 */
class ToppingRepository
{
    /**
     * Get all available toppings
     *
     * @return Collection
     */
    public function getAvailable(): Collection
    {
        return Topping::available()->get();
    }

    /**
     * Get all toppings
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return Topping::all();
    }

    /**
     * Find topping by ID
     *
     * @param int $id
     * @return Topping|null
     */
    public function find(int $id): ?Topping
    {
        return Topping::find($id);
    }

    /**
     * Find topping by name
     *
     * @param string $name
     * @return Topping|null
     */
    public function findByName(string $name): ?Topping
    {
        return Topping::where('name', $name)->first();
    }

    /**
     * Get toppings by IDs
     *
     * @param array $ids
     * @return Collection
     */
    public function findMany(array $ids): Collection
    {
        return Topping::whereIn('id', $ids)->available()->get();
    }
}
