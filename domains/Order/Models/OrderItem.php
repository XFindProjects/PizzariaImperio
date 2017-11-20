<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 20/11/2017
 * Hora: 0:22:4
 */

namespace Order\Models;

use Illuminate\Database\Eloquent\Model;
use Pizzas\Models\Pizza;

/**
 * Order\Models\OrderItem
 *
 * @property int $id
 * @property int $orderable_id
 * @property string $orderable_type
 * @property int $paid
 * @property float $price
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int $order_id
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $items
 * @property-read \Order\Models\Order $order
 * @method static \Illuminate\Database\Eloquent\Builder|\Order\Models\OrderItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Order\Models\OrderItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Order\Models\OrderItem whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Order\Models\OrderItem whereOrderableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Order\Models\OrderItem whereOrderableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Order\Models\OrderItem wherePaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Order\Models\OrderItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Order\Models\OrderItem whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Order\Models\OrderItemObservation[] $observations
 */
class OrderItem extends Model
{
    protected $fillable = [
      'orderable_id',
      'orderable_type',
      'paid',
      'price',
      'order_id'
    ];

    public function items()
    {
        return $this->morphTo();
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function observations()
    {
        return $this->hasMany(OrderItemObservation::class);
    }
}
