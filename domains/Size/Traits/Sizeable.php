<?php

namespace Size\Traits;

use Size\Models\Size;

trait Sizeable
{
    public function sizes()
    {
        return $this->morphMany(Size::class, 'sizeable');
    }
}