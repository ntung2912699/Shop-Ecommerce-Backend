<?php

namespace App\Http\Controllers\API\Users;

use App\Http\Controllers\Controller;
use App\Repositories\UsersRepository\UsersProfileRepository;
use Illuminate\Http\Request;

class UsersProfilesController extends Controller
{
    /**
     * @var UsersProfileRepository
     */
    protected $usersProfileRepo;

    /**
     * @param UsersProfileRepository $usersProfileRepo
     */
    public function __construct( UsersProfileRepository $usersProfileRepo )
    {
        $this->usersProfileRepo = $usersProfileRepo;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $obj = $this->usersProfileRepo->getAll();
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
            if($request->hasFile('avatar')){
                $file = $request->file('avatar');
                $source = 'upload/users/avatar';
                $file_name = $this->usersProfileRepo->upload($file , $source);
                $data['avatar'] = $file_name;
            }
            $this->usersProfileRepo->create($data);
            return response()->json(['success' => 'create users profile successfully']);
        }catch ( \Exception $exception){
            return response()->json(['error' => 'create users profile unsuccessfully']);
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
            if($request->hasFile('avatar')){
                $file = $request->file('avatar');
                $source = 'upload/users/avatar';
                $file_name = $this->usersProfileRepo->upload($file , $source);
                $data['avatar'] = url($file_name);
            }
            $obj = $this->usersProfileRepo->update( $id, $data );
            return response()->json(['success' => 'update users profile success', $obj]);
        }catch ( \Exception $exception ){
            return response()->json(['error' => 'create users profile unsuccessfully']);
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
            return response()->json(['success' => 'delete users profile successfully']);
        }catch (\Exception $exception){
            return response()->json(['error' => 'sorry we can do that']);
        }
    }

    /**
     * @param $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_profile_by_user($user_id){
       $profile = $this->usersProfileRepo->get_user_profile($user_id);
       foreach ($profile as $item) {
           $profile->address = $item->shipping_address;
       }
       return response()->json(['profile' => $profile], 201);
    }
}
