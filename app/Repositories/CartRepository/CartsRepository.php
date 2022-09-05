<?php

namespace App\Repositories\CartRepository;

use App\Repositories\BaseRepository;

class CartsRepository extends BaseRepository implements CartsRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Carts::class;
    }

    /**
     * @param $users_id
     * @return mixed
     */
    public function confirm_cart($users_id){
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
