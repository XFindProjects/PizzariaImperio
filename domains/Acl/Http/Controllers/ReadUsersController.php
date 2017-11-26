<?php

namespace Acl\Http\Controllers;

use Pizzaria\Support\Repositories\UsersRepository;
use Pizzaria\User;
use Illuminate\Http\Request;

class ReadUsersController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view', User::class);

        $users = $this->userRepository->getUsers();

        if ($request->ajax()) {
            return response($users);
        }

        return view('Acl::read', compact('users'));
    }
}