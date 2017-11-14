<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as BaseHandler;

abstract class ExceptionHandler extends BaseHandler
{
    use RenderHandler;

    /**
     * All the Custom Handlers
     * @var array
     */
    protected $handlers = [
//        'App\Exceptions\ExampleException' => 'App\Handlers\ExampleHandler'
    ];
}