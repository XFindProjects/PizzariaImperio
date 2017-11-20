<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 19/11/2017
 * Hora: 23:59:54
 */

namespace Order\Handlers;

use Illuminate\Http\Request;

class OrderExceptionHandler
{
    public function handle(Request $request, $exception)
    {
        return 'Foda-se meu irmão';
    }
}