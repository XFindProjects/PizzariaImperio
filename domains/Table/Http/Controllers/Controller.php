<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 21/11/2017
 * Hora: 10:30:52
 */

namespace Table\Http\Controllers;

use Pizzaria\Http\Controllers\Controller as BaseController;
use Table\Support\Repositories\TableRepository;

class Controller extends BaseController
{
    protected $tableRepository;

    public function __construct(TableRepository $tableRepository)
    {
        $this->tableRepository = $tableRepository;
    }
}