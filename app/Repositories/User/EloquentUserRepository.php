<?php

namespace App\Repositories\User;

use App\Repositories\DBRepository;
use App\Repositories\FilterableInterface;
use App\User;

class EloquentUserRepository extends DBRepository implements UserRepository, FilterableInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function pluck($column, $key)
    {
        return $this->model::get()->pluck($column, $key);
    }

    public function deleted()
    {
        return $this->model::onlyTrashed()->get();
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