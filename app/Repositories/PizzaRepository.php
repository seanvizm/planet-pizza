<?php

namespace App\Repositories;

use App\Models\Pizza;
use Illuminate\Support\Collection;

/**
 * Pizza Repository (Repository Pattern)
 * Encapsulates data access logic for pizzas
 */
class PizzaRepository
{
    /**
     * Get all pizzas
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return Pizza::all();
    }

    /**
     * Find pizza by ID
     *
     * @param int $id
     * @return Pizza|null
     */
    public function find(int $id): ?Pizza
    {
        return Pizza::find($id);
    }

    /**
     * Get preset pizzas only
     *
     * @return Collection
     */
    public function getPresetPizzas(): Collection
    {
        return Pizza::where('type', 'preset')->get();
    }

    /**
     * Get custom pizza option
     *
     * @return Pizza|null
     */
    public function getCustomPizza(): ?Pizza
    {
        return Pizza::where('type', 'custom')->first();
    }

    /**
     * Create new pizza
     *
     * @param array $data
     * @return Pizza
     */
    public function create(array $data): Pizza
    {
        return Pizza::create($data);
    }

    /**
     * Update pizza
     *
     * @param Pizza $pizza
     * @param array $data
     * @return bool
     */
    public function update(Allpizza $pizza, array $data): bool
    {
        return $pizza->update($data);
    }

    /**
     * Delete pizza
     *
     * @param Pizza $pizza
     * @return bool
     */
    public function delete(Allpizza $pizza): bool
    {
        return $pizza->delete();
    }
}
