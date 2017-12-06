<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 18/11/2017
 * Hora: 2:13:29
 */

namespace Acl\Policies;

use Model\Support\Policies\BasePolicy;
use Pizzaria\User;

class UserPolicy extends BasePolicy
{
    public function view(User $user)
    {
        return $this->admin($user);
    }
}
