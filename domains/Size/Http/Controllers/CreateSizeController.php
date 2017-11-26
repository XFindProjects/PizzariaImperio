<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 25/11/2017
 * Hora: 22:53:40
 */

namespace Size\Http\Controllers;


use Size\Http\Requests\CreateSizeRequest;

class CreateSizeController extends Controller
{
    public function store(CreateSizeRequest $request)
    {
        $size = $this->sizeRepository->create($request->all());

        return response($size);
    }
}