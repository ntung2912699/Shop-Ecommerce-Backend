<?php

namespace App\Repositories\PaymentRepository;

use App\Repositories\BaseRepository;

class PaymentInfoRepository extends BaseRepository implements PaymentInfoRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel()
    {
        return \App\Models\PaymentInfo::class;
    }
}
