<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 25/11/2017
 * Hora: 22:55:37
 */

namespace Size\Http\Controllers;

use Size\Http\Requests\UpdateSizeRequest;
use Size\Models\Size;

class UpdateSizeController extends Controller
{
    public function update(Size $size, UpdateSizeRequest $request)
    {
        $size = $this->sizeRepository->update($size, $request->all());

        return response($size);
    }
}