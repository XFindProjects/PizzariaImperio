<?php

namespace Acl\Http\Controllers;

use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreateUsersController extends Controller
{
    public function index()
    {
        return view('Acl::create');
    }

    public function store(Request $request)
    {

//        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return response($user, 200);
    }

    public function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|integer|between:1,5'
        ]);
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
            'slug' => $data['name']
        ]);
    }
}