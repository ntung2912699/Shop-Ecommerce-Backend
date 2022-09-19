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
            $review = $this->productReviewRepo->getAll();
            return response()->json($review, 201);
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
            if($request->hasFile('media')){
                $file = $request->file('media');
                $source = 'upload/products/media';
                $file_name = $this->productReviewRepo->upload($file , $source);
                $data['media'] = $file_name;
            }
            $review = $this->productReviewRepo->create($data);
            return response()->json($review, 201);
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
            $review = $this->productReviewRepo->find($id);
            return response()->json($review, 201);
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
            if($request->hasFile('media')){
                $file = $request->file('media');
                $source = 'upload/products/media';
                $file_name = $this->productReviewRepo->upload($file , $source);
                $data['media'] = $file_name;
            }
            $review = $this->productReviewRepo->update( $id, $data );
            return response()->json($review, 201);
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
            $this->productReviewRepo->delete($id);
            return response()->json('deleted success', 201);
        }catch (\Exception $exception){
            return response()->json('sorry we can do that', 401);
        }
    }
}
