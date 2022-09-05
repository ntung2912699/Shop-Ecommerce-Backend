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
            if($request->hasFile('logo')){
                $file = $request->file('logo');
                $source = 'upload/transporters';
                $file_name = $this->transportersRepo->upload($file , $source);
                $data['logo'] = url($file_name);
            }
            $this->transportersRepo->create($data);
            return response()->json(['success' => 'create transporters successfully']);
        }catch ( \Exception $exception){
            return response()->json(['error' => 'create transporters unsuccessfully']);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $category = $this->transportersRepo->find($id);
            return response()->json([ $category, 200 ]);
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
            if($request->hasFile('logo')){
                $file = $request->file('logo');
                $source = 'upload/transporters';
                $file_name = $this->transportersRepo->upload($file , $source);
                $data['logo'] = $file_name;
            }
            $category = $this->transportersRepo->update( $id, $data );
            return response()->json(['success' => 'update transporters success', $category]);
        }catch ( \Exception $exception ){
            return response()->json(['error' => 'create transporters unsuccessfully']);
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
            return response()->json(['success' => 'delete transporters successfully']);
        }catch (\Exception $exception){
            return response()->json(['error' => 'sorry we can do that']);
        }
    }

}
