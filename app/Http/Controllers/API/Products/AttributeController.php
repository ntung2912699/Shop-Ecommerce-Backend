<?php

namespace App\Http\Controllers\API\Products;

use App\Http\Controllers\Controller;
use App\Repositories\ProductsRepository\AttributesRepository;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * @var AttributesRepository
     */
    protected $attributeRepo;

    /**
     * @param AttributesRepository $attributeRepo
     */
    public function __construct( AttributesRepository $attributeRepo )
    {
        $this->attributeRepo = $attributeRepo;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $attribute = $this->attributeRepo->getAll();
            return response()->json($attribute, 201);
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
            $attribute = $this->attributeRepo->create($data);
            return response()->json($attribute, 201);
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
            $attribute = $this->attributeRepo->find($id);
            return response()->json( $attribute , 201);
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
            $attribute = $this->attributeRepo->update( $id, $data );
            return response()->json($attribute, 201);
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
            $this->attributeRepo->delete($id);
            return response()->json('deleted success', 201);
        }catch (\Exception $exception){
            return response()->json('sorry we can do that', 401);
        }
    }
}
