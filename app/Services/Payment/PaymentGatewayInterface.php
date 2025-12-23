<?php

namespace App\Services\Payment;

/**
 * Payment Gateway Interface (Strategy Pattern)
 * Defines the contract for all payment methods
 */
interface PaymentGatewayInterface
{
    /**
     * Process payment
     *
     * @param float $amount
     * @param array $details
     * @return array
     */
    public function process(float $amount, array $details): array;

    /**
     * Get payment method name
     *
     * @return string
     */
    public function getMethodName(): string;

    /**
     * Validate payment details
     *
     * @param array $details
     * @return bool
     */
    public function validateDetails(array $details): bool;
}
