<?php

namespace Table\Support\Repositories;

use Table\Models\Table;

class TableRepository
{
    public function create(array $attributes = [])
    {
        return Table::create($attributes);
    }

    public function delete(Table $table)
    {
        return $table->delete();
    }

    public function orders(Table $table)
    {
        return $table->orders()
            ->paginate(20);
    }

    public function get()
    {
        return Table::paginate(20);
    }
}