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
            $obj = $this->orderStatusRepo->getAll();
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
            $this->orderStatusRepo->create($data);
            return response()->json(['success' => 'create status successfully']);
        }catch ( \Exception $exception){
            return response()->json(['error' => 'create status unsuccessfully']);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $obj = $this->orderStatusRepo->find($id);
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
            $obj = $this->orderStatusRepo->update( $id, $data );
            return response()->json(['success' => 'update status success', $obj]);
        }catch ( \Exception $exception ){
            return response()->json(['error' => 'create status unsuccessfully']);
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
            return response()->json(['success' => 'delete status successfully']);
        }catch (\Exception $exception){
            return response()->json(['error' => 'sorry we can do that']);
        }
    }
}
