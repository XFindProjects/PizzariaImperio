<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 20/11/2017
 * Hora: 23:1:47
 */

namespace Category\Providers;

use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'Category');
        $this->publishes([
            __DIR__ . '/../Resources/lang' => resource_path('lang/vendor/Category'),
        ], 'category');

        if ($this->app->runningInConsole()) {
            $this->commands([
                //   The Commands Here
            ]);
        }
    }

    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}