<?php

namespace App\Repositories\Client;

use App\Repositories\DBRepository;
use App\Client;
use App\Repositories\FilterableInterface;

class EloquentClientRepository extends DBRepository implements ClientRepository, FilterableInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Client $model)
    {
        $this->model = $model;
    }

    public function deleted()
    {
        return $this->model::onlyTrashed()->get();
    }

    public function pluck($column, $key)
    {
        return $this->model::get()->pluck($column, $key);
    }

    public function has($table, $id)
    {
        return $this->model::whereHas($table,
            function ($query) use ($id) {
                $query->where('id', $id);
            })->get();
    }

    public function in($needle, $haystack)
    {
        return $this->model::whereIn($needle, $haystack)->get();
    }

}