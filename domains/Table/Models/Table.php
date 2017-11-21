<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 21/11/2017
 * Hora: 10:33:30
 */

namespace Table\Models;

use Illuminate\Database\Eloquent\Model;
use Order\Models\Order;
use Table\Traits\Tableable;

/**
 * Table\Models\Table
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read mixed $read_orders_path
 * @property-read \Illuminate\Database\Eloquent\Collection|\Order\Models\Order[] $orders
 * @method static \Illuminate\Database\Eloquent\Builder|\Table\Models\Table whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Table\Models\Table whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Table\Models\Table whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read mixed $delete_path
 */
class Table extends Model
{
    use Tableable;

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}