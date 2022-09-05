<?php

namespace App\Repositories\OrdersRepository;

use App\Repositories\BaseRepository;

class OrdersStatusRepository extends BaseRepository implements OrdersStatusRepositoryInterface
{

    /**
     * @return string
     */
    public function getModel()
    {
        return \App\Models\OrderStatus::class;
    }
}
