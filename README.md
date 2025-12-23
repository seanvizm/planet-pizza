# 🍕 PizzaPlanet - Online Pizza Ordering System

A Laravel 12 application for PizzaPlanet's online pizza ordering platform, demonstrating software engineering principles, design patterns, and clean architecture.

![PizzaPlanet Screenshot](public/images/pizzaplanet_ss.png)

## 📋 Table of Contents

- [Overview](#overview)
- [Business Requirements](#business-requirements)
- [Technical Stack](#technical-stack)
- [Architecture & Design Patterns](#architecture--design-patterns)
- [Installation](#installation)
- [Testing](#testing)
- [API Documentation](#api-documentation)
- [Project Structure](#project-structure)

## 🎯 Overview

PizzaPlanet is a fully functional pizza ordering system built with Laravel 12 and PHP 8.4+. The application features:

- **Multiple Preset Pizzas**: Margherita, Romana, Americana, and Mexicana
- **Custom Pizza Builder**: Create your own pizza with up to 4 toppings
- **Flexible Payment Options**: Card and PayPal payment methods (mocked for demonstration)
- **Price Calculation Engine**: Dynamic pricing based on pizza type and toppings
- **Shopping Cart**: Full cart management with session persistence
- **Order Processing**: Order creation and payment tracking with comprehensive logging

## 📊 Business Requirements

### Available Pizzas

| Pizza | Toppings | Price |
|-------|----------|-------|
| Margherita | No toppings | £10.00 |
| Romana | Ham, Olives, Mushrooms | £13.00 |
| Americana | Bacon, Mince, Pepperoni | £13.00 |
| Mexicana | Spicy Mince, Onion, Green Pepper, Jalapenos | £15.00 |
| Make Your Own | Choose up to 4 toppings | £10.00 + £1.00 per topping |

### Key Features

- ✅ All toppings are interchangeable for "Make Your Own" option
- ✅ Multiple pizzas can be ordered in a single transaction
- ✅ Payment methods: Card and PayPal (mocked with logging)
- ✅ Price displayed for each order
- ✅ Comprehensive unit and feature tests

## 🛠 Technical Stack

- **Framework**: Laravel 12.43.1
- **PHP**: 8.4+
- **Database**: MySQL/SQLite
- **Frontend**: Blade Templates with jQuery
- **Build Tool**: Vite
- **Testing**: PHPUnit

## 🏗 Architecture & Design Patterns

This application demonstrates enterprise-level architecture with multiple design patterns:

### 1. **Repository Pattern**
Abstracts data access logic, making the codebase more maintainable and testable.

```
app/Repositories/
├── OrderRepository.php
├── PizzaRepository.php
└── ToppingRepository.php
```

**Benefits**: 
- Decouples business logic from data access
- Easy to swap data sources
- Simplified unit testing with mocks

### 2. **Strategy Pattern**
Implements flexible payment processing with different payment gateways.

```
app/Services/Payment/
├── PaymentGatewayInterface.php
├── CardPaymentGateway.php
├── PayPalPaymentGateway.php
└── PaymentService.php (Context)
```

**Benefits**:
- Easy to add new payment methods
- Runtime strategy selection
- Open/Closed Principle compliance

### 3. **Service Layer Pattern**
Encapsulates business logic away from controllers.

```
app/Services/
├── CartService.php
└── PizzaPriceCalculator.php
```

**Benefits**:
- Thin controllers
- Reusable business logic
- Single Responsibility Principle

### 4. **Dependency Injection**
Uses Laravel's service container for automatic dependency resolution.

```php
app/Providers/PizzaPlanetServiceProvider.php
```

**Benefits**:
- Loose coupling
- Improved testability
- Flexible configuration

### SOLID Principles Implementation

- **Single Responsibility**: Each service class has one clear purpose (e.g., PizzaPriceCalculator only handles price calculations)
- **Open/Closed**: Payment system uses interface-based design - new payment methods can be added without modifying existing code
- **Liskov Substitution**: All payment gateways implement PaymentGatewayInterface and are fully interchangeable
- **Interface Segregation**: PaymentGatewayInterface is focused with only essential methods
- **Dependency Inversion**: Services depend on abstractions (ToppingRepository, PizzaRepository) rather than concrete implementations

## 🚀 Installation

### Prerequisites

- PHP 8.4 or higher
- Composer
- Node.js & NPM
- MySQL or SQLite database

### Step-by-Step Setup

1. **Clone the repository**
```bash
git clone <repository-url>
cd pizza-planet
```

2. **Install PHP dependencies**
```bash
composer install
```

3. **Install JavaScript dependencies**
```bash
npm install
```

4. **Environment configuration**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configure database**

Edit `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pizzaplanet
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Or use SQLite for quick setup:
```env
DB_CONNECTION=sqlite
# Comment out other DB_ variables
```

6. **Run migrations and seed data**
```bash
php artisan migrate:fresh --seed
```

This will create:
- Database tables
- 5 preset pizzas (including Make Your Own option)
- 12 available toppings

7. **Build frontend assets**
```bash
npm run build
```

For development with hot reload:
```bash
npm run dev
```

8. **Start the application**
```bash
php artisan serve
```

Visit: `http://localhost:8000`

### Optional: Create test user

```bash
php artisan tinker
```

```php
User::create([
    'name' => 'Test User',
    'email' => 'test@pizzaplanet.com',
    'password' => bcrypt('password123')
]);
```

## 🧪 Testing

### Run all tests
```bash
php artisan test
```

### Run specific test suites

**Unit Tests**:
```bash
php artisan test --testsuite=Unit
```

**Feature Tests**:
```bash
php artisan test --testsuite=Feature
```

### Test Coverage

The application includes comprehensive tests for:

- ✅ Pizza price calculation (preset and custom)
- ✅ Topping validation (maximum 4 toppings)
- ✅ Payment processing (Card and PayPal)
- ✅ Cart operations (add, update, remove)
- ✅ Order creation and management
- ✅ Price breakdown calculations

### Example Test Run

```bash
php artisan test

PASS  Tests\Unit\PizzaPriceCalculatorTest
✓ calculates preset pizza price correctly
✓ calculates custom pizza with no toppings
✓ calculates custom pizza with toppings
✓ throws exception for more than four toppings
✓ calculates cart total correctly

PASS  Tests\Unit\PaymentServiceTest
✓ creates payment service with card gateway
✓ creates payment service with paypal gateway
✓ card payment processes successfully
✓ paypal payment processes successfully
```

## 📖 API Documentation

### Cart Management

**Add to Cart**
```php
GET /add-to-cart/{pizzaId}?toppings[]=1&toppings[]=2&quantity=1
```

**View Cart**
```php
GET /cart
```

**Update Quantity**
```php
PATCH /update-cart
Body: { id: 'cart_key', quantity: 2 }
```

**Remove from Cart**
```php
DELETE /remove-from-cart
Body: { id: 'cart_key' }
```

### Order Processing

**Checkout**
```php
GET /checkout
```

**Process Payment & Create Order**
```php
POST /paypal-order
Body: {
    first_name: 'John',
    last_name: 'Doe',
    email: 'customer@example.com',
    contact_no: '+44 7700 900000',
    address: '123 Main St',
    city: 'London',
    state: 'England',
    zip: 'SW1A 1AA',
    payment_method: 'card|paypal',
    transaction_id: 'MOCK_PAYPAL_123456',
    payment_status: 'COMPLETED',
    amount: '25.00',
    cart_items: {...}
}
```

### Payment Methods

Both payment methods are **mocked** and log transactions instead of processing real payments.

Payment logs can be found in `storage/logs/laravel.log`:
```
[2025-12-23] local.INFO: === PAYMENT RECEIVED ===
[2025-12-23] local.INFO: Payment Method: PAYPAL
[2025-12-23] local.INFO: Transaction ID: MOCK_PAYPAL_1734975845
[2025-12-23] local.INFO: Amount: £25.00
[2025-12-23] local.INFO: Customer: John Doe
[2025-12-23] local.INFO: Email: john@example.com
[2025-12-23] local.INFO: Contact: +44 7700 900000
[2025-12-23] local.INFO: Address: 123 Main St
[2025-12-23] local.INFO: City: London
[2025-12-23] local.INFO: State: England
[2025-12-23] local.INFO: Zip: SW1A 1AA
[2025-12-23] local.INFO: Status: COMPLETED
```

## 📁 Project Structure

```
pizza-planet/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── PizzaController.php
│   ├── Models/
│   │   ├── Pizza.php
│   │   ├── Order.php
│   │   └── Topping.php
│   ├── Repositories/          # Repository Pattern
│   │   ├── OrderRepository.php
│   │   ├── PizzaRepository.php
│   │   └── ToppingRepository.php
│   ├── Services/             # Service Layer
│   │   ├── CartService.php
│   │   ├── PizzaPriceCalculator.php
│   │   └── Payment/          # Strategy Pattern
│   │       ├── PaymentGatewayInterface.php
│   │       ├── CardPaymentGateway.php
│   │       ├── PayPalPaymentGateway.php
│   │       └── PaymentService.php
│   └── Providers/
│       └── PizzaPlanetServiceProvider.php  # DI Container
├── database/
│   ├── migrations/
│   └── seeders/
│       ├── PizzaSeeder.php
│       └── ToppingSeeder.php
├── tests/
│   ├── Unit/
│   │   ├── PizzaPriceCalculatorTest.php
│   │   └── PaymentServiceTest.php
│   └── Feature/
│       ├── OrderFeatureTest.php
│       └── CartFeatureTest.php
└── resources/
    └── views/
        └── pizzas/
```

## 🎨 Frontend Features

- Modern, responsive design with dark/light theme
- jQuery and vanilla JavaScript for interactivity
- Real-time cart updates via AJAX
- Interactive pizza customization
- Smooth animations and transitions

## 🔒 Security Features

- CSRF protection on all forms
- Input validation and sanitization
- SQL injection prevention (Eloquent ORM)
- XSS protection (Blade templating)
- Secure password hashing

## 📝 Code Quality

- PSR-12 coding standards
- Comprehensive PHPDoc comments
- Type hints and return types
- Exception handling
- Logging and monitoring

## 🚦 Future Enhancements

- Real PayPal SDK integration (placeholder exists in checkout)
- Email notifications for orders
- Order tracking system
- Admin dashboard for order management
- Delivery time estimation
- Promotions and discount codes
- Customer reviews and ratings
- RESTful API for mobile apps

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👥 Author

Built with ❤️ for PizzaPlanet

---

**Note**: This application is built for demonstration purposes. Payment processing is mocked and does not handle real transactions. For production use, integrate with real payment gateways like Stripe or PayPal's official SDKs.
