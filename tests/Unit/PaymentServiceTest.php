<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\Payment\PaymentService;
use App\Services\Payment\CardPaymentGateway;
use App\Services\Payment\PayPalPaymentGateway;

class PaymentServiceTest extends TestCase
{
    /**
     * Test card payment gateway creation
     */
    public function test_creates_payment_service_with_card_gateway(): void
    {
        $service = PaymentService::createWithMethod('card');
        
        $this->assertInstanceOf(PaymentService::class, $service);
        $this->assertEquals('Card', $service->getCurrentMethod());
    }

    /**
     * Test PayPal payment gateway creation
     */
    public function test_creates_payment_service_with_paypal_gateway(): void
    {
        $service = PaymentService::createWithMethod('paypal');
        
        $this->assertInstanceOf(PaymentService::class, $service);
        $this->assertEquals('PayPal', $service->getCurrentMethod());
    }

    /**
     * Test invalid payment method
     */
    public function test_throws_exception_for_invalid_payment_method(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Unsupported payment method');
        
        PaymentService::createWithMethod('bitcoin');
    }

    /**
     * Test card payment processing
     */
    public function test_card_payment_processes_successfully(): void
    {
        $gateway = new CardPaymentGateway();
        
        $result = $gateway->process(25.50, [
            'card_number' => '4242424242424242',
            'card_expiry' => '12/25',
            'card_cvv' => '123',
            'card_last4' => '4242'
        ]);
        
        $this->assertTrue($result['success']);
        $this->assertStringStartsWith('CARD_', $result['reference']);
    }

    /**
     * Test PayPal payment processing
     */
    public function test_paypal_payment_processes_successfully(): void
    {
        $gateway = new PayPalPaymentGateway();
        
        $result = $gateway->process(30.00, [
            'paypal_email' => 'customer@example.com'
        ]);
        
        $this->assertTrue($result['success']);
        $this->assertStringStartsWith('PAYPAL_', $result['reference']);
    }

    /**
     * Test card payment validation fails with invalid details
     */
    public function test_card_payment_fails_with_invalid_details(): void
    {
        $gateway = new CardPaymentGateway();
        
        $result = $gateway->process(25.50, [
            'card_number' => '4242424242424242'
            // Missing required fields
        ]);
        
        $this->assertFalse($result['success']);
    }

    /**
     * Test PayPal payment validation fails with invalid details
     */
    public function test_paypal_payment_fails_with_invalid_details(): void
    {
        $gateway = new PayPalPaymentGateway();
        
        $result = $gateway->process(30.00, []);
        
        $this->assertFalse($result['success']);
    }

    /**
     * Test payment service throws exception without gateway
     */
    public function test_payment_service_requires_gateway(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Payment gateway not set');
        
        $service = new PaymentService();
        $service->processPayment(10.00, []);
    }
}


