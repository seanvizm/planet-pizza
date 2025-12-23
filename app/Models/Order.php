<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'name',
        'email',
        'contact_no',
        'city',
        'state',
        'zip',
        'address',
        'ref',
        'cart_items',
        'total_price',
        'payment_method',
        'payment_status'
    ];

    protected function casts(): array
    {
        return [
            'cart_items' => 'array',
            'total_price' => 'decimal:2',
        ];
    }

    /**
     * Check if order is paid
     */
    public function isPaid(): bool
    {
        return $this->payment_status === 'paid';
    }

    /**
     * Mark order as paid
     */
    public function markAsPaid(): void
    {
        $this->update(['payment_status' => 'paid']);
    }
}
