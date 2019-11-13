<?php

namespace App\Http\Controllers\api\v1\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'full_name'     => 'required',
            'username'      => ['required', 'unique:users'],
            'email'         => ['required', 'email','unique:users'],
            'password'      => 'required',

        ],
            [
            'full_name.required'    => 'Masukkan Nama Lengkap Anda !',
            'username.required'     => 'Masukkan Username Anda !',
            'username.unique'       => 'Username Sudah Terdaftar !',
            'email.required'        => 'Masukkan Alamat Email Anda !',
            'email.unique'          => 'Alamat Email Sudah Terdaftar !',
            'password.required'     => 'Masukkan Password Anda !',
        ]);

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'data'    => $validator->errors()
            ],401);

        } else {

            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user       = User::create($input);
            $apiToken   =  $user->createToken('apiToken')->accessToken;
            $username   =  $user;

            return response()->json([
                'success'   => true,
                'data'      => $user,
                'apiToken'  => $apiToken
            ],200);

        }

    }
}
