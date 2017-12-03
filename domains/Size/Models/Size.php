<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 20/11/2017
 * Hora: 23:51:37
 */

namespace Size\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Model\Support\Traits\HasFactory;
use Model\Support\Traits\HasRouteMethods;

/**
 * Size\Models\Size
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $sizeable_id
 * @property string $sizeable_type
 * @property float $price
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $sizeable
 * @method static \Illuminate\Database\Eloquent\Builder|\Size\Models\Size findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\Size\Models\Size whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Size\Models\Size whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Size\Models\Size whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Size\Models\Size wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Size\Models\Size whereSizeableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Size\Models\Size whereSizeableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Size\Models\Size whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Size\Models\Size whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $deleted_at
 * @property-read mixed $delete_path
 * @property-read mixed $update_path
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\Size\Models\Size onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\Size\Models\Size whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Size\Models\Size withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Size\Models\Size withoutTrashed()
 */
class Size extends Model
{
    use Sluggable, HasRouteMethods, SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'sizeable_type',
        'sizeable_id',
        'price'
    ];

    public function sizeable()
    {
        return $this->morphTo();
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

    function routeMethods(): array
    {
        return [];
    }

    function routeExcludes(): array
    {
        return [];
    }
}
