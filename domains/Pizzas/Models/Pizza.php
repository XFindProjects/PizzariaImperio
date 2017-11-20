<?php

namespace Pizzas\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Ingredients\Models\Ingredient;

/**
 * Pizzas\Models\Pizza
 *
 * @property int $id
 * @property string $flavor
 * @property string $slug
 * @property string $image
 * @property string $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Ingredients\Models\Ingredient[] $ingredients
 * @method static \Illuminate\Database\Eloquent\Builder|\Pizzas\Models\Pizza findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\Pizzas\Models\Pizza whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Pizzas\Models\Pizza whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Pizzas\Models\Pizza whereFlavor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Pizzas\Models\Pizza whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Pizzas\Models\Pizza whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Pizzas\Models\Pizza whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Pizzas\Models\Pizza whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Pizza extends Model
{
    use Sluggable;

    public function ingredients()
    {
        return $this->morphToMany(Ingredient::class, 'ingredientable');
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
              'source' => 'flavor'
          ]
        ];
    }
}
