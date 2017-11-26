<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 25/11/2017
 * Hora: 23:27:26
 */

namespace Size\Policies;

use Pizzaria\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SizePolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $this->admin($user);
    }

    protected function admin(User $user)
    {
        return $user->role == config('acl.roles.admin');
    }
}
