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
use Model\Support\Traits\HasFactory;
use Model\Support\Traits\HasRouteMethods;
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
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\Ingredient\Models\Ingredient onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\Ingredient\Models\Ingredient whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Ingredient\Models\Ingredient withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Ingredient\Models\Ingredient withoutTrashed()
 * @method string path($method)
 */
class Ingredient extends Model
{
    use Sluggable, HasFactory, SoftDeletes, HasRouteMethods;

    protected $fillable = [
      'name',
      'slug',
      'created_at',
      'updated_at'
    ];

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

    /**
     * @return array
     */
    function routeMethods(): array
    {
        return [];
    }

    /**
     * @return array
     */
    function routeExcludes(): array
    {
        return [];
    }
}
