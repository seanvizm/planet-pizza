<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    use HasFactory;

    protected $table = 'pizzas';

    protected $fillable = [
        'pizza_name',
        'pizza_description',
        'image',
        'price',
        'type',
        'default_toppings'
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'default_toppings' => 'array',
        ];
    }

    /**
     * Check if pizza is custom type
     */
    public function isCustom(): bool
    {
        return $this->type === 'custom';
    }

    /**
     * Calculate price with custom toppings
     */
    public function calculatePrice(array $toppings = []): float
    {
        if (!$this->isCustom() || empty($toppings)) {
            return (float) $this->price;
        }

        $toppingCount = count($toppings);
        if ($toppingCount > 4) {
            throw new \InvalidArgumentException('Maximum 4 toppings allowed');
        }

        return (float) $this->price + ($toppingCount * 1.00);
    }
}
