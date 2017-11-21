<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 20/11/2017
 * Hora: 23:48:54
 */

namespace Size\Providers;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider;

class SizeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'Size');
        $this->publishes([
            __DIR__ . '/../Resources/lang' => resource_path('lang/vendor/Size'),
        ], 'size');

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