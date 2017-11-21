<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 20/11/2017
 * Hora: 0:22:4
 */

namespace Order\Models;

use Category\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Pizza\Models\Pizza;


/**
 * Order\Models\OrderItem
 *
 * @property-read \Category\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\Order\Models\OrderItemObservation[] $observations
 * @property-read \Order\Models\Order $order
 * @mixin \Eloquent
 * @property int $id
 * @property int $order_id
 * @property int $category_id
 * @property int $size_id
 * @property int $paid
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\Order\Models\OrderItem whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Order\Models\OrderItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Order\Models\OrderItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Order\Models\OrderItem whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Order\Models\OrderItem wherePaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Order\Models\OrderItem whereSizeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Order\Models\OrderItem whereUpdatedAt($value)
 */
class OrderItem extends Model
{
    protected $fillable = [
      'category_id',
      'paid',
      'order_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function observations()
    {
        return $this->hasMany(OrderItemObservation::class);
    }

    public function pizzas()
    {
        return $this->morphedByMany(Pizza::class, 'flavorable');
    }
}
