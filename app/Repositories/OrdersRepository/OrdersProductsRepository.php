<?php

namespace App\Repositories\OrdersRepository;

use App\Repositories\BaseRepository;

class OrdersProductsRepository extends BaseRepository implements OrdersProductsRepositoryInterface
{

    /**
     * @return string
     */
    public function getModel()
    {
        return \App\Models\OrdersProducts::class;
    }

    /**
     * @param $product_id
     * @param $attributes_value_id
     * @return mixed
     */
    public function get_item($product_id, $attributes_value_id)
    {
        return $this->model
            ->where('products_id', '=', $product_id)
            ->where('attributes_value_id' , '=' , $attributes_value_id)
            ->exists();
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
