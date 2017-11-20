<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 19/11/2017
 * Hora: 23:53:57
 */

namespace DummyDomain\Providers;

use Illuminate\Support\ServiceProvider;

class DummyDomainServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'DummyDomain');
        $this->publishes([
            __DIR__ . '/../Resources/lang' =>   resource_path('lang/vendor/DummyDomain'),
        ], 'dummydomain');

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