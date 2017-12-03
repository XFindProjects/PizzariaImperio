<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 18/11/2017
 * Hora: 2:13:34
 */

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
            ->middleware(['api', 'auth:api'])
            ->namespace($this->namespace)
            ->name('User::')
            ->group(__DIR__ . '/../routes/api.php');
    }

    public function mapWebRoutes()
    {
        Route::prefix('/admin/acl')
            ->middleware('web')
            ->namespace($this->namespace)
            ->name('User::')
            ->group(__DIR__. '/../routes/web.php');
    }
}