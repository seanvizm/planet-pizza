# Payment System - Mock & Real PayPal Integration

## Overview

This application supports **two payment modes**:
1. **Mock Payment Mode** (Default) - No real money, perfect for development
2. **Real PayPal Mode** - Actual PayPal integration for test/production

The system automatically switches between modes based on the `PAYPAL_CLIENT_ID` environment variable.

---

## Payment Methods Available

**Mock Mode (PAYPAL_CLIENT_ID empty):**
- ✅ **Card Payment** - Mock (no real processing)
- ✅ **PayPal Payment** - Mock (no real processing)

**Real PayPal Mode (PAYPAL_CLIENT_ID set):**
- ✅ **Card Payment** - Real via PayPal SDK (processes actual card payments)
- ✅ **PayPal Payment** - Real via PayPal SDK (processes actual PayPal payments)

---

## Quick Setup

### Option 1: Mock Payment (Default - No Setup Required)

**Perfect for development and demonstration**

Simply leave `PAYPAL_CLIENT_ID` empty in your `.env` file:

```env
PAYPAL_CLIENT_ID=
```

**What happens:**
- Both Card and PayPal buttons use mock payment
- Generates mock transaction IDs (e.g., `MOCK_PAYPAL_1234567890`)
- Logs all transactions to console and Laravel log
- No external API calls
- Cart is cleared after "payment"

---

### Option 2: Real PayPal Integration

**For testing with PayPal Sandbox or production use**

#### Step 1: Get PayPal Client ID

1. Go to https://developer.paypal.com/
2. Log in or create a developer account
3. Navigate to **"Apps & Credentials"**
4. Select **Sandbox** (for testing) or **Live** (for production)
5. Create a new app or select an existing one
6. Copy your **Client ID**

#### Step 2: Configure Environment

Add your PayPal Client ID to `.env`:

**For Testing (Sandbox):**
```env
PAYPAL_CLIENT_ID=your_sandbox_client_id_here
```

**For Production (Live):**
```env
PAYPAL_CLIENT_ID=your_production_client_id_here
```

**Example:**
```env
PAYPAL_CLIENT_ID=AeHGxNw1h5h5h5h5_example_client_id_abc123xyz
```

#### Step 3: Clear Cache

```bash
php artisan config:clear
```

#### Step 4: Test

Both payment methods now use the PayPal SDK:

- **Card Payment**: 
  - Opens PayPal card payment interface
  - Processes card payments through PayPal
  - Can be used without a PayPal account
  - Supports credit/debit cards
  
- **PayPal Button**: 
  - Opens PayPal login/payment modal
  - Processes PayPal account payments
  - Supports PayPal balance, linked cards, and bank accounts

---

## Payment Flow

### Mock Mode (PAYPAL_CLIENT_ID is empty)

1. Customer fills out billing form
2. Selects payment method:
   - **"Pay with Card (Mock)"** button
   - **"Pay with PayPal (Mock)"** button
3. Mock processing:
   - Validates form
   - Generates mock transaction ID
   - Logs to console and Laravel log
   - Saves order to database
   - Clears cart
   - Redirects to homepage

### Real PayPal Mode (PAYPAL_CLIENT_ID is set)

1. Customer fills out billing form
2. Sees payment options:
   - **Card Payment Button** (real PayPal card processing)
   - **PayPal Button** (real PayPal account processing)
3. When clicking Card button:
   - PayPal card payment interface opens
   - Customer enters card details (credit/debit)
   - Transaction is processed by PayPal
   - Returns transaction details
   - Saves order to database with payment_method='card'
   - Clears cart
   - Redirects to homepage
4. When clicking PayPal button:
   - PayPal modal opens
   - Customer logs into PayPal or pays as guest
   - Transaction is processed by PayPal
   - Returns transaction details
   - Saves order to database with payment_method='paypal'
   - Clears cart
   - Redirects to homepage

---

## Payment Logging

All payment transactions are logged to:
- **Browser Console** (F12 Developer Tools)
- **Laravel Log File** (`storage/logs/laravel.log`)

### Log Information Includes:
- Payment Method (CARD or PAYPAL)
- Transaction ID (mock or real)
- Amount
- Customer Name & Email
- Status
- Cart Items
- Timestamp
- Order ID

### View Logs

