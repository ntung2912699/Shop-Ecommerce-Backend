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
            $obj = $this->paymentMethodRepo->getAll();
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
            $this->paymentMethodRepo->create($data);
            return response()->json(['success' => 'create method successfully']);
        }catch ( \Exception $exception){
            return response()->json(['error' => 'create method unsuccessfully']);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $obj = $this->paymentMethodRepo->find($id);
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
            $obj = $this->paymentMethodRepo->update( $id, $data );
            return response()->json(['success' => 'update method success', $obj]);
        }catch ( \Exception $exception ){
            return response()->json(['error' => 'create method unsuccessfully']);
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
            return response()->json(['success' => 'delete method successfully']);
        }catch (\Exception $exception){
            return response()->json(['error' => 'sorry we can do that']);
        }
    }
}
