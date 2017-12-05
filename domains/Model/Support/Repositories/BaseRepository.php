<?php

namespace Model\Support\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseRepository
 * @package Model\Support\Repositories
 */
abstract class BaseRepository
{
    /**
     * @return string
     */
    abstract public function getModel(): string;

    /**
     * @var
     */
    public $query;

    /**
     * @return Model
     */
    public function getModelInstance(): Model
    {
        return resolve($this->getModel());
    }

    /**
     * @return mixed
     */
    public function getQuery(): Builder
    {
        return $this->query ?? $this->createQuery()->getQuery();
    }

    /**
     * @param mixed $query
     * @return $this
     */
    public function setQuery($query)
    {
        $this->query = $query;

        return $this;
    }

    /**
     * @return $this
     */
    public function createQuery()
    {
        $this->setQuery(resolve($this->getModel())->getQuery());

        return $this;
    }

    /**
     * @param array $params
     * @return $this
     */
    public function where(...$params)
    {
        $this->setQuery($this->getQuery()->where(...$params));

        return $this;
    }

    /**
     * @param array $attributes
     * @return $this
     */
    public function orWhere($attributes = [])
    {
        $this->setQuery($this->getQuery()->orWhere($attributes));

        return $this;
    }

    /**
     * @param null $limit
     * @return $this
     */
    public function limit($limit = null)
    {
        if (!is_null($limit)) {
            $this->setQuery($this->getQuery()->limit($limit));
        }

        return $this;
    }

    public function has(...$params)
    {
        $this->setQuery($this->getQuery()->has(...$params));

        return $this;
    }

    public function whereHas(...$params)
    {
        return $this->setQuery($this->getQuery()->whereHas(...$params));
    }

    /**
     * @param array $attributes
     * @return bool
     */
    public function exists($attributes = [])
    {
        $this->where($attributes);

        return $this->getQuery()->exists();
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function create($attributes = [])
    {
        $model = $this->getModelInstance();

        collect($attributes)
            ->each(function ($value, $attribute) use ($model) {
                $model->setAttribute($attribute, $value);
            });

        $model->save();

        return $model;
    }

    /**
     * @param Model $model
     * @param array $attributes
     * @return Model
     */
    public function updateModel(Model $model, $attributes = [])
    {
        $model->update($attributes);

        return $model;
    }

    /**
     * @param array $attributes
     * @return $this
     */
    public function update($attributes = [])
    {
        $this->getQuery()->update($attributes);

        return $this;
    }

    /**
     * @param array $attributes
     * @return $this
     */
    public function updateWhere($attributes = [])
    {
        $this->where($attributes)->update();

        return $this;
    }

    /**
     * @param Model $model
     * @return bool|null
     */
    public function deleteModel(Model $model)
    {
        return $model->delete();
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        return $this->getQuery()->delete();
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function deleteWhere($attributes = [])
    {
        $this->where($attributes);

        return $this->delete();
    }

    /**
     * @param array $attributes
     * @param array $values
     * @return Model|BaseRepository|null
     */
    public function getOrCreate($attributes = [], $values = [])
    {
        if ($this->exists($attributes)) {
            return $this->findWhere($attributes);
        }

        return $this->create($values);
    }

    /**
     * @param $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage)
    {
        return $this->getQuery()->paginate($perPage);
    }

    /**
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function first($columns = ['*'])
    {
        return $this->getQuery()->first($columns);
    }

    /**
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function get($columns = ['*'])
    {
        return $this->getQuery()->get($columns);
    }

    /**
     * @param $attribute
     * @param string $direction
     * @return $this
     */
    public function orderBy($attribute, $direction = 'asc')
    {
        if (!is_null($attribute) && !is_null($direction)) {
            $this->setQuery($this->getQuery()->orderBy($attribute, $direction));
        }

        return $this;
    }

    /**
     * @param array $attributes
     * @param null $orderBy
     * @param null $orderDirection
     * @param null $limit
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getWhere($attributes = [], $orderBy = null, $orderDirection = null, $limit = null)
    {
        return $this->where($attributes)
            ->orderBy($orderBy, $orderDirection)
            ->limit($limit)
            ->get();
    }

    /**
     * @param array $attributes
     * @param int $perPage
     * @param null $orderBy
     * @param null $orderDirection
     * @param int $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginateWhere($attributes = [], $perPage = 20, $orderBy = null, $orderDirection = null, $limit = 1000)
    {
        return $this->where($attributes)
            ->orderBy($orderBy, $orderDirection)
            ->limit($limit)
            ->paginate($perPage);
    }

    /**
     * @param array $attributes
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function findWhere($attributes = [], $columns = ['*'])
    {
        return $this->where($attributes)
            ->first($columns);
    }
}