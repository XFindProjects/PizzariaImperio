<?php

namespace Pizza\Models;

use Category\Traits\Categoryable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Ingredient\Models\Ingredient;
use Ingredient\Traits\Ingredientable;
use Model\Support\Traits\HasFactory;
use Order\Traits\Flavorable;

/**
 * Pizza\Models\Pizza
 *
 * @property int $id
 * @property string $flavor
 * @property string $slug
 * @property string $image
 * @property string $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Ingredient\Models\Ingredient[] $ingredients
 * @method static \Illuminate\Database\Eloquent\Builder|\Pizza\Models\Pizza findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\Pizza\Models\Pizza whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Pizza\Models\Pizza whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Pizza\Models\Pizza whereFlavor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Pizza\Models\Pizza whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Pizza\Models\Pizza whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Pizza\Models\Pizza whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Pizza\Models\Pizza whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $category_id
 * @property-read \Category\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\Order\Models\OrderItem[] $order_items
 * @method static \Illuminate\Database\Eloquent\Builder|\Pizza\Models\Pizza whereCategoryId($value)
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\Pizza\Models\Pizza whereDeletedAt($value)
 */
class Pizza extends Model
{
    use Sluggable, Categoryable, Flavorable, Ingredientable, HasFactory;

    protected $fillable = [
        'category_id',
        'flavor',
        'slug',
        'image',
        'description'
    ];

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
