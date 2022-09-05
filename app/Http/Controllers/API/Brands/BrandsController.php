<?php

namespace App\Http\Controllers\API\Brands;

use App\Http\Controllers\Controller;
use App\Repositories\BrandsRepository\BrandsRepository;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    /**
     * @var BrandsRepository
     */
    protected $brandRepo;

    /**
     * @param BrandsRepository $brandRepo
     */
    public function __construct
    (
        BrandsRepository $brandRepo
    )
    {
        $this->brandRepo = $brandRepo;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $brands = $this->brandRepo->getAll();
            return response()->json(['brands' => $brands]);
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
                $source = 'upload/brands/';
                $file_name = $this->brandRepo->upload($file , $source);
                $data['logo'] = url($file_name);;
            }
            $this->brandRepo->create($data);
            return response()->json(['success' => 'create brand successfully']);
        }catch ( \Exception $exception){
            return response()->json(['error' => 'create brand unsuccessfully']);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $brand = $this->brandRepo->find($id);
            return response()->json([ $brand, 200 ]);
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
                $source = 'upload/brands/';
                $file_name = $this->brandRepo->upload($file , $source);
                $data['logo'] = url($file_name);
            }
            $brand = $this->brandRepo->update( $id, $data );
            return response()->json(['success' => 'update brand success', $brand]);
        }catch ( \Exception $exception ){
            return response()->json(['error' => 'update brand unsuccessfully']);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $this->brandRepo->delete($id);
            return response()->json(['success' => 'delete brand successfully']);
        }catch (\Exception $exception){
            return response()->json(['error' => 'sorry we can do that']);
        }
    }
}
