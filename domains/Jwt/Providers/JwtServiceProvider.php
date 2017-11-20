<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 18/11/2017
 * Hora: 2:14:6
 */

namespace Jwt\Providers;

use Illuminate\Support\ServiceProvider;

class JwtServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'Jwt');
        $this->publishes([
            __DIR__ . '/../Resources/lang' =>   resource_path('lang/vendor/Jwt'),
        ], 'jwt');

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