<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 19/11/2017
 * Hora: 22:7:50
 */

namespace Ingredient\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Pizza\Models\Pizza;

/**
 * Ingredients\Models\Ingredient
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\Ingredient\Models\Ingredient findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ingredient\Models\Ingredient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ingredient\Models\Ingredient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ingredient\Models\Ingredient whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ingredient\Models\Ingredient whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ingredient\Models\Ingredient whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Ingredient extends Model
{
    use Sluggable, SoftDeletes;

    public function pizzas()
    {
        return $this->morphedByMany(Pizza::class, 'ingredientable');
    }

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
}
