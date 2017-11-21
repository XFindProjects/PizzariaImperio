<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 19/11/2017
 * Hora: 22:9:56
 */

namespace Ingredient\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'Ingredients\Http\Controllers';

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
        Route::prefix('api/ingredients')
            ->middleware(['api', 'auth:api'])
            ->namespace($this->namespace)
            ->name('Ingredient::')
            ->group(__DIR__ . '/../routes/api.php');
    }

    public function mapWebRoutes()
    {
        Route::prefix('/admin/ingredients')
            ->middleware('web')
            ->namespace($this->namespace)
            ->name('Ingredient::')
            ->group(__DIR__. '/../routes/web.php');
    }
}