<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 20/11/2017
 * Hora: 23:20:15
 */

namespace Category\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Pizza\Models\Pizza;
use Size\Traits\Sizeable;

/**
 * Category\Models\Category
 *
 * @mixin \Eloquent
 */
class Category extends Model
{
    use Sluggable, Sizeable;


    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function pizzas()
    {
        return $this->hasMany(Pizza::class);
    }
}
