<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 18/11/2017
 * Hora: 2:13:23
 */

namespace Acl\Http\Controllers;

use Acl\Http\Requests\UpdateUsers;
use Pizzaria\Support\Repositories\UsersRepository;
use Pizzaria\User;

class UpdateUsersController extends Controller
{
    public function index(User $user)
    {
        return view('Acl::update', compact('user'));
    }

    public function update(UpdateUsers $request, User $user)
    {
        $user = (new UsersRepository)->update($user, $request->all());

        return response($user);
    }
}