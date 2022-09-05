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
            $this->shipingAddressRepo->create($data);
            return response()->json(['success' => 'create shiping address successfully']);
        }catch ( \Exception $exception){
            return response()->json(['error' => 'create shiping address unsuccessfully']);
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
            $obj = $this->shipingAddressRepo->update( $id, $data );
            return response()->json(['success' => 'update shiping address success', $obj]);
        }catch ( \Exception $exception ){
            return response()->json(['error' => 'create shiping address unsuccessfully']);
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
            return response()->json(['success' => 'delete shiping address successfully']);
        }catch (\Exception $exception){
            return response()->json(['error' => 'sorry we can do that']);
        }
    }
}
