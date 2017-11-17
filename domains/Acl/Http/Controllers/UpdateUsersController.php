<?php

namespace Acl\Http\Controllers;

use Acl\Http\Requests\UpdateUsers;
use App\Support\Repositories\UsersRepository;
use App\User;

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