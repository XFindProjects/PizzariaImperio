<?php

namespace Table\Traits;

trait Tableable
{
    public static function createPath()
    {
        return route('Table::create-tables.store');
    }

    public static function readPath()
    {
        return route('Table::read-tables.read');
    }

    public function getReadOrdersPathAttribute()
    {
        return route('Table::read-tables.orders', $this);
    }

    public function getDeletePath()
    {
        return route('Table::delete-tables.delete', $this);
    }
}