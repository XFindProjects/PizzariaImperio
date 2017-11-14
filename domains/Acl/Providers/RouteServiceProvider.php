<?php

namespace Acl\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'Acl\Http\Controllers';

    public function boot()
    {
        parent::boot();
    }

    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
    }

    public function mapApiRoutes()
    {
        Route::prefix('api/acl')
            ->middleware('api')
            ->namespace($this->namespace)
            ->name('Acl::')
            ->group(__DIR__ . '/../routes/api.php');
    }

    public function mapWebRoutes()
    {
        Route::prefix('/admin/acl')
            ->middleware('web')
            ->namespace($this->namespace)
            ->name('Acl::')
            ->group(__DIR__. '/../routes/web.php');
    }
}