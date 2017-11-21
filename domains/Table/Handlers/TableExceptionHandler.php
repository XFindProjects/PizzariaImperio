<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 21/11/2017
 * Hora: 10:30:16
 */

namespace Table\Handlers;

use Illuminate\Http\Request;

class TableExceptionHandler
{
    public function handle(Request $request, $exception)
    {
        return 'Foda-se meu irmão';
    }
}