<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados, copia é crime!
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 14/11/2017
 * Hora: 3:1:56
 */

namespace Jwt\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'Jwt\Http\Controllers';

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
        Route::prefix('api/jwt')
            ->middleware(['api', 'auth:api'])
            ->namespace($this->namespace)
            ->name('Jwt::')
            ->group(__DIR__ . '/../routes/api.php');
    }

    public function mapWebRoutes()
    {
        Route::prefix('/admin/jwt')
            ->middleware('web')
            ->namespace($this->namespace)
            ->name('Jwt::')
            ->group(__DIR__. '/../routes/web.php');
    }
}