<?php

namespace App\Repositories\UserActions;

use App\Repositories\DBRepository;
use App\UserAction;

class EloquentUserActionRepository extends DBRepository implements UserActionRepository
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(UserAction $model)
    {
        $this->model = $model;
    }

    public function actions($key, $id)
    {
        return $this->model::where($key, $id)->get();
    }
}