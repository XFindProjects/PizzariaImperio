<?php

namespace Size\Traits;

trait hasRouteMethods
{
    public static function createPath()
    {
        return route('Size::create-sizes.store');
    }

    public static function readPath()
    {
        return route('Size::read-sizes.read');
    }

    public function getUpdatePathAttribute()
    {
        return route('Size::update-sizes.update', $this);
    }

    public function getDeletePathAttribute()
    {
        return route('Size::delete-sizes.update', $this);
    }
}