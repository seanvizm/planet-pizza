<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\OrderRepository;
use App\Repositories\PizzaRepository;
use App\Repositories\ToppingRepository;
use App\Services\OrderService;
use App\Services\CartService;
use App\Services\PizzaPriceCalculator;

/**
 * PizzaPlanet Service Provider
 * Implements Dependency Injection Container pattern
 * Registers all application services and repositories
 */
class PizzaPlanetServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register Repositories as Singletons
        $this->app->singleton(OrderRepository::class, function ($app) {
            return new OrderRepository();
        });

        $this->app->singleton(PizzaRepository::class, function ($app) {
            return new PizzaRepository();
        });

        $this->app->singleton(ToppingRepository::class, function ($app) {
            return new ToppingRepository();
        });

        // Register Services
        $this->app->bind(PizzaPriceCalculator::class, function ($app) {
            return new PizzaPriceCalculator(
                $app->make(ToppingRepository::class),
                $app->make(PizzaRepository::class)
            );
        });

        $this->app->bind(CartService::class, function ($app) {
            return new CartService(
                $app->make(PizzaRepository::class),
                $app->make(ToppingRepository::class),
                $app->make(PizzaPriceCalculator::class)
            );
        });

        $this->app->bind(OrderService::class, function ($app) {
            return new OrderService(
                $app->make(OrderRepository::class),
                $app->make(PizzaPriceCalculator::class)
            );
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

