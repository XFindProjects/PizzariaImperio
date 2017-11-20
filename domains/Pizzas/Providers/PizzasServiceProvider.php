<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 18/11/2017
 * Hora: 2:1:18
 */

namespace Pizzas\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Pizzas\Faker\IngredientProvider;
use Pizzas\Faker\SlavorProvider;

class PizzasServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'Pizzas');
        $this->registerFakerProviders();
        $this->publishes([
            __DIR__ . '/../Resources/lang' =>   resource_path('lang/vendor/Pizzas'),
        ], 'pizzas');

        if ($this->app->runningInConsole()) {
            $this->commands([
                // The commands
            ]);
        }
    }

    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->registerFactories();
    }

    public function registerFactories()
    {
        $this->app->make(Factory::class)->load(__DIR__ . '/../Factories');
    }

    public function registerFakerProviders()
    {
        $faker = resolve('Faker\Generator');
        $faker->addProvider(new SlavorProvider($faker));
    }
}