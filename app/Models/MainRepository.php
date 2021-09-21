<?php

namespace App\Models;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

abstract class MainRepository
{
    /** @var Model */
    protected $model;

    /**
     * AbstractRepository constructor.
     * @abstract
     * @param string $modelClass
     */
    protected function __construct(string $modelClass)
    {
        $this->model = new $modelClass();
    }

    /**
     * @param int $id
     *
     * @return Model
     *
     * @throws ModelNotFoundException
     */
    public function findById(int $id): Model
    {
        $qb = $this->model->newQuery();
        return $qb->findOrFail($id);
    }

}
