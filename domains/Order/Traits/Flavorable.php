<?php

namespace Order\Traits;

use Order\Models\OrderItem;

trait Flavorable
{
    public function order_items()
    {
        return $this->morphToMany(OrderItem::class, 'flavorable');
    }
}