<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 20/11/2017
 * Hora: 0:8:34
 */

namespace Order\Models;

use Illuminate\Database\Eloquent\Model;
use Model\Support\Traits\HasFactory;

/**
 * Order\Models\Order
 *
 * @property int $id
 * @property int $table
 * @property string|null $observations
 * @property int $closed
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Order\Models\OrderItem[] $items
 * @method static \Illuminate\Database\Eloquent\Builder|\Order\Models\Order whereClosed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Order\Models\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Order\Models\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Order\Models\Order whereObservations($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Order\Models\Order whereTable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Order\Models\Order whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $table_id
 * @method static \Illuminate\Database\Eloquent\Builder|\Order\Models\Order whereTableId($value)
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
      'table_id',
      'observations',
      'closed',
      'created_at',
      'updated_at'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function observations()
    {
        return $this->hasManyThrough(OrderItemObservation::class, OrderItem::class);
    }
}
