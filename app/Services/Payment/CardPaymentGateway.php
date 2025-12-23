<?php

namespace App\Services\Payment;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * Card Payment Gateway Implementation
 * Mocked implementation for card payments
 */
class CardPaymentGateway implements PaymentGatewayInterface
{
    /**
     * Process card payment (mocked)
     *
     * @param float $amount
     * @param array $details
     * @return array
     */
    public function process(float $amount, array $details): array
    {
        // Validate payment details
        if (!$this->validateDetails($details)) {
            return [
                'success' => false,
                'message' => 'Invalid card details provided',
                'reference' => null
            ];
        }

        // Mock payment processing
        $reference = 'CARD_' . strtoupper(Str::random(16));
        
        // Log the payment (as per requirements: mock with logging)
        Log::info('Card Payment Processed', [
            'method' => 'Card',
            'amount' => $amount,
            'currency' => 'GBP',
            'reference' => $reference,
            'card_last4' => $details['card_last4'] ?? 'XXXX',
            'timestamp' => now()->toDateTimeString()
        ]);

        return [
            'success' => true,
            'message' => 'Payment processed successfully',
            'reference' => $reference,
            'method' => 'card'
        ];
    }

    /**
     * Get payment method name
     *
     * @return string
     */
    public function getMethodName(): string
    {
        return 'Card';
    }

    /**
     * Validate card payment details
     *
     * @param array $details
     * @return bool
     */
    public function validateDetails(array $details): bool
    {
        // Mock validation - in real scenario, validate card number, expiry, CVV
        return isset($details['card_number']) 
            && isset($details['card_expiry']) 
            && isset($details['card_cvv']);
    }
}
