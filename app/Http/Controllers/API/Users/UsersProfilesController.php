<?php

namespace App\Http\Controllers\API\Users;

use App\Http\Controllers\Controller;
use App\Repositories\UsersRepository\UsersProfileRepository;
use App\Repositories\UsersRepository\UsersRepository;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class UsersProfilesController extends Controller
{
    /**
     * @var UsersProfileRepository
     */
    protected $usersProfileRepo;

    /**
     * @var UsersRepository
     */
    protected $userRepo;

    /**
     * @param UsersProfileRepository $usersProfileRepo
     * @param UsersRepository $userRepo
     */
    public function __construct(
        UsersProfileRepository $usersProfileRepo,
        UsersRepository $userRepo
    )
    {
        $this->usersProfileRepo = $usersProfileRepo;
        $this->userRepo = $userRepo;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $users = $this->usersProfileRepo->getAll();
            return response()->json([ $users ], 201);
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
            if($request->hasFile('avatar')){
                $file = $request->file('avatar');
                $source = 'upload/users/avatar/';
                $file_name = $this->usersProfileRepo->upload($file , $source);
                $data['avatar'] = url($file_name);
            }
            $users = $this->usersProfileRepo->create($data);
            return response()->json([$users], 201);
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
            $obj = $this->usersProfileRepo->find($id);
            return response()->json([ $obj ], 201);
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
            if($request->hasFile('avatar')){
                $file = $request->file('avatar');
                $source = 'upload/users/avatar/';
                $file_name = $this->usersProfileRepo->upload($file , $source);
                $data['avatar'] = url($file_name);
            }
            $obj = $this->usersProfileRepo->update( $id, $data );
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
            $this->usersProfileRepo->delete($id);
            return response()->json(['deleted success'], 201);
        }catch (\Exception $exception){
            return response()->json(['sorry we can do that'], 401);
        }
    }

    /**
     * @param $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_profile_by_user($user_id){
        try {
            $user = $this->userRepo->find($user_id);
            $profile = $user->profile;
            return response()->json([$profile], 201);
        }catch (\Exception $exception){
            return response()->json(['sorry we can do that'], 401);
        }
    }

    /**
     * @param $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_address_by_user($user_id){
        try {
            $user = $this->userRepo->find($user_id);
            $user->address = $user->address;
            $user->profile = $user->profile;
            return response()->json(['user' => $user], 201);
        }catch (\Exception $exception){
            return response()->json(['sorry we can do that'], 401);
        }
    }
}
