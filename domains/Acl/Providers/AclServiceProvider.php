<?php

namespace Acl;

use Illuminate\Support\ServiceProvider;

class AclServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Migrations');
    }

    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}