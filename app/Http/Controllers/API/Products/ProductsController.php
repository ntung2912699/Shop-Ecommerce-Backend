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

    protected $attributeRepo;

    /**
     * @param ProductsRepository $productRepo
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
            $obj = $this->productRepo->getAll();
            return response()->json(['products' => $obj]);
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
            $this->productRepo->create($data);
            return response()->json(['success' => 'create product successfully']);
        }catch ( \Exception $exception){
            return response()->json(['error' => 'create product unsuccessfully']);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $obj = $this->productRepo->find($id);
            $groupAttr = $obj->relationship_attribute;
            foreach ($groupAttr as $items) {
                $attribute = $this->attributeRepo->find($items->attribute_id);
                $items->attribute = $attribute;
            }
            $brand = $obj->relationship_for_brands;
            $catgory = $obj->relationship_for_categories;
            $spec = $obj->specs;
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
            $obj->attribute = $validated_list;
            $obj->brand = $brand;
            $obj->category = $catgory;
            $obj->specs = $spec;
            return response()->json([ 'products' => $obj ]);
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
            $obj = $this->productRepo->update( $id, $data );
            return response()->json(['success' => 'update product success', $obj]);
        }catch ( \Exception $exception ){
            return response()->json(['error' => 'update product unsuccessfully']);
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
            return response()->json(['success' => 'delete product successfully']);
        }catch (\Exception $exception){
            return response()->json(['error' => 'sorry we can do that']);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_attribute($id){
        $result = $this->productRepo->get_attribute_for_product($id);
        return response()->json(['success' => $result]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_new_products_for_home_page()
    {
        try {
            $products = $this->productRepo->get_new_produts();
            return response()->json(['list_products' => $products]);
        }catch (\Exception $exception){
            return response()->json(['error' => 'sorry we can do that']);
        }
    }

    /**
     * @param $attributes
     * @return void
     */
    public function group_value_by_attribute($attributes){
       var_dump($attributes);die();
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
            return response()->json([ 'success' => $result ]);
        }catch (\Exception $exception){
            return response()->json(['no result']);
        }
    }
}
