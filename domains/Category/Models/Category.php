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
use Illuminate\Database\Eloquent\SoftDeletes;
use Model\Support\Traits\HasFactory;
use Pizza\Models\Pizza;
use Size\Traits\Sizeable;

/**
 * Category\Models\Category
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Pizza\Models\Pizza[] $pizzas
 * @property-read \Illuminate\Database\Eloquent\Collection|\Size\Models\Size[] $sizes
 * @method static \Illuminate\Database\Eloquent\Builder|\Category\Models\Category findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\Category\Models\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Category\Models\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Category\Models\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Category\Models\Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Category\Models\Category whereUpdatedAt($value)
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\Category\Models\Category onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\Category\Models\Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Category\Models\Category withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Category\Models\Category withoutTrashed()
 */
class Category extends Model
{
    use Sluggable, HasFactory, Sizeable, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'created_at',
        'updated_at'
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
                'source' => 'name'
            ]
        ];
    }

    public function pizzas()
    {
        return $this->hasMany(Pizza::class);
    }
}
