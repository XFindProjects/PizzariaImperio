<?php

namespace Size\Traits;

trait hasRouteMethods
{
    protected static $routeMethods = [
        'update',
        'delete',
    ];

    protected static $staticRouteMethods = [
        'create',
        'read'
    ];

    private static $routeExcludes = [

    ];

    /*public static function createPath()
    {
        return route(self::generateRouteName('create'));
    }

    public static function readPath()
    {
        return route(self::generateRouteName('read'));
    }*/

    public function getUpdatePathAttribute()
    {
        return route(self::generateRouteName('update'), $this);
    }

    public function getDeletePathAttribute()
    {
        return route(self::generateRouteName('delete'), $this);
    }

    public static function generateNamespace()
    {
        return basename(self::class);
    }

    public static function generateSlugNamespace()
    {
        return str_slug(str_plural(self::generateNamespace()));
    }

    public static function generateRouteName($method)
    {
        $namespace = self::generateNamespace();
        $slug = self::generateSlugNamespace();
        return "{$namespace}::$method-$slug.$method";
    }

    public static function __callStatic($method, $paremeters)
    {
        if (str_is('*Path', $method)) {
            //  TODO: Finish logic for dynamic path call
            return self::allowedPath($method);
        }

        parent::__callStatic($method, $paremeters);
    }

    public static function allowedPath($method)
    {
        return self::inRoutes($method);
    }

    public static function inRoutes($method)
    {
        $method = str_replace('Path', '', $method);
        return collect(self::$staticRouteMethods)
            ->contains(function($value) use ($method) {
                return $value == $method;
            });
    }
}