<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 21/11/2017
 * Hora: 10:58:41
 */

namespace Table\Http\Controllers;

use Table\Models\Table;

class DeleteTableController extends Controller
{
    public function destroy(Table $table)
    {
        $this->authorize('delete', $table);

        $this->tableRepository->delete($table);

        return response([
            'message' => __('Table::responses.table-deleted')
        ]);
    }
}