<?php

namespace App\Repositories\PaymentRepository;

use App\Repositories\BaseRepository;

class PaymentMethodMethodRepository extends BaseRepository implements PaymentMethodRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel()
    {
        return \App\Models\PaymentMethods::class;
    }
}
