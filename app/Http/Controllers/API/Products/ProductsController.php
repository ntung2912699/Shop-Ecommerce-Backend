<?php

namespace App\Http\Controllers\API\Products;

use App\Http\Controllers\Controller;
use App\Repositories\ProductsRepository\AttributesRepository;
use App\Repositories\ProductsRepository\ProductsRepository;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * @var ProductsRepository
     */
    protected $productRepo;

    /**
     * @var AttributesRepository
     */
    protected $attributeRepo;

    /**
     * @param ProductsRepository $productRepo
     * @param AttributesRepository $attributeRepo
     */
    public function __construct(
        ProductsRepository $productRepo,
        AttributesRepository $attributeRepo
    )
    {
        $this->productRepo = $productRepo;
        $this->attributeRepo = $attributeRepo;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $products = $this->productRepo->getAll();
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
            $brand = $product->relationship_for_brands;
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
            $product->brand = $brand;
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
}
