<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 19/11/2017
 * Hora: 23:59:54
 */

namespace Order\Providers;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider;

class OrderServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'Order');
        $this->publishes([
            __DIR__ . '/../config/orders.php' => config_path('orders.php'),
            __DIR__ . '/../Resources/lang' =>   resource_path('lang/vendor/Order'),
        ], 'order');

        if ($this->app->runningInConsole()) {
            $this->commands([
               //   The Commands Here
            ]);
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/orders.php', 'Orders'
        );

        $this->app->register(RouteServiceProvider::class);
        $this->app->make(Factory::class)->load(__DIR__ . '/../Factories');

    }
}