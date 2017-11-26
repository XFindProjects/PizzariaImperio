<?php

namespace Acl\Http\Controllers;

use Acl\Http\Requests\CreateUsersRequest;
use Pizzaria\Support\Repositories\UsersRepository;
use Pizzaria\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreateUsersController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('Acl::create');
    }

    /**
     * @param CreateUsersRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store(CreateUsersRequest $request)
    {
        event(new Registered($user = $this->userRepository->create($request->all())));

        return response($user, 200);
    }
}