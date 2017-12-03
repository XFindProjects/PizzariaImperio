<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 3/12/2017
 * Hora: 13:26:44
 */

namespace Model\Support\Traits;

use Illuminate\Support\Collection;

trait HasRouteMethods
{
    /**
     * @var array
     */
    public $defaultRouteMethods = [
        'update',
        'delete',
        'create',
        'read'
    ];

    abstract function routeMethods(): array;

    abstract function routeExcludes(): array;

    /*public static function createPath()
    {
        return route(self::generateRouteName('create'));
    }

    public static function readPath()
    {
        return route(self::generateRouteName('read'));
    }*/

    /*public function getUpdatePathAttribute()
    {
        return route(self::generateRouteName('update'), $this);
    }

    public function getDeletePathAttribute()
    {
        return route(self::generateRouteName('delete'), $this);
    }*/

    /**
     * @return string
     */
    public static function generateNamespace()
    {
        return basename(self::class);
    }

    /**
     * @return string
     */
    public static function generateSlugNamespace()
    {
        return str_slug(str_plural(self::generateNamespace()));
    }


    /**
     * @param $method
     * @param $parameters
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        if (str_is('*Path', $method)) {
            $model = new self;
            return $model->$method(...$parameters);
        }

        return parent::__callStatic($method, $parameters);
    }

    /**
     * @param $method
     * @param $parameters
     * @return string
     */
    public function __call($method, $parameters)
    {
        if (str_is('*Path', $method)) {
            if ($this->allowedPath($method)) {
                if (!!$this->id) {
                    return $this->resolve($method, $this, ...$parameters);
                }
                return $this->resolve($method, ...$parameters);
            }
            $this->reject($method);
        }

        return parent::__call($method, $parameters);
    }

    /**
     * @param $method
     * @return bool
     */
    public function allowedPath($method)
    {
        return $this->inRoutes($method);
    }

    /**
     * @param $method
     * @return bool
     */
    public function inRoutes($method)
    {
        $method = str_replace('Path', '', $method);
        return $this->allowedRoutes()
            ->contains(function ($value) use ($method) {
                return $value == $method;
            });
    }

    /**
     * @param $method
     * @param $parameters
     * @return string
     */
    public function resolve($method, ...$parameters)
    {
        return route(self::generateRouteName(str_replace('Path', '', $method)), $parameters);
    }

    /**
     * @param $method
     * @throws \Exception
     */
    public function reject($method)
    {
        Throw new \Exception('Não existe uma rota para o metodo ' . $method);
    }

    /**
     * @param $method
     * @return string
     */
    public function generateRouteName($method)
    {
        $namespace = self::generateNamespace();
        $slug = self::generateSlugNamespace();
        return "{$namespace}::$method-$slug.$method";
    }

    /**
     * @return Collection
     */
    public function allowedRoutes()
    {
        return collect($this->defaultRouteMethods)
            ->merge($this->routeMethods())
            ->except($this->routeExcludes());
    }
}