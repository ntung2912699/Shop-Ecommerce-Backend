<?php

namespace App\Repositories\OrdersRepository;

use App\Repositories\BaseRepository;

class OrdersAttributeRepository extends BaseRepository implements OrdersAttributeRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel()
    {
        return \App\Models\OrdersAttribute::class;
    }
}
