@extends('layouts.app')

@section('content')
    <style>
        /* Light Theme - Checkout Form Styling */
        [data-theme="light"] .form-control {
            background-color: transparent !important;
            color: #212529 !important;
            border: none !important;
            border-bottom: 1px solid #ced4da !important;
            border-radius: 0 !important;
            padding: 4px 12px !important;
            font-size: 14px !important;
        }

        [data-theme="light"] .form-control:focus {
            background-color: transparent !important;
            color: #212529 !important;
            border-bottom: 1px solid #ff6b35 !important;
            box-shadow: none !important;
            outline: none !important;
        }

        [data-theme="light"] .form-control[readonly] {
            background-color: transparent !important;
            color: #495057 !important;
            border-bottom: 1px solid #dee2e6 !important;
        }

        [data-theme="light"] label {
            color: #212529 !important;
            margin-bottom: 2px !important;
        }

        [data-theme="light"] h4 {
            color: #212529 !important;
        }

        [data-theme="light"] .text-muted {
            color: #6c757d !important;
        }

        [data-theme="light"] .list-group-item {
            color: #212529 !important;
            background-color: #ffffff !important;
            border: 1px solid rgba(0,0,0,.125);
        }

        [data-theme="light"] .list-group-item.bg-transparent {
            background-color: transparent !important;
        }

        [data-theme="light"] .list-group-item .text-muted {
            color: #6c757d !important;
        }

        [data-theme="light"] .custom-control-label {
            color: #212529 !important;
        }

        /* Dark Theme - Checkout Form Styling */
        [data-theme="dark"] .form-control {
            background-color: transparent !important;
            color: #ffffff !important;
            border: none !important;
            border-bottom: 1px solid #444 !important;
            border-radius: 0 !important;
            padding: 4px 12px !important;
            font-size: 14px !important;
        }

        [data-theme="dark"] .form-control:focus {
            background-color: transparent !important;
            color: #ffffff !important;
            border-bottom: 1px solid #ff6b35 !important;
            box-shadow: none !important;
            outline: none !important;
        }

        [data-theme="dark"] .form-control[readonly] {
            background-color: transparent !important;
            color: #adb5bd !important;
            border-bottom: 1px solid #333 !important;
        }

        [data-theme="dark"] label {
            color: #ffffff !important;
            margin-bottom: 2px !important;
        }

        [data-theme="dark"] h4 {
            color: #ffffff !important;
        }

        [data-theme="dark"] .text-muted {
            color: #adb5bd !important;
        }

        [data-theme="dark"] .list-group-item {
            color: #ffffff !important;
            background-color: #1a1d21 !important;
            border: 1px solid rgba(255,255,255,.125);
        }

        [data-theme="dark"] .list-group-item.bg-transparent {
            background-color: transparent !important;
        }

        [data-theme="dark"] .list-group-item .text-muted {
            color: #adb5bd !important;
        }

        [data-theme="dark"] .custom-control-label {
            color: #ffffff !important;
        }

        [data-theme="dark"] .card {
            background-color: #1a1d21 !important;
            border-color: #444 !important;
        }

        /* Payment Method Selection */
        .payment-method {
            border: 2px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .payment-method:hover {
            border-color: #ff6b35;
            background-color: rgba(255, 107, 53, 0.05);
        }

        .payment-method.selected {
            border-color: #ff6b35;
            background-color: rgba(255, 107, 53, 0.1);
        }

        .payment-method input[type="radio"] {
            margin-right: 10px;
        }

        .payment-method-icon {
            font-size: 24px;
            margin-right: 10px;
        }

        [data-theme="dark"] .payment-method {
            border-color: #444;
        }

        [data-theme="dark"] .payment-method:hover {
            border-color: #ff6b35;
            background-color: rgba(255, 107, 53, 0.1);
        }

        [data-theme="dark"] .payment-method.selected {
            border-color: #ff6b35;
            background-color: rgba(255, 107, 53, 0.15);
        }

        #paypal-button-container {
            margin-top: 20px;
        }

        /* Mock Payment Buttons */
        .payment-btn {
            width: 100%;
            padding: 15px 20px;
            margin-bottom: 15px;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .payment-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .payment-btn.paypal-btn {
            background-color: #0070ba;
            color: white;
            border-color: #0070ba;
        }

        .payment-btn.paypal-btn:hover {
            background-color: #005a94;
            border-color: #005a94;
        }

        .payment-btn.card-btn {
            background-color: #ff6b35;
            color: white;
            border-color: #ff6b35;
        }

        .payment-btn.card-btn:hover {
            background-color: #e55a2a;
            border-color: #e55a2a;
        }

        [data-theme="dark"] .payment-btn {
            border-color: #444;
        }

    </style>

    <div class="container mt-2">
        @php $total = 0 @endphp
        <div class="row" style="margin: 32px 20px;">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                    <span class="badge badge-secondary badge-pill">{{ count((array) session('cart')) }}</span>
                </h4>
                <ul class="list-group mb-3 text-light">

                    @if (session('cart'))
                        @foreach (session('cart') as $id => $details)
                            @php $total += $details['price'] * $details['quantity'] @endphp
                            <li class="list-group-item d-flex justify-content-between lh-condensed bg-transparent">
                                <div>
                                    <h6 class="my-0">{{ $details['name'] }}</h6>
                                    <small class="text-muted">Quantity: {{ $details['quantity'] }}</small>
                                </div>
                                <span class="">£{{ $details['price'] * $details['quantity']}}</span>
                            </li>
                        @endforeach
                    @endif
                    <li class="list-group-item d-flex justify-content-between bg-secondary">
                        <span style="color: white">Total (£)</span>
                        <strong>£{{ $total }}</strong>
                    </li>
                </ul>

                <form class="p-2">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Promo code">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-secondary">Redeem</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Billing address</h4>
                <form class="needs-validation" novalidate id="paymentForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email-address" placeholder="you@email.com" required>
                        <div class="invalid-feedback">
                            Please enter a valid email address.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="contact">Contact Number</label>
                        <input type="tel" class="form-control" id="contact-no" placeholder="+44 7700 900000" required>
                        <div class="invalid-feedback">
                            Contact number is required for delivery.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="amount">Amount </label>
                        <input type="number" class="form-control" id="amount" value="{{ $total }}" readonly>

                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="City">City</label>
                            <input type="text" class="form-control" id="city" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                This input is required.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="State">State</label>
                            <input type="text" class="form-control" id="state" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                This input is required.
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="zip">Zip</label>
                            <input type="text" class="form-control" id="zip" placeholder="" required>
                            <div class="invalid-feedback">
                                Zip code required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address">Home Address</label>
                        <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="save-info">
                        <label class="custom-control-label" for="save-info">Save this information for next time</label>
                    </div>
                    <hr class="mb-4">

                    <h4 class="mb-3">Payment</h4>
                    <p class="text-muted mb-3">Select your payment method @if(!env('PAYPAL_CLIENT_ID'))(Mock Payment)@endif</p>
                    
                    @if(env('PAYPAL_CLIENT_ID'))
                    <!-- Real PayPal Button -->
                    <div id="paypal-button-container"></div>
                    
                    <!-- Real Card Payment via PayPal -->
                    <div id="card-button-container" class="payment-btn card-btn" style="display: none;">
                        <span style="font-size: 24px;">💳</span>
                        <span>Pay with Card</span>
                    </div>
                    @else
                    <!-- Mock PayPal Button -->
                    <button type="button" class="payment-btn paypal-btn" onclick="processPayment('paypal')">
                        <span style="font-size: 24px;">🅿️</span>
                        <span>Pay with PayPal (Mock)</span>
                    </button>
                    
                    <!-- Mock Card Button -->
                    <button type="button" class="payment-btn card-btn" onclick="processPayment('card')">
                        <span style="font-size: 24px;">💳</span>
                        <span>Pay with Card (Mock)</span>
                    </button>
                    @endif
                </form>
            </div>
        </div>
        @php
            $cart_array = session('cart');
            $json_cart = json_encode($cart_array);
        @endphp
    </div>
    
    @if(env('PAYPAL_CLIENT_ID'))
    <!-- PayPal SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}&currency=GBP"></script>
    @endif
    
    <script>
        const paymentForm = document.getElementById('paymentForm');
        var cart_array = @php
            echo $json_cart;
        @endphp

        @if(env('PAYPAL_CLIENT_ID'))
        // Real PayPal Integration
        paypal.Buttons({
            createOrder: function(data, actions) {
                // Validate form first
                if (!paymentForm.checkValidity()) {
                    paymentForm.classList.add('was-validated');
                    alert('Please fill in all required fields');
                    return false;
                }
                
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: document.getElementById('amount').value
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Prepare order data
                    const orderData = {
                        _token: document.querySelector('input[name="_token"]').value,
                        payment_method: 'paypal',
                        transaction_id: details.id,
                        payment_status: details.status,
                        cart_items: cart_array,
                        first_name: document.getElementById('firstName').value,
                        last_name: document.getElementById('lastName').value,
                        email: document.getElementById('email-address').value || details.payer.email_address,
                        contact_no: document.getElementById('contact-no').value,
                        city: document.getElementById('city').value,
                        state: document.getElementById('state').value,
                        zip: document.getElementById('zip').value,
                        address: document.getElementById('address').value,
                        amount: document.getElementById('amount').value
                    };

                    // Send to server
                    fetch('/paypal-order', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: JSON.stringify(orderData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert('Payment successful! Transaction ID: ' + details.id);
                        window.location = '/';
                    })
                    .catch(error => {
                        alert('Error processing order. Please try again.');
                        console.error('Error:', error);
                    });
                });
            },
            onError: function(err) {
                alert('PayPal error occurred. Please try again.');
                console.error('PayPal Error:', err);
            }
        }).render('#paypal-button-container');

        // Real Card Payment via PayPal (uses card funding source)
        paypal.Buttons({
            fundingSource: paypal.FUNDING.CARD,
            createOrder: function(data, actions) {
                // Validate form first
                if (!paymentForm.checkValidity()) {
                    paymentForm.classList.add('was-validated');
                    alert('Please fill in all required fields');
                    return false;
                }
                
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: document.getElementById('amount').value
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Prepare order data
                    const orderData = {
                        _token: document.querySelector('input[name="_token"]').value,
                        payment_method: 'card',
                        transaction_id: details.id,
                        payment_status: details.status,
                        cart_items: cart_array,
                        first_name: document.getElementById('firstName').value,
                        last_name: document.getElementById('lastName').value,
                        email: document.getElementById('email-address').value || (details.payer && details.payer.email_address),
                        contact_no: document.getElementById('contact-no').value,
                        city: document.getElementById('city').value,
                        state: document.getElementById('state').value,
                        zip: document.getElementById('zip').value,
                        address: document.getElementById('address').value,
                        amount: document.getElementById('amount').value
                    };

                    // Send to server
                    fetch('/paypal-order', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: JSON.stringify(orderData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert('Card payment successful! Transaction ID: ' + details.id);
                        window.location = '/';
                    })
                    .catch(error => {
                        alert('Error processing order. Please try again.');
                        console.error('Error:', error);
                    });
                });
            },
            onError: function(err) {
                alert('Card payment error occurred. Please try again.');
                console.error('Card Payment Error:', err);
            }
        }).render('#card-button-container').then(function() {
            // Show the card button after it's rendered
            document.getElementById('card-button-container').style.display = 'flex';
        });
        @endif

        function processPayment(paymentMethod) {
            // Validate form
            if (!paymentForm.checkValidity()) {
                paymentForm.classList.add('was-validated');
                alert('Please fill in all required fields');
                return;
            }

            // Generate mock transaction ID
            const transactionId = 'MOCK_' + paymentMethod.toUpperCase() + '_' + Date.now();
            
            // Log payment information
            console.log('=== MOCK PAYMENT PROCESSED ===');
            console.log('Payment Method:', paymentMethod);
            console.log('Transaction ID:', transactionId);
            console.log('Amount: £' + document.getElementById("amount").value);
            console.log('Customer:', document.getElementById("firstName").value + ' ' + document.getElementById("lastName").value);
            console.log('Cart Items:', cart_array);
            console.log('============================');

            // Prepare order data
            const orderData = {
                _token: document.querySelector('input[name="_token"]').value,
                payment_method: paymentMethod,
                transaction_id: transactionId,
                payment_status: 'COMPLETED',
                cart_items: cart_array,
                first_name: document.getElementById("firstName").value,
                last_name: document.getElementById("lastName").value,
                email: document.getElementById("email-address").value,
                contact_no: document.getElementById("contact-no").value,
                city: document.getElementById("city").value,
                state: document.getElementById("state").value,
                zip: document.getElementById("zip").value,
                address: document.getElementById("address").value,
                amount: document.getElementById("amount").value
            };

            // Send to server
            fetch('/paypal-order', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify(orderData)
            })
            .then(response => response.json())
            .then(data => {
                alert(`Mock payment successful!\nMethod: ${paymentMethod.toUpperCase()}\nTransaction ID: ${transactionId}`);
                window.location = '/';
            })
            .catch(error => {
                alert('Error processing order. Please try again.');
                console.error('Error:', error);
            });
        }
    </script>

@endsection
