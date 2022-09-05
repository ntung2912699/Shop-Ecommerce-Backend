<?php

namespace App\Repositories\ShipingRepository;

use App\Repositories\BaseRepository;

class TransportersRepository extends BaseRepository implements TransportersRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Transporters::class;
    }
}
