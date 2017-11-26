<?php

namespace Size\Support\Repositories;

use Size\Models\Size;

class SizeRepository
{
    public function create(array $data)
    {
        return Size::create([
           'name' => $data['name'],
           'sizeable_type' => $data['sizeable_type'],
           'sizeable_id' => $data['sizeable_id'],
           'price' => $data['price']
        ]);
    }
}