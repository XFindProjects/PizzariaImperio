<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 25/11/2017
 * Hora: 22:53:36
 */

namespace Size\Http\Controllers;

use Size\Models\Size;

class ReadSizeController extends Controller
{
    public function index()
    {
        $this->authorize('view', Size::class);

        $sizes = $this->sizeRepository->getSizes();

        if (request()->ajax()) {
            return $sizes;
        }

        return view('Size::read', compact('sizes'));
    }
}