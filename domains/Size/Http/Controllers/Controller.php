<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 20/11/2017
 * Hora: 23:48:54
 */

namespace Size\Http\Controllers;

use Pizzaria\Http\Controllers\Controller as BaseController;
use Size\Support\Repositories\SizeRepository;

class Controller extends BaseController
{
    protected $sizeRepository;

    public function __construct(SizeRepository $sizeRepository)
    {
        $this->sizeRepository = $sizeRepository;
    }
}