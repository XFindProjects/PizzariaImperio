<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 20/11/2017
 * Hora: 0:53:59
 */

namespace Order\Models;

use Illuminate\Database\Eloquent\Model;
use Model\Support\Traits\HasFactory;

/**
 * Order\Models\OrderItemObservation
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $order_item_id
 * @property int $observation_type
 * @property string $observation_content
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Order\Models\OrderItem $item
 * @method static \Illuminate\Database\Eloquent\Builder|\Order\Models\OrderItemObservation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Order\Models\OrderItemObservation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Order\Models\OrderItemObservation whereObservationContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Order\Models\OrderItemObservation whereObservationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Order\Models\OrderItemObservation whereOrderItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Order\Models\OrderItemObservation whereUpdatedAt($value)
 */
class OrderItemObservation extends Model
{
    use HasFactory;

    protected $fillable = [
      'order_item_id',
      'observation_type',
      'observation_content'
    ];

    public function item()
    {
        return $this->belongsTo(OrderItem::class);
    }
}
