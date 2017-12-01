<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 1/12/2017
 * Hora: 11:6:33
 */

namespace Model\Support\Traits;

trait HasFactory
{
    /**
     * @param array $attributes
     * @param null $times
     * @return mixed
     */
    public static function fake($attributes = [], $times = null)
    {
        return self::factoryGenerate($times)->make($attributes);
    }

    /**
     * @param array $attributes
     * @param null $times
     * @return mixed
     */
    public static function generate($attributes = [], $times = null)
    {
        return self::factoryGenerate($times)->create($attributes);
    }

    /**
     * @param $times
     * @return \Illuminate\Database\Eloquent\FactoryBuilder
     */
    public static function factoryGenerate($times): \Illuminate\Database\Eloquent\FactoryBuilder
    {
        return factory((new self)->getMorphClass(), $times);
    }
}