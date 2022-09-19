<?php

namespace App\Http\Controllers\API\Shipings;

use App\Http\Controllers\Controller;
use App\Repositories\CategoriesRepository\CategoriesRepository;
use App\Repositories\PaymentRepository\PaymentMethodMethodRepository;
use App\Repositories\ShipingRepository\TransportersRepository;
use Illuminate\Http\Request;

class TransportersController extends Controller
{
    /**
     * @var TransportersRepository
     */
    protected $transportersRepo;

    /**
     * @param TransportersRepository $transportersRepo
     */
    public function __construct( TransportersRepository $transportersRepo )
    {
        $this->transportersRepo = $transportersRepo;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $obj = $this->transportersRepo->getAll();
            return response()->json($obj, 201);
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
            if($request->hasFile('logo')){
                $file = $request->file('logo');
                $source = 'upload/transporters/';
                $file_name = $this->transportersRepo->upload($file , $source);
                $data['logo'] = url($file_name);
            }
            $obj = $this->transportersRepo->create($data);
            return response()->json($obj, 201);
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
            $obj = $this->transportersRepo->find($id);
            return response()->json( $obj , 201);
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
            if($request->hasFile('logo')){
                $file = $request->file('logo');
                $source = 'upload/transporters/';
                $file_name = $this->transportersRepo->upload($file , $source);
                $data['logo'] = url($file_name);
            }
            $obj = $this->transportersRepo->update( $id, $data );
            return response()->json($obj, 201);
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
            $this->transportersRepo->delete($id);
            return response()->json('deleted success', 201);
        }catch (\Exception $exception){
            return response()->json('sorry we can do that', 401);
        }
    }

}