Real-time monitoring:
```bash
tail -f storage/logs/laravel.log
```

Filter for payments only:
```bash
tail -100 storage/logs/laravel.log | grep "PAYMENT RECEIVED" -A 10
```

---

## Database

The `orders` table stores all orders with:
- `payment_method` field ('card' or 'paypal')
- `ref` field (transaction ID - mock or real)
- `status` field (e.g., 'COMPLETED', 'APPROVED')
- `cart_items` (JSON)
- Customer details (name, email, address, etc.)

---

## Testing PayPal Sandbox

When using PayPal Sandbox mode:

1. **Create Test Accounts** in PayPal Developer Dashboard
2. **Personal Account** (buyer) - for testing purchases
3. **Business Account** (seller) - receives payments

**Test PayPal Login:**
- Use sandbox personal account credentials
- PayPal provides test accounts with fake money
- All transactions are simulated (no real money)

**Sandbox Test Cards** are provided by PayPal for card payments within PayPal.

---

## Currency

Currently set to **GBP (British Pounds) £**

To change currency:
1. Update PayPal SDK script in `checkout.blade.php`:
   ```javascript
   currency=GBP  →  currency=USD  (or other)
   ```
2. Update display symbols throughout the app:
   ```
   £  →  $  (or other)
   ```

---

## Files Modified

1. `resources/views/pizzas/checkout.blade.php` - Hybrid payment UI (mock + real PayPal)
2. `routes/web.php` - `/paypal-order` route for both payment types
3. `app/Http/Controllers/PizzaController.php` - `paypalOrder()` method with logging
4. `.env` - `PAYPAL_CLIENT_ID` configuration
5. `.env.example` - Template with `PAYPAL_CLIENT_ID`

---

## Environment Detection

The checkout page automatically detects which mode to use:

```php
@if(env('PAYPAL_CLIENT_ID'))
    <!-- Real PayPal & Card Buttons via PayPal SDK -->
@else
    <!-- Mock PayPal & Card Buttons -->
@endif
```

**Both Card and PayPal payments** use PayPal SDK when `PAYPAL_CLIENT_ID` is configured.
- Card button uses `fundingSource: paypal.FUNDING.CARD`
- PayPal button uses default funding source

---

## Security Notes

⚠️ **Never commit real PayPal credentials to version control**
⚠️ **Use Sandbox credentials for development/testing**
⚠️ **Use Production credentials only on live servers**
⚠️ **Keep `.env` file secure and excluded from Git**

---

## Switching Between Modes

**To Switch to Mock Mode:**
```bash
# Edit .env file
PAYPAL_CLIENT_ID=

# Clear config
php artisan config:clear
```

**To Switch to Real PayPal:**
```bash
# Edit .env file
PAYPAL_CLIENT_ID=your_actual_client_id

# Clear config
php artisan config:clear
```

---

## Support & Documentation

**PayPal Developer Resources:**
- Documentation: https://developer.paypal.com/docs/
- Sandbox Dashboard: https://developer.paypal.com/developer/accounts/
- Support: https://www.paypal.com/support

**PayPal SDK JavaScript:**
- SDK Reference: https://developer.paypal.com/sdk/js/

---

## Troubleshooting

**Issue: PayPal button not showing**
- Check if `PAYPAL_CLIENT_ID` is set correctly
- Clear browser cache
- Check browser console for errors
- Verify PayPal SDK loads: View page source and look for `paypal.com/sdk/js`

**Issue: PayPal sandbox not working**
- Verify you're using Sandbox Client ID (not Live)
- Check test account credentials
- Ensure sandbox mode is enabled in Developer Dashboard

**Issue: Mock payment not logging**
- Check `storage/logs/laravel.log` permissions
- Verify Laravel logging is enabled (`LOG_LEVEL=debug` in `.env`)
- Check browser console (F12)

---

## Summary

| Feature | Mock Mode | Real PayPal Mode |
|---------|-----------|------------------|
| **Setup Required** | None | PayPal Client ID |
| **Card Payment** | Mock | Real via PayPal SDK |
| **PayPal Payment** | Mock | Real via PayPal SDK |
| **Transaction IDs** | MOCK_* format | Real PayPal IDs |
| **Money Processed** | No | Yes (test or real) |
| **Card Interface** | Mock button | PayPal card fields |
| **Best For** | Development | Testing/Production |
