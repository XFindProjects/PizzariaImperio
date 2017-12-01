<?php

namespace Size\Support\Repositories;

use Size\Models\Size;

class SizeRepository
{
    public $sizeModel;

    public function __construct(Size $sizeModel)
    {
        $this->sizeModel = $sizeModel;
    }

    public function create(array $data)
    {
        return $this->sizeModel->create([
           'name' => $data['name'],
           'sizeable_type' => $data['sizeable_type'],
           'sizeable_id' => $data['sizeable_id'],
           'price' => $data['price']
        ]);
    }

    public function findBySlug($slug)
    {
        return $this->sizeModel->where('slug', $slug)->first();
    }

    public function getSizes($columns = ['*'], $paginate = true, $perPageOrTake = 20, $orderColumn = 'name', $orderDirection = 'asc')
    {
        $query = $this->sizeModel->orderBy($orderColumn, $orderDirection);

        if ($paginate) {
            return $query->paginate($perPageOrTake);
        } elseif ($perPageOrTake) {
            return $query->take($perPageOrTake);
        }

        return $query->get($columns);
    }

    public function update(Size $size, array $data)
    {
        $payload = collect($data)
            ->filter(function($value, $key) use ($size) {
               return $size->$key != $value;
            });

        $size->update($payload->toArray());

        return $size;
    }

    public function delete(Size $size)
    {
        return $size->delete();
    }
}