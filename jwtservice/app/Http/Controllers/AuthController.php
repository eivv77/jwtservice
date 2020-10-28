<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
//    private $successStatus;
//
//    public function register(Request $request){
//        $validator = Validator::make($request->all(), [
//            'name' => 'required|string|max:255',
//            'email' => 'required|string|email|max:255|unique:users',
//            'password' => 'required|string|min:6',
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json([
//                'code' => 400,
//                'status' => false,
//                'message' => "Register Failed"
//            ], 400);
//        }
//
//        $input = $request->all();
//        $user = User::create($input);
//        $user->password = Hash::make($input['password']);
//        $user->save();
//
//        $token = auth()->attempt(['email' => $input['email'], 'password' => $input['password']]);
//
//        return response()->json([
//            'code'   => 200,
//            'status' => true,
//            'message'=> "Register Success",
//            'token' => $token
//        ], 200);
//    }
//
//    public function login(Request $request){
//        $validator = Validator::make($request->all(), [
//            'email' => 'required|string|email',
//            'password' => 'required|string',
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json([
//                'code' => 400,
//                'status' => false,
//                'message' => "Login Failed. Missing email or password."
//            ], 400);
//        }
//
//        $token = auth()->attempt(['email' => $request->email, 'password' => $request->password]);
//        if(!($token)){
//            $token = auth()->attempt(['name' => $request->email, 'password' => $request->password]);
//        }
//        if($token){
//            return response()->json([
//                'code'   => 200,
//                'status' => true,
//                'message'=> "Login Success",
//                'token' => $token
//            ], 200);
//        }
//        return response()->json([
//            'code' => 400,
//            'status' => false,
//            'message' => "Login Failed. Invalid email or password",
//        ], 400);
//    }
//
//    public function logout(Request $request){
//        auth()->logout();
//        return response()->json([
//            'code'   => $this->successStatus,
//            'status' => true,
//            'message'=> "Logout Success",
//            'data'   => [200]
//        ], 200);
//    }
//
//    public function getUser(Request $request)
//    {
//        return response()->json([
//            'user' => auth()->user()
//        ]);
//    }

    private $successStatus;

    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = auth()->login($user);

        return $this->respondWithToken($token);
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
//            dd(get_class(auth()->factory()))

        ]);
    }

    public function logout(Request $request){
        auth()->logout();
        return response()->json([
            'code'   => $this->successStatus,
            'status' => true,
            'message'=> "Logout Success",
            'data'   => [200]
        ], 200);
    }
    
}

