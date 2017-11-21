<?php

namespace Table\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Pizzaria\User;
use Table\Models\Table;

class TablePolicy
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

    public function delete(User $user, Table $table)
    {
        return $this->admin($user);
    }

    public function viewOrders(User $user, Table $table)
    {
        return $this->admin($user);
    }

    protected function admin(User $user)
    {
        return $user->role == config('acl.roles.admin');
    }
}