<?php

namespace App\Repositories\ShipingRepository;

use App\Repositories\BaseRepository;

class ShipingMethodRepository extends BaseRepository implements ShipingMethodRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel()
    {
        return \App\Models\ShipingMethod::class;
    }
}
