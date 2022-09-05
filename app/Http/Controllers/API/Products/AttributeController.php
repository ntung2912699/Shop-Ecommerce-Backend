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
            $obj = $this->attributeRepo->getAll();
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
            $this->attributeRepo->create($data);
            return response()->json(['success' => 'create attribute successfully']);
        }catch ( \Exception $exception){
            return response()->json(['error' => 'create attribute unsuccessfully']);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $obj = $this->attributeRepo->find($id);
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
            $obj = $this->attributeRepo->update( $id, $data );
            return response()->json(['success' => 'update attribute success', $obj]);
        }catch ( \Exception $exception ){
            return response()->json(['error' => 'create attribute unsuccessfully']);
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
            return response()->json(['success' => 'delete attribute successfully']);
        }catch (\Exception $exception){
            return response()->json(['error' => 'sorry we can do that']);
        }
    }
}
