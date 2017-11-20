<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 18/11/2017
 * Hora: 2:11:3
 */

namespace Pizzaria\Handlers;

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