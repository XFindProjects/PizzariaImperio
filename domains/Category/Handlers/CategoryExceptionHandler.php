<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 20/11/2017
 * Hora: 23:1:47
 */

namespace Category\Handlers;

use Illuminate\Http\Request;

class CategoryExceptionHandler
{
    public function handle(Request $request, $exception)
    {
        return 'Foda-se meu irmão';
    }
}