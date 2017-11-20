<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 18/11/2017
 * Hora: 2:1:18
 */

namespace Pizzas\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'Pizzas\Http\Controllers';

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
        Route::prefix('api/pizzas')
            ->middleware(['api', 'auth:api'])
            ->namespace($this->namespace)
            ->name('Pizzas::')
            ->group(__DIR__ . '/../routes/api.php');
    }

    public function mapWebRoutes()
    {
        Route::prefix('/admin/pizzas')
            ->middleware('web')
            ->namespace($this->namespace)
            ->name('Pizzas::')
            ->group(__DIR__. '/../routes/web.php');
    }
}