<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 21/11/2017
 * Hora: 11:0:3
 */

namespace Table\Http\Controllers;

use Table\Models\Table;

class ReadTableController extends Controller
{
    public function read()
    {
        $this->authorize('view', Table::class);

        $tables = $this->tableRepository->get();

        return response($tables);
    }

    public function orders(Table $table)
    {
        $this->authorize('viewOrders', $table);

        $orders = $this->tableRepository->orders($table);

        return response($orders);
    }
}