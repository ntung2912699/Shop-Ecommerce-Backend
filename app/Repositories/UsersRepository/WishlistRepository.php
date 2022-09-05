<?php

namespace App\Repositories\UsersRepository;

use App\Repositories\BaseRepository;

class WishlistRepository extends BaseRepository implements WishlistRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Wishlits::class;
    }
}
