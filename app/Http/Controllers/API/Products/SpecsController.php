<?php

namespace App\Http\Controllers\API\Products;

use App\Http\Controllers\Controller;
use App\Repositories\ProductsRepository\SpecsRepository;
use Illuminate\Http\Request;

class SpecsController extends Controller
{
    /**
     * @var SpecsRepository
     */
    protected $specRepo;

    /**
     * @param SpecsRepository $specRepo
     */
    public function __construct
    (
        SpecsRepository $specRepo
    )
    {
        $this->specRepo = $specRepo;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $spec = $this->specRepo->getAll();
            return response()->json([$spec], 201);
        }catch ( \Exception $exception ){
            return response()->json(['sorry we can do that'], 401);
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
            $spec = $this->specRepo->create($data);
            return response()->json([$spec], 201);
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
            $spec = $this->specRepo->find($id);
            return response()->json([ $spec ], 201);
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
            $spec = $this->specRepo->update( $id, $data );
            return response()->json([$spec], 201);
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
            $this->specRepo->delete($id);
            return response()->json(['deleted success'], 201);
        }catch (\Exception $exception){
            return response()->json(['sorry we can do that'], 401);
        }
    }
}
