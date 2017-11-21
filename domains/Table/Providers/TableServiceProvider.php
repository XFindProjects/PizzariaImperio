<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 21/11/2017
 * Hora: 10:30:34
 */

namespace Table\Providers;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider;

class TableServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'Table');
        $this->publishes([
            __DIR__ . '/../Resources/lang' => resource_path('lang/vendor/Table'),
        ], 'table');

        if ($this->app->runningInConsole()) {
            $this->commands([
                //   The Commands Here
            ]);
        }
    }

    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->make(Factory::class)->load(__DIR__ . '/../Factories');
    }
}