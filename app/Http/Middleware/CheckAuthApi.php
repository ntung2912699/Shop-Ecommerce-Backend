<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWT;
use Tymon\JWTAuth\JWTAuth;


class CheckAuthApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (! isset(apache_request_headers()['Authorization'])){
            return response()->json(['message' => 'missing access_token']);
        }
        $authorization = apache_request_headers()['Authorization'];
        $token_split = strpos($authorization, ' ');
        $token = substr($authorization,$token_split + 1);
        $compare_token = $this->get_user_token($token);
        if ( $compare_token == false ){
            return response()->json(['message' => 'access_token invalid']);
        }
        return $next($request);
    }

    /**
     * @param $token
     * @return bool
     */
    public function get_user_token($token){
        session_start();
        if ( ! isset( $_SESSION['access_token'] ) ){
            return false;
        }
        $token_session = $_SESSION['access_token'];
        if ($token_session != $token){
            return false;
        }
        return true;
    }
}
