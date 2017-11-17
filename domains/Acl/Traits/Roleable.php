<?php

namespace Acl\Traits;

trait Roleable
{
    public static function createPath()
    {
        return route('Acl::create-users.store');
    }

    public static function readPath()
    {
        return route('Acl::read-users.read');
    }

    public function getUpdatePathAttribute()
    {
        return route('Acl::update-users.update', $this);
    }

    public function getDeletePathAttribute()
    {
        return route('Acl::delete-users.delete', $this);
    }
}