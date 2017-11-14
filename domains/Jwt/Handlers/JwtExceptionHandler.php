<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados, copia é crime!
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 14/11/2017
 * Hora: 3:16:2
 */

namespace Jwt\Handlers;

use Illuminate\Http\Request;

class JwtExceptionHandler
{
    public function handle(Request $request, $exception)
    {
        return 'Foda-se meu irmão';
    }
}