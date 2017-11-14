<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados, copia é crime!
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 14/11/2017
 * Hora: 3:1:42
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