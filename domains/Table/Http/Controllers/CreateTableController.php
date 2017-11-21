<?php

namespace Table\Http\Controllers;

use Table\Models\Table;

class CreateTableController extends Controller
{
    public function store()
    {
        $this->authorize('create', Table::class);

        $table = $this->tableRepository->create();

        return response($table);
    }
}