<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 17/11/2017
 * Hora: 12:22:51
 */

namespace Acl\Http\Controllers;

use Acl\Http\Requests\CreateSizeRequest;
use Pizzaria\Support\Repositories\UsersRepository;
use Pizzaria\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeleteUsersController extends Controller
{
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $this->userRepository->delete($user);

        return response([
            'message' => __('Acl::responses.user-deleted')
        ]);
    }
}