<?php

namespace App\Http\Controllers\API\Products;

use App\Http\Controllers\Controller;
use App\Repositories\CategoriesRepository\CategoriesRepository;
use App\Repositories\ProductsRepository\AttributesRepository;
use App\Repositories\ProductsRepository\ProductsRepository;
use App\Repositories\UsersRepository\UsersRepository;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * @var ProductsRepository
     */
    protected $productRepo;

    /**
     * @var UsersRepository
     */
    protected $userRepo;

    /**
     * @var AttributesRepository
     */
    protected $attributeRepo;

    /**
     * @var CategoriesRepository
     */
    protected  $categoriesRepo;

    /**
     * @param ProductsRepository $productRepo
     * @param AttributesRepository $attributeRepo
     * @param CategoriesRepository $categoriesRepo
     * @param UsersRepository $userRepo
     */
    public function __construct(
        ProductsRepository $productRepo,
        AttributesRepository $attributeRepo,
        CategoriesRepository $categoriesRepo,
        UsersRepository $userRepo
    )
    {
        $this->productRepo = $productRepo;
        $this->attributeRepo = $attributeRepo;
        $this->categoriesRepo = $categoriesRepo;
        $this->userRepo = $userRepo;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $products = $this->productRepo->getAll();
            foreach ($products as $product){
                $product->category = $product->relationship_for_categories->name;
            }
            return response()->json($products, 201);
        }catch ( \Exception $exception ){
            return response()->json('sorry we can do that', 401);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            if($request->hasFile('thumbnail')){
                $file = $request->file('thumbnail');
                $source = 'upload/products/thumbnail/';
                $file_name = $this->productRepo->upload($file , $source);
                $data['thumbnail'] = url($file_name);
            }
            if($request->hasFile('gallery')){
                $gallery = $request->file('gallery');
                foreach( $gallery as $file) {
                    $source = 'upload/products/gallery/';
                    $file_name = $this->productRepo->upload($file, $source);
                    $listgallery[] = url($file_name);
                }
                $data['gallery'] = implode("|", $listgallery);
            }
            $product = $this->productRepo->create($data);
            return response()->json($product, 201);
        }catch ( \Exception $exception){
            return response()->json('sorry we can do that', 401);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $product = $this->productRepo->find($id);
            $groupAttr = $product->relationship_attribute;
            foreach ($groupAttr as $items) {
                $attribute = $this->attributeRepo->find($items->attribute_id);
                $items->attribute = $attribute;
            }
            $catgory = $product->relationship_for_categories;
            $spec = $product->specs;
            $validated_daddy = [];
            $validated_list = [];
            foreach($groupAttr as $index => $item) {
                $daddy = $item->attribute->name;
                if( in_array($daddy, $validated_daddy) ){
                    array_push($validated_list[$daddy], $item);
                } else {
                    $validated_list[$daddy] = array($item);
                }
                array_push($validated_daddy, $daddy);
                unset($daddy);
            }
            $product->attribute = $validated_list;
            $product->category = $catgory;
            $product->specs = $spec;
            return response()->json( $product , 201);
        }catch ( \Exception $exception ){
            return response()->json('sorry we can do that', 401);
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
            if($request->hasFile('thumbnail')){
                $file = $request->file('thumbnail');
                $source = 'upload/products/thumbnail/';
                $file_name = $this->productRepo->upload($file , $source);
                $data['thumbnail'] = url($file_name);
            }
            if($request->hasFile('gallery')){
                $gallery = $request->file('gallery');
                foreach( $gallery as $file) {
                    $source = 'upload/products/gallery/';
                    $file_name = $this->productRepo->upload($file, $source);
                    $listgallery[] = url($file_name);
                }
                $data['gallery'] = implode("|", $listgallery);
            }
            $product = $this->productRepo->update( $id, $data );
            return response()->json($product, 201);
        }catch ( \Exception $exception ){
            return response()->json('sorry we can do that', 401);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $this->productRepo->delete($id);
            return response()->json('deleted success', 201);
        }catch (\Exception $exception){
            return response()->json('sorry we can do that', 401);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_attribute($id){
        try {
            $result = $this->productRepo->get_attribute_for_product($id);
            return response()->json($result, 201);
        }catch (\Exception $exception){
            return response()->json('sorry we can do that', 401);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_new_products_for_home_page()
    {
        try {
            $products = $this->productRepo->get_new_produts();
            return response()->json($products, 201);
        }catch (\Exception $exception){
            return response()->json('sorry we can do that', 401);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_new_products_for_shop()
    {
        try {
            $products = $this->productRepo->get_shop_produts();
            return response()->json($products, 201);
        }catch (\Exception $exception){
            return response()->json('sorry we can do that', 401);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search_products(Request $request)
    {
        try {
            $key = $request->get('search');
            $result = $this->productRepo->obj_search($key);
            return response()->json( $result , 201);
        }catch (\Exception $exception){
            return response()->json('no result', 401);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function filter_products(Request $request)
    {
        try {
            $price_min = $request->get('price_min');
            $price_max = $request->get('price_max');
            $category_id = $request->get('id_category');
            if($category_id === 'all'){
                $result = $this->productRepo->filter_search($price_min ,$price_max);
            }else{
                $result = $this->productRepo->filter_search_cate($price_min ,$price_max , $category_id);
            }
            return response()->json( $result , 200);
        }catch (\Exception $exception) {
            return response()->json('no result', 401);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function produts_statis(){
        $product  = count($this->productRepo->getAll());
        return response()->json( $product , 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function categories_statis(){
        $cate  = count($this->categoriesRepo->getAll());
        return response()->json( $cate , 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function users_statis(){
        $users  = count($this->userRepo->getAll());
        return response()->json( $users , 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function money_statis(){
        $money = [];
        $product  = $this->productRepo->getAll();
        foreach ($product as $pro){
            $money[] = $pro->price;
        }
        $total_money = array_sum($money);
        return response()->json( $total_money , 200);
    }
}
