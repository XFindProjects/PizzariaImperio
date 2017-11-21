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
