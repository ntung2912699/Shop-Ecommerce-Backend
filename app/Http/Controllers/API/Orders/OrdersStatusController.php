<?php

namespace App\Http\Controllers\API\Orders;

use App\Http\Controllers\Controller;
use App\Repositories\OrdersRepository\OrdersStatusRepository;
use Illuminate\Http\Request;

class OrdersStatusController extends Controller
{
    /**
     * @var OrdersStatusRepository
     */
    protected $orderStatusRepo;

    /**
     * @param OrdersStatusRepository $orderStatusRepo
     */
    public function __construct( OrdersStatusRepository $orderStatusRepo )
    {
        $this->orderStatusRepo = $orderStatusRepo;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $status = $this->orderStatusRepo->getAll();
            return response()->json( $status , 201);
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
            $status = $this->orderStatusRepo->create($data);
            return response()->json($status, 201);
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
            $status = $this->orderStatusRepo->find($id);
            return response()->json( $status , 201);
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
            $status = $this->orderStatusRepo->update( $id, $data );
            return response()->json($status, 201);
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
            $this->orderStatusRepo->delete($id);
            return response()->json('deleted success', 201);
        }catch (\Exception $exception){
            return response()->json('sorry we can do that', 401);
        }
    }
}
