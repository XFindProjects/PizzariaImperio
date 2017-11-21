<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 19/11/2017
 * Hora: 22:8:53
 */

namespace Ingredient\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Ingredient\Faker\IngredientProvider;

class IngredientsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'Ingredient');
        $this->registerFakerProviders();
        $this->publishes([
            __DIR__ . '/../Resources/lang' =>   resource_path('lang/vendor/Ingredient'),
        ], 'ingredient');

        if ($this->app->runningInConsole()) {
            $this->commands([
                // The commands
            ]);
        }
    }

    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->make(Factory::class)->load(__DIR__ . '/../Factories');
    }

    public function registerFakerProviders()
    {
        $faker = resolve('Faker\Generator');
        $faker->addProvider(new IngredientProvider($faker));
    }
}