<?php

namespace App\Http\Controllers\API\Categories;

use App\Http\Controllers\Controller;
use App\Repositories\CategoriesRepository\CategoriesRepository;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    /**
     * @var CategoriesRepository
     */
    protected $categoriesRepo;


    /**
     * @param CategoriesRepository $categoriesRepo
     */
    public function __construct(CategoriesRepository $categoriesRepo )
    {
        $this->categoriesRepo = $categoriesRepo;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $categories = $this->categoriesRepo->getAll();
//            foreach ($categories as $cate){
//                $brand = $cate->relationship_for_brands;
//            }
            return response()->json(['categories' => $categories]);
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
            if($request->hasFile('logo')){
                $file = $request->file('logo');
                $source = 'upload/categories/';
                $file_name = $this->categoriesRepo->upload($file , $source);
                $data['logo'] = url($file_name);;
            }
            $this->categoriesRepo->create($data);
            return response()->json(['success' => 'create category successfully']);
        }catch ( \Exception $exception){
            return response()->json(['error' => 'create category unsuccessfully']);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $category = $this->categoriesRepo->find($id);
            $category->relationship_for_brands;
            return response()->json([ 'category' => $category], 201);
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
            if($request->hasFile('logo')){
                $file = $request->file('logo');
                $source = 'upload/categories/';
                $file_name = $this->categoriesRepo->upload($file , $source);
                $data['logo'] = url($file_name);
            }
            $category = $this->categoriesRepo->update( $id, $data );
            return response()->json(['success' => 'update categories success', $category]);
        }catch ( \Exception $exception ){
            return response()->json(['error' => 'update category unsuccessfully']);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $this->categoriesRepo->delete($id);
            return response()->json(['success' => 'delete category successfully']);
        }catch (\Exception $exception){
            return response()->json(['error' => 'sorry we can do that']);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_list_product_by_categories($id)
    {
        try {
            $result = $this->categoriesRepo->get_product_by_categories($id);
            return response()->json([ 'success' => $result ]);
        }catch (\Exception $exception){
            return response()->json(['error' => 'sorry we can do that']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search_category(Request $request)
    {
        try {
            $key = $request->all();
            $result = $this->categoriesRepo->obj_search($key);
            return response()->json([ 'success' => $result ]);
        }catch (\Exception $exception){
            return response()->json(['no result']);
        }
    }
}
