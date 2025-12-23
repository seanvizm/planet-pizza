<?php

namespace App\Services\Payment;

/**
 * Payment Service (Context for Strategy Pattern)
 * Handles payment processing using different payment gateways
 */
class PaymentService
{
    private PaymentGatewayInterface $gateway;

    /**
     * Set payment gateway strategy
     *
     * @param PaymentGatewayInterface $gateway
     * @return void
     */
    public function setGateway(PaymentGatewayInterface $gateway): void
    {
        $this->gateway = $gateway;
    }

    /**
     * Process payment using selected gateway
     *
     * @param float $amount
     * @param array $details
     * @return array
     * @throws \RuntimeException
     */
    public function processPayment(float $amount, array $details): array
    {
        if (!isset($this->gateway)) {
            throw new \RuntimeException('Payment gateway not set');
        }

        return $this->gateway->process($amount, $details);
    }

    /**
     * Get current payment method name
     *
     * @return string
     */
    public function getCurrentMethod(): string
    {
        return $this->gateway->getMethodName();
    }

    /**
     * Factory method to create payment service with specific gateway
     *
     * @param string $method
     * @return self
     * @throws \InvalidArgumentException
     */
    public static function createWithMethod(string $method): self
    {
        $service = new self();
        
        $gateway = match(strtolower($method)) {
            'card' => new CardPaymentGateway(),
            'paypal' => new PayPalPaymentGateway(),
            default => throw new \InvalidArgumentException("Unsupported payment method: {$method}")
        };

        $service->setGateway($gateway);
        
        return $service;
    }
}
