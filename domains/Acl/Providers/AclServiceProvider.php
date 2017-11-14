<?php

namespace Acl\Providers;

use Illuminate\Support\ServiceProvider;

class AclServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'Acl');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'Acl');
        $this->publishes([
            __DIR__ . '/../config/acl.php' => config_path('acl.php'),
            __DIR__ . '/../Resources/lang' =>   resource_path('lang/vendor/Acl'),
            __DIR__ . '/../Resources/views' =>  resource_path('view/vendor/Acl')
        ], 'acl');

        if ($this->app->runningInConsole()) {
            $this->commands([
               //   The Commands Here
            ]);
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/acl.php', 'Acl'
        );
        $this->app->register(RouteServiceProvider::class);
    }
}