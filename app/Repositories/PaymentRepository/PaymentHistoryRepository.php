<?php

namespace App\Repositories\PaymentRepository;

use App\Repositories\BaseRepository;

class PaymentHistoryRepository extends BaseRepository implements PaymentHistoryRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel()
    {
        return \App\Models\PaymentHistory::class;
    }
}
