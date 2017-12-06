<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 18/11/2017
 * Hora: 2:10:7
 */

namespace Pizzaria\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'Pizzaria\User' => 'Acl\Policies\UserPolicy',
        'Table\Models\Table' => 'Table\Policies\TablePolicy',
        'Size\Models\Size' => 'Size\Policies\SizePolicy',
        'Pizza\Models\Pizza' => 'Pizza\Policies\PizzaPolicy',
        'Ingredient\Models\Ingredient' => 'Ingredient\Policies\IngredientPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
