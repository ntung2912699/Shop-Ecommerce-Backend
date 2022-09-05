<?php

namespace App\Repositories\CartRepository;

use App\Repositories\BaseRepository;

class CartsItemsRepository extends BaseRepository implements CartsItemsRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel()
    {
        return \App\Models\CartsItems::class;
    }

    /**
     * @param $product_id
     * @return mixed
     */
    public function get_id_item($product_id){
        $cart_item = $this->model->where('products_id' ,'=', $product_id )->get();
        foreach ($cart_item as $value){
            $cart_item = $value;
        }
        return $cart_item;
    }
}
