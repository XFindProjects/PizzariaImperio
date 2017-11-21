<?php

namespace Category\Traits;

use Category\Models\Category;

trait Categoryable
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}