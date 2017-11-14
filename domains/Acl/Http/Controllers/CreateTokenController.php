<?php

namespace Acl\Http\Controllers;

use Tymon\JWTAuth\Facades\JWTAuth;

class CreateTokenController extends Controller
{
    public function token()
    {
        if (!auth()->check()) {
            return response(['token' => null]);
        }
        return response(
            ['token' => JWTAuth::fromUser(auth()->user())]
        );
    }
}