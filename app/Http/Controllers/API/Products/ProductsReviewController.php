<?php

namespace App\Http\Controllers\API\Products;

use App\Http\Controllers\Controller;
use App\Repositories\ProductsRepository\ProductsReviewRepository;
use Illuminate\Http\Request;

class ProductsReviewController extends Controller
{
    /**
     * @var ProductsReviewRepository
     */
    protected $productReviewRepo;

    /**
     * @param ProductsReviewRepository $productReviewRepo
     */
    public function __construct( ProductsReviewRepository $productReviewRepo )
    {
        $this->productReviewRepo = $productReviewRepo;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $obj = $this->productReviewRepo->getAll();
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
            if($request->hasFile('media')){
                $file = $request->file('media');
                $source = 'upload/products/media';
                $file_name = $this->productReviewRepo->upload($file , $source);
                $data['media'] = $file_name;
            }
            $this->productReviewRepo->create($data);
            return response()->json(['success' => 'create product review successfully']);
        }catch ( \Exception $exception){
            return response()->json(['error' => 'create product review unsuccessfully']);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $obj = $this->productReviewRepo->find($id);
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
            if($request->hasFile('media')){
                $file = $request->file('media');
                $source = 'upload/products/media';
                $file_name = $this->productReviewRepo->upload($file , $source);
                $data['media'] = $file_name;
            }
            $obj = $this->productReviewRepo->update( $id, $data );
            return response()->json(['success' => 'update product review success', $obj]);
        }catch ( \Exception $exception ){
            return response()->json(['error' => 'create product review unsuccessfully']);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $this->productReviewRepo->delete($id);
            return response()->json(['success' => 'delete product review successfully']);
        }catch (\Exception $exception){
            return response()->json(['error' => 'sorry we can do that']);
        }
    }
}
