<?php

namespace Model\Support\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;
use Pizzaria\User;

abstract class BasePolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return true;
    }

    public function create(User $user)
    {
        return $this->admin($user);
    }

    public function update(User $user, Model $model)
    {
        return $this->admin($user);
    }

    public function delete(User $user, Model $model)
    {
        return $this->admin($user);
    }

    protected function admin(User $user)
    {
        return $user->role == config('acl.roles.admin');
    }
}