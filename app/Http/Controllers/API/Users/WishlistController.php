<?php

namespace App\Http\Controllers\API\Users;

use App\Http\Controllers\Controller;
use App\Repositories\UsersRepository\WishlistRepository;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * @var WishlistRepository
     */
    protected $wishlistRepo;

    /**
     * @param WishlistRepository $wishlistRepo
     */
    public function __construct
    (
        WishlistRepository $wishlistRepo
    )
    {
        $this->wishlistRepo = $wishlistRepo;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $wishlist = $this->wishlistRepo->getAll();
            return response()->json($wishlist, 201);
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
            $wishlist = $this->wishlistRepo->create($data);
            return response()->json($wishlist, 201);
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
            $wishlist = $this->wishlistRepo->find($id);
            return response()->json($wishlist, 201);
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
            $wishlist = $this->wishlistRepo->update( $id, $data );
            return response()->json($wishlist, 201);
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
            $this->wishlistRepo->delete($id);
            return response()->json('deleted success', 201);
        }catch (\Exception $exception){
            return response()->json('sorry we can do that', 401);
        }
    }
}
