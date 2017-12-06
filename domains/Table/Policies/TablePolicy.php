<?php

namespace Table\Policies;


use Model\Support\Policies\BasePolicy;
use Pizzaria\User;

class TablePolicy extends BasePolicy
{
    public function viewOrders(User $user)
    {
        return $this->admin($user);
    }
}