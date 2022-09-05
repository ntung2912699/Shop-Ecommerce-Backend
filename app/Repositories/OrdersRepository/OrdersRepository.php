<?php

namespace App\Repositories\OrdersRepository;

use App\Repositories\BaseRepository;
use App\Repositories\OrdersRepository\OrdersRepositoryInterface;

class OrdersRepository extends BaseRepository implements OrdersRepositoryInterface
{
    /**
     * lấy model tương ứng
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Orders::class;
    }

    /**
     * @param $users_id
     * @return mixed
     */
    public function confirm_order($users_id){
        $cart = $this->model->where('users_id' ,'=', $users_id )->exists();
        return $cart;
    }

    /**
     * @param $users_id
     * @return mixed
     */
    public function get_cart($users_id){
        $cart = $this->model->where('users_id' ,'=', $users_id )->get();
        foreach ($cart as $value){
            $cart = $value['id'];
        }
        return $cart;
    }
}
