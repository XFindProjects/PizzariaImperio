<?php

namespace Acl\Traits;

trait Roleable
{
    public static function createPath()
    {
        return route('Acl::create-users.store');
    }

    public function getUpdatePathAttribute()
    {
        return route('Acl::update-users.update', $this);
    }
}