<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 18/11/2017
 * Hora: 2:13:21
 */

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

    public function getAdminAreaPathAttribute()
    {
        switch ($this->role) {
            case 1:
                return '/admin/pedidos';
            case 2:
                return '/admin/pizzas';
            case 3:
                return '/admin/porcoes';
            case 4:
                return '/admin/sucos';
            case 5:
                return '/admin';
        }
    }
}