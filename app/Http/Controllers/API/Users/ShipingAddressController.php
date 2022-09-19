<?php

namespace App\Http\Controllers\API\Users;

use App\Http\Controllers\Controller;
use App\Repositories\UsersRepository\ShipingAddressRepository;
use Illuminate\Http\Request;

class ShipingAddressController extends Controller
{
    /**
     * @var ShipingAddressRepository
     */
    protected $shipingAddressRepo;

    /**
     * @param ShipingAddressRepository $shipingAddressRepo
     */
    public function __construct( ShipingAddressRepository $shipingAddressRepo )
    {
        $this->shipingAddressRepo = $shipingAddressRepo;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $obj = $this->shipingAddressRepo->getAll();
            return response()->json([$obj], 201);
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
            $obj = $this->shipingAddressRepo->create($data);
            return response()->json([$obj], 201);
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
            $obj = $this->shipingAddressRepo->find($id);
            return response()->json([$obj], 201);
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
            $obj = $this->shipingAddressRepo->update( $id, $data );
            return response()->json([$obj], 201);
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
            $this->shipingAddressRepo->delete($id);
            return response()->json(['deleted success'], 201);
        }catch (\Exception $exception){
            return response()->json(['sorry we can do that'], 401);
        }
    }
}
