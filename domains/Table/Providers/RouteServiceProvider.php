<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 21/11/2017
 * Hora: 10:30:52
 */

namespace Table\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'Table\Http\Controllers';

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
        Route::prefix('api/table')
            ->middleware(['api', 'auth:api'])
            ->namespace($this->namespace)
            ->name('Table::')
            ->group(__DIR__ . '/../routes/api.php');
    }

    public function mapWebRoutes()
    {
        Route::prefix('/admin/table')
            ->middleware('web')
            ->namespace($this->namespace)
            ->name('Table::')
            ->group(__DIR__. '/../routes/web.php');
    }
}