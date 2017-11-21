<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 18/11/2017
 * Hora: 2:13:29
 */

namespace Acl\Policies;

use Pizzaria\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \Pizzaria\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $this->admin($user);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \Pizzaria\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $this->admin($user);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \Pizzaria\User  $user
     * @param  \Pizzaria\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        return $this->admin($user);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \Pizzaria\User  $user
     * @param  \Pizzaria\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        return $this->admin($user);
    }

    protected function admin(User $user)
    {
        return $user->role == config('acl.roles.admin');
    }
}
