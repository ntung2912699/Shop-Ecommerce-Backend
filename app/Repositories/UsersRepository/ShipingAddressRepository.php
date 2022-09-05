<?php

namespace App\Repositories\UsersRepository;

use App\Repositories\BaseRepository;

class ShipingAddressRepository extends BaseRepository implements ShipingAddressRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel()
    {
        return \App\Models\ShipingAddress::class;
    }
}
