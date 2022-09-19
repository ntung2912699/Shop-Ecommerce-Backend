<?php

namespace App\Http\Controllers\API\Orders;

use App\Http\Controllers\Controller;
use App\Repositories\CartRepository\CartsItemsRepository;
use App\Repositories\CartRepository\CartsRepository;
use App\Repositories\OrdersRepository\OrdersAttributeRepository;
use App\Repositories\OrdersRepository\OrdersProductsRepository;
use App\Repositories\OrdersRepository\OrdersRepository;
use Illuminate\Http\Request;
use function Symfony\Component\String\s;

class OrdersController extends Controller
{
    /**
     * @var OrdersRepository
     */
    protected $orderRepository;

    /**
     * @var OrdersProductsRepository
     */
    protected $orderProductRepository;

    /**
     * @var OrdersAttributeRepository
     */
    protected $orderAttributeRepo;

    /**
     * @param OrdersRepository $orderRepository
     * @param OrdersProductsRepository $orderProductRepository
     */
    public function __construct(
        OrdersRepository $orderRepository,
        OrdersProductsRepository $orderProductRepository,
        OrdersAttributeRepository $orderAttributeRepo
    )
    {
        $this->orderRepository = $orderRepository;
        $this->orderProductRepository = $orderProductRepository;
        $this->orderAttributeRepo = $orderAttributeRepo;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $obj = $this->orderRepository->getAll();
            foreach ($obj as $o){
                $order_product = $o->list_order_item;
                foreach ($order_product as $i){
                    $i->list_attribute_order;
                }
            }
            return response()->json(['success' => $obj]);
        }catch ( \Exception $exception ){
            return response()->json(['error' => 'sorry we can do that']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $data_order = $request->all(
                'users_id',
                'address_id',
                'payment_method_id',
                'shiping_method_id',
                'status_id',
                'phone_number',
                'grand_total',
                'note',
            );
            $order_item = $request->all('order_item');
            $order = $this->orderRepository->create($data_order);
            foreach ($order_item as $item){
                $this->create_order_product( $order->id , $order_item);
            }
            return response()->json(['create success'], 201);
        }catch ( \Exception $exception){
            return response()->json(['sorry we can do that'], 401);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $order = $this->orderRepository->find($id);
            return response()->json([ $order], 201 );
        }catch ( \Exception $exception ){
            return response()->json(['sorry we can do that'], 401);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            $order = $this->orderRepository->update( $id, $data );
            return response()->json([$order], 201);
        }catch ( \Exception $exception ){
            return response()->json(['sorry we can do that'], 401);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $this->orderRepository->delete($id);
            return response()->json(['delete success'], 201);
        }catch (\Exception $exception){
            return response()->json(['sorry we can do that'], 401);
        }
    }

    /**
     * @param $request
     * @return bool
     */
    public function create_order_product($order_id, $request)
    {
       try{
           $data_order_products =  $request->all(
               'products_id',
               'price',
               'quantity',
               'total',
           );
           $data_order_products['orders_id'] = $order_id;
           $order_product = $this->orderProductRepository->create($data_order_products);
           $this->save_attribute_order(
               $order_product->id,
               $request->input('attribute_value_id')
           );
           return true;
       }catch (\Exception $exception){
           return false;
       }
    }

    /**
     * @param $order_product_id
     * @param $attribute_value_id
     * @return bool
     */
    public function save_attribute_order($order_product_id, $attribute_value_id)
    {
        $array = explode(',', $attribute_value_id);
        $data['orders_products_id'] = $order_product_id;
        foreach ($array as $item){
            $data['attribute_value_id'] = $item;
            $this->orderAttributeRepo->create($data);
        }
        return true;
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update_status_order($id, Request $request)
    {
        try {
            $status_id = $request->all('status_id');
            $order = $this->orderRepository->find($id);
            if ($status_id['status_id'] <= $order->status_id){
                return response()->json(['sorry we can do that'], 401);
            }
            $this->orderRepository->update($id, $status_id);
            return response()->json(['update success'], 201);
        }catch (\Exception $exception)
        {
            return response()->json(['sorry we can do that'], 401);
        }
    }
}
