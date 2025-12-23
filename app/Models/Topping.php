<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Topping extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'available'
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'available' => 'boolean',
        ];
    }

    /**
     * Scope to get only available toppings
     */
    public function scopeAvailable($query)
    {
        return $query->where('available', true);
    }
}
