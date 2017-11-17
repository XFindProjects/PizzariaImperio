<?php

namespace Acl\Http\Controllers;

use Acl\Http\Requests\CreateUsers;
use App\Support\Repositories\UsersRepository;
use App\User;
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
     * @param CreateUsers $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store(CreateUsers $request)
    {
        event(new Registered($user = $this->create($request->all())));

        return response($user, 200);
    }

    /**
     * @param array $data
     * @return User
     */
    private function create(array $data)
    {
        return (new UsersRepository())->create($data);
    }
}