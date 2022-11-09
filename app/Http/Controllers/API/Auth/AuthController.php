<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UsersRepository\UsersRepository;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Register user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    /**
     * login user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string|min:6',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            if (!$token = auth()->attempt($validator->validated())) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $user = auth()->user();
            return response()->json([
                'token' => $token,
                'user' => $user,
                'isLogin' => Auth::check(),
            ], 201);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkAdminPermission()
    {
            $islogin = auth()->check();
            if ($islogin){
                $user = auth()->user()->role;
                if ($user === 'Admin'){
                    return response()->json([
                        'admin_permission' => true,
                    ], 200);
                }else{
                    return response()->json([
                        'admin_permission' => false,
                    ], 200);
                }
            }else{
                return response()->json('you not permision admin', 401);
        }
    }

    /**
     * Logout user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'User successfully logged out.']);
    }

    /**
     * Refresh token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get user profile.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        return response()->json(auth()->user());
    }

    /**
     * Check user is login
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function checklogin()
    {
        $loginInfo = ['isLogin' => false];
        if (auth()->user()) {
            $loginInfo = [
                'isLogin' => true,
            ];
        }
        return response()->json($loginInfo, 200);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'oldpassword' => 'required|string|min:6',
            'newpassword' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = auth()->user();
        $oldpassword = auth()->user()->getAuthPassword();
        $oldpasswordinput = $request->input('oldpassword');
        if (password_verify($oldpasswordinput, $oldpassword))
        {
            $useRepo = new UsersRepository();
            $newpassword = $request->input('newpassword');
            $data['password'] = Hash::make($newpassword);
            $useRepo->update($user->id, $data);
            return response()->json(auth()->user(), 200);
        }
        return response()->json('Mật khẩu cũ không chính  ! vui lòng thử lại', 422);
    }
}
