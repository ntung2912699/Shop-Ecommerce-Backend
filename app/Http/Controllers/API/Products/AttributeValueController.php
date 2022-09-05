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
            $obj = $this->attributeValueRepo->getAll();
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
            $data = $request->all();
            $this->attributeValueRepo->create($data);
            return response()->json(['success' => 'create attribute value successfully']);
        }catch ( \Exception $exception){
            return response()->json(['error' => 'create attribute value unsuccessfully']);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $obj = $this->attributeValueRepo->find($id);
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
            $obj = $this->attributeValueRepo->update( $id, $data );
            return response()->json(['success' => 'update attribute value success', $obj]);
        }catch ( \Exception $exception ){
            return response()->json(['error' => 'create attribute value unsuccessfully']);
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
            return response()->json(['success' => 'delete attribute value successfully']);
        }catch (\Exception $exception){
            return response()->json(['error' => 'sorry we can do that']);
        }
    }
}
