<?php

namespace Torondor\LaravelAdvertising\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AbstractRepository
 * @package Iconx\Advertising\Repositories
 */
abstract class AbstractRepository
{
    /**
     * @var Model
     */
    public $model;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Returns all records
     *
     * @param array $columns
     * @param bool $withTrashed
     * @return array
     */
    public function all(array $columns = ['*'], $withTrashed = false)
    {
        return $withTrashed ?
            $this->model->withTrashed()->get($columns) :
            $this->model->all($columns);
    }

    /**
     * @param $id
     * @param array $columns
     * @param bool $withTrashed
     * @return mixed
     */
    public function find($id, array $columns = ['*'], $withTrashed = false)
    {
        return
            $withTrashed ?
                $this->model->withTrashed()->find($id, $columns) :
                $this->model->find($id, $columns);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return \Illuminate\Pagination\Paginator
     */
    public function paginate($perPage = 10, array $columns = ['*'])
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * @param $method
     * @param $args
     * @return mixed
     */
    public function __call($method, $args)
    {
        return call_user_func_array([$this->model, $method], $args);
    }
}
