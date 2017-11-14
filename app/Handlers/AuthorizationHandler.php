<?php

namespace App\Handlers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class AuthorizationHandler
{
    public function handle(Request $request, AuthorizationException $exception)
    {
        $code = 403;
        if ($exception->getCode() === 403 || $exception->getCode() === 401) {
            $code = $exception->getCode();
        }
        return response([
            'message' => 'Unauthorized'
        ], $code);
    }
}