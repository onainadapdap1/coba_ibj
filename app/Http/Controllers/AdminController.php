<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminController extends Controller
{
    public function adminRegister(Request $request) {
        // validasi data
        $data = $request->only('name', 'email', 'password');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50'
        ]);

        // send failed response if requres is not valid
        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is valid, create new user
        $user = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        //User created, return success response
        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user
        ], Response::HTTP_OK);
    }

    public function adminLogin(Request $request ) {
        $credentials = $request->only( 'email', 'password' );
        $token       = null;
        try {
            if ( ! $token = auth()->guard('admin-api')->attempt( $credentials ) ) {
                return response()->json( [
                    'response' => 'error',
                    'message'  => 'invalid_email_or_password',
                ] );
            }
        } catch ( JWTException $e ) {
            return response()->json( [
                'response' => 'error',
                'message'  => 'failed_to_create_token',
            ] );
        }

        return response()->json( [
            'response' => 'success',
            'result'   => [
                'token'   => $token,
                'message' => 'I am admin user',
            ],
        ] );
    }

    public function me()
    {
        return response()->json(auth()->guard('admin-api')->user());
    }

    public function adminLogout()
    {
        auth()->guard('admin-api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
