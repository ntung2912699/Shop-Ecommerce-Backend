<?php

namespace App\Http\Controllers\API\Users;

use App\Http\Controllers\Controller;
use App\Repositories\UsersRepository\UsersRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\NotifyMail;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    /**
     * @var UsersRepository
     */
    protected $userRepo;

    /**
     * @param UsersRepository $userRepo
     */
    public function __construct
    (
        UsersRepository $userRepo
    )
    {
        $this->userRepo = $userRepo;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $users = $this->userRepo->getAll();
            return response()->json( $users , 201);
        }catch ( \Exception $exception ){
            return response()->json('sorry we can do that', 401);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->all('role');
            $user = $this->userRepo->update( $id, $data );
            return response()->json( $user , 201);
        }catch ( \Exception $exception ){
            return response()->json( 'sorry we can do that', 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function forgotPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $useRepo = new UsersRepository();
        $verify_email = $useRepo->find_email($request->input('email'));
        if ($verify_email === null){
            return response()->json('email does not exist in the system', 422);
        }
        $password_generate = $this->generateRandomString();
        $mailto = $request->input('email');
        Mail::to($mailto)->send(new NotifyMail($mailData = [
            'title' => 'SmartAuto.com',
            'body' => $password_generate
        ]));
        $data['password'] = Hash::make($password_generate);
        $useRepo->update($verify_email, $data);
        return response()->json('send mail success', 200);
    }

    /**
     * @param $length
     * @return string
     */
    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
