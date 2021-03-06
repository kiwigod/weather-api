<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

abstract class AbstractRepository
{
    protected string $modelClass;

    protected function query(): Builder
    {
        return $this->modelClass::query();
    }

    /**
     * @throws \Throwable
     */
    public function store(Model $model)
    {
        $model->saveOrFail();

        return $model->{$model->getKeyName()};
    }
}
