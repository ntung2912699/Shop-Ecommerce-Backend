<?php

namespace App\Http\Controllers\API\Products;

use App\Http\Controllers\Controller;
use App\Repositories\ProductsRepository\AttributeValueRepository;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
{
    /**
     * @var AttributeValueRepository
     */
    protected $attributeValueRepo;

    /**
     * @param AttributeValueRepository $attributeValueRepo
     */
    public function __construct( AttributeValueRepository $attributeValueRepo )
    {
        $this->attributeValueRepo = $attributeValueRepo;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $value = $this->attributeValueRepo->getAll();
            return response()->json($value, 201);
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
            $value = $this->attributeValueRepo->create($data);
            return response()->json($value, 201);
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
            $value = $this->attributeValueRepo->find($id);
            return response()->json($value, 201);
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
            $value = $this->attributeValueRepo->update( $id, $data );
            return response()->json($value, 201);
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
            $this->attributeValueRepo->delete($id);
            return response()->json('deleted success', 201);
        }catch (\Exception $exception){
            return response()->json('sorry we can do that', 401);
        }
    }
}
