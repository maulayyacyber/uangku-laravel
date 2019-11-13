<?php

namespace App\Http\Controllers\api\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request){

        //validate data from form
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ],
            [
                'username.required' => 'Masukkan Username Anda !',
                'password.required' => 'Masukkan Password Anda !',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'data' => $validator->errors()
            ], 401);
        } else {
            if (Auth::attempt(['username' => $request->username, 'password' => $request->password])){
                $user = Auth::user();
                $apiToken =  $user->createToken('apiToken')->accessToken;
                return response()->json([
                    'success' => true,
                    'apiToken'=> $apiToken
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Username atau Password Anda salah!'
                ], 401);
            }
        }
    }
}
