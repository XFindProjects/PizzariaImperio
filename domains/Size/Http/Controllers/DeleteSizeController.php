<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 25/11/2017
 * Hora: 22:55:46
 */

namespace Size\Http\Controllers;

use Size\Models\Size;

class DeleteSizeController extends Controller
{
    public function destroy(Size $size)
    {
        $this->authorize('delete', $size);

        $this->sizeRepository->delete($size);

        return response([
           'message' => __('Size::responses.size-deleted')
        ]);
    }
}