<?php

namespace App\Services\Payment;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * PayPal Payment Gateway Implementation
 * Mocked implementation for PayPal payments
 */
class PayPalPaymentGateway implements PaymentGatewayInterface
{
    /**
     * Process PayPal payment (mocked)
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
                'message' => 'Invalid PayPal details provided',
                'reference' => null
            ];
        }

        // Mock payment processing
        $reference = 'PAYPAL_' . strtoupper(Str::random(16));
        
        // Log the payment (as per requirements: mock with logging)
        Log::info('PayPal Payment Processed', [
            'method' => 'PayPal',
            'amount' => $amount,
            'currency' => 'GBP',
            'reference' => $reference,
            'paypal_email' => $details['paypal_email'] ?? 'N/A',
            'timestamp' => now()->toDateTimeString()
        ]);

        return [
            'success' => true,
            'message' => 'Payment processed successfully via PayPal',
            'reference' => $reference,
            'method' => 'paypal'
        ];
    }

    /**
     * Get payment method name
     *
     * @return string
     */
    public function getMethodName(): string
    {
        return 'PayPal';
    }

    /**
     * Validate PayPal payment details
     *
     * @param array $details
     * @return bool
     */
    public function validateDetails(array $details): bool
    {
        // Mock validation - in real scenario, validate PayPal authentication
        return isset($details['paypal_email']);
    }
}
