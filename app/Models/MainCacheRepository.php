<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class AbstractCachedRepository
 * @package Hurma\Core\Model
 *
 * @abstract
 */
abstract class MainCacheRepository extends MainRepository
{
    /** @var Model[] */
    private static $cache = [];

    /**
     * @param int $id
     *
     * @return Model
     *
     * @throws ModelNotFoundException
     */
    public function findById(int $id): Model
    {
        $modelClass = get_class($this->model);
        $cacheKey = "{$modelClass}:$id";
        if (isset(self::$cache[$cacheKey])) {
            return self::$cache[$cacheKey];
        }

        $model = parent::findById($id);
        self::$cache[$cacheKey] = $model;
        return $model;
    }
}
