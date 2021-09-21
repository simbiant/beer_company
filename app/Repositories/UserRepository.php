<?php

namespace App\Repositories;

use App\Models\MainCacheRepository;
use App\User;

class UserRepository extends MainCacheRepository
{
    public function __construct()
    {
        parent::__construct(User::class);
    }

    /**
     * @param int[] $ids
     * @return User[]|Collection
     */
    public function findByIds(array $ids): Collection
    {
        /** @var User[]|Collection $peoples */
        $users = $this
            ->model->newQuery()
            ->whereIn('id', $ids)
            ->get();
        return $users;
    }

}
