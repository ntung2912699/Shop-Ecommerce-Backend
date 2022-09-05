<?php

namespace App\Repositories\UsersRepository;

use App\Repositories\BaseRepository;

class UsersRepository extends BaseRepository implements UsersRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel()
    {
        return \App\Models\User::class;
    }
}
