<?php

namespace App\Http\Controllers\API\Shipings;

use App\Http\Controllers\Controller;
use App\Repositories\ShipingRepository\ShipingMethodRepository;
use Illuminate\Http\Request;

class ShipingMethodController extends Controller
{
    /**
     * @var ShipingMethodRepository
     */
    protected $shipingMethodRepo;

    /**
     * @param ShipingMethodRepository $shipingMethodRepo
     */
    public function __construct( ShipingMethodRepository $shipingMethodRepo )
    {
        $this->shipingMethodRepo = $shipingMethodRepo;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $obj = $this->shipingMethodRepo->getAll();
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
            $this->shipingMethodRepo->create($data);
            return response()->json(['success' => 'create shiping method successfully']);
        }catch ( \Exception $exception){
            return response()->json(['error' => 'create shiping method unsuccessfully']);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $obj = $this->shipingMethodRepo->find($id);
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
            $obj = $this->shipingMethodRepo->update( $id, $data );
            return response()->json(['success' => 'update shiping method success', $obj]);
        }catch ( \Exception $exception ){
            return response()->json(['error' => 'create shiping method unsuccessfully']);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $this->shipingMethodRepo->delete($id);
            return response()->json(['success' => 'delete shiping method successfully']);
        }catch (\Exception $exception){
            return response()->json(['error' => 'sorry we can do that']);
        }
    }
}
