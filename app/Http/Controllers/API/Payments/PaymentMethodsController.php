<?php

namespace App\Http\Controllers\API\Payments;

use App\Http\Controllers\Controller;
use App\Repositories\PaymentRepository\PaymentMethodMethodRepository;
use Illuminate\Http\Request;

class PaymentMethodsController extends Controller
{
    /**
     * @var PaymentMethodMethodRepository
     */
    protected $paymentMethodRepo;

    /**
     * @param PaymentMethodMethodRepository $paymentMethodRepo
     */
    public function __construct( PaymentMethodMethodRepository $paymentMethodRepo )
    {
        $this->paymentMethodRepo = $paymentMethodRepo;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $method =$this->paymentMethodRepo->getAll();
            return response()->json($method, 201);
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
            $method = $this->paymentMethodRepo->create($data);
            return response()->json($method, 201);
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
            $status = $this->paymentMethodRepo->find($id);
            return response()->json($status , 201);
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
            $methods = $this->paymentMethodRepo->update( $id, $data );
            return response()->json($methods, 201);
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
            $this->paymentMethodRepo->delete($id);
            return response()->json('deleted success', 201);
        }catch (\Exception $exception){
            return response()->json('sorry we can do that', 401);
        }
    }
}
