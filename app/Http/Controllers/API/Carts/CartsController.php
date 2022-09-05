<?php

namespace App\Http\Controllers\API\Carts;

use App\Http\Controllers\Controller;
use App\Repositories\CartRepository\CartAttributeRepository;
use App\Repositories\CartRepository\CartsItemsRepository;
use App\Repositories\CartRepository\CartsRepository;
use App\Repositories\ProductsRepository\AttributesRepository;
use App\Repositories\ProductsRepository\AttributeValueRepository;
use App\Repositories\ProductsRepository\ProductsRepository;
use App\Repositories\UsersRepository\UsersRepository;
use Illuminate\Http\Request;

class CartsController extends Controller
{
    /**
     * @var UsersRepository
     */
    protected $userRepository;

    /**
     * @var ProductsRepository
     */
    protected $productRepository;

    /**
     * @var AttributeValueRepository
     */
    protected $attributevalueRepository;

    /**
     * @var AttributesRepository
     */
    protected $attributeRepository;

    /**
     * @var CartsRepository
     */
    protected $cartRepository;

    /**
     * @var CartsItemsRepository
     */
    protected $cartItemRepository;

    /**
     * @var CartAttributeRepository
     */
    protected $cartAttributeRepo;

    /**
     * @param CartsRepository $cartRepository
     * @param CartsItemsRepository $cartsItemsRepository
     * @param CartAttributeRepository $cartAttributeRepo
     * @param UsersRepository $userRepository
     * @param ProductsRepository $productRepository
     * @param AttributeValueRepository $attributeValueRepository
     * @param AttributesRepository $attributeRepository
     */
    public function __construct(
        CartsRepository $cartRepository,
        CartsItemsRepository $cartsItemsRepository,
        CartAttributeRepository $cartAttributeRepo,
        UsersRepository $userRepository,
        ProductsRepository $productRepository,
        AttributeValueRepository $attributeValueRepository,
        AttributesRepository $attributeRepository
    )
    {
        $this->cartRepository = $cartRepository;
        $this->cartItemRepository = $cartsItemsRepository;
        $this->cartAttributeRepo = $cartAttributeRepo;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->attributevalueRepository = $attributeValueRepository;
        $this->attributeRepository = $attributeRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $obj = $this->cartRepository->getAll();
            foreach ($obj as $o){
                $item = $o->list_cart_item;
                foreach ($item as $i){
                    $i->list_attribute_cart;
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
            $cart_data = $request->all('users_id');
            $check_cart = $this->cartRepository->confirm_cart($cart_data);
            if ($check_cart === false) {
                $cart = $this->cartRepository->create($cart_data);
                $item_cart_data =
                [
                    'carts_id' => $cart->id,
                    'products_id' => $request->input('products_id'),
                    'price' => $request->input('price'),
                    'quantity' => $request->input('quantity')
                ];
                $cart_item = $this->cartItemRepository->create($item_cart_data);
                $this->save_cart_attribute( $cart_item->id, $request->input('attributes_value_id'));
                return response()->json(['success' => 'create new cart successfully']);
            }else{
                $this->update_item_cart(
                    $cart_data,
                    $request
                );
                return response()->json(['success' => 'item add cart successfully'], 201);
            }
        }catch ( \Exception $exception){
            return response()->json(['error' => 'create cart unsuccessfully'], 501);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $obj = $this->cartRepository->find($id);
            return response()->json([ 'success' => $obj ]);
        }catch ( \Exception $exception ){
            return response()->json(['error' => 'sorry we can do that']);
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
            $obj = $this->cartRepository->update( $id, $data );
            return response()->json(['success' => 'update cart success', $obj]);
        }catch ( \Exception $exception ){
            return response()->json(['error' => 'create cart unsuccessfully']);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $this->cartRepository->delete($id);
            return response()->json(['success' => 'delete cart successfully']);
        }catch (\Exception $exception){
            return response()->json(['error' => 'sorry we can do that']);
        }
    }

    /**
     * @param $cart_data
     * @param $request
     * @return bool
     */
    public function update_item_cart($cart_data, $request)
    {
        $id_cart = $this->cartRepository->get_cart($cart_data);
        $item_cart_data = [
            'carts_id' => $id_cart,
            'products_id' => $request->input('products_id'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity')
        ];
        $cart = $this->cartRepository->find($id_cart);
        $cart_items = $cart->list_cart_item;
        $attributes_value_id = $request->input('attributes_value_id');
        $id_items = null;
        foreach ($cart_items as $item){
            if ( $item->products_id === $item_cart_data['products_id'])
            {
                $id_items = $item->id;
                $cart_attribute_arr = explode(',', $attributes_value_id);
                foreach ($cart_attribute_arr as $value_attr){
                    $cart_attribute_compare =
                        $this->cartAttributeRepo
                            ->compare_item_attribute( $item->id, $value_attr);
                    if ($cart_attribute_compare === true)
                    {
                        $result['yes'] = 1;
                    }
                }
            }
        }
        if (isset($result['yes']))
        {
            $data_update['quantity'] = $item->quantity + $item_cart_data['quantity'];
            $this->cartItemRepository->update($id_items, $data_update);
            return true;
        }
        $cart_item = $this->cartItemRepository->create($item_cart_data);
        $this->save_cart_attribute($cart_item->id, $attributes_value_id);
        return true;
    }

    public function remove_item_cart($id){
        try {
            $items = $this->cartItemRepository->find($id);
            $list_attr_value = $items->list_attribute_cart;
            foreach ($list_attr_value as $value){
                $id_attr = $value->id;
                $this->cartAttributeRepo->delete($id_attr);
            }
            $this->cartItemRepository->delete($id);
            return response()->json(['success' => 'delete item cart successfully'], 201);
        }catch (\Exception $exception){
            return response()->json(['error' => 'delete item cart error'], 401);
        }
    }

    public function update_qty_item_cart($id, Request $request){
        try {
            $method = $request->input('method');
            $items = $this->cartItemRepository->find($id);
            $qty_items = $items->quantity;
            $data_update['quantity'] = $qty_items + 1;
            if( $method == 0 ) {
                if ($qty_items === 0) {
                    $data_update['quantity'] = 1;
                }
                $data_update['quantity'] = $qty_items - 1;
            }
            $this->cartItemRepository->update($id, $data_update);
            return response()->json(['success' => 'update item cart successfully'], 201);
        }catch (\Exception $exception){
            return response()->json(['error' => 'update item cart error'], 401);
        }
    }

    /**
     * @param $id_cart_item
     * @param $arr_attribute
     * @return bool
     */
    public function save_cart_attribute($id_cart_item ,$arr_attribute)
    {
        $array = explode(',', $arr_attribute);
        $data['carts_items_id'] = $id_cart_item;
        foreach ($array as $item){
            $data['attribute_value_id'] = $item;
            $this->cartAttributeRepo->create($data);
        }
        return true;
    }

    /**
     * @param $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_cart_by_user_id($user_id)
    {
        try {
            $users = $this->userRepository->find($user_id);
            $cart_users = $users->cart;
            $item_cart = $cart_users->list_cart_item;
            foreach ($item_cart as $item) {
                $item->product = $this->productRepository->find($item->products_id);
                $attribute_item = $item->list_attribute_cart;
                foreach ($attribute_item as $value) {
                    $value->attributevalue = $this->attributevalueRepository->find($value->attribute_value_id);
                    $value->attribute = $this->attributeRepository->find($value->attributevalue->attribute_id);
                }
            }
            return response()->json(['success' => $cart_users], 201);
        }catch (\Exception $exception){
            return response()->json(['error' => "not find cart by user"], 405);
        }
    }

}
