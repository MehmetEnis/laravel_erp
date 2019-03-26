<?php

namespace App\Repositories;

interface FilterableInterface
{
    public function deleted();

    public function pluck($column, $key);

    public function has($table, $id);

    public function in($needle, $haystack);
}