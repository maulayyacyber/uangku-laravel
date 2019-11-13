<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/account/dashboard/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'full_name'     => ['required'],
            'username'      => ['required', 'unique:users'],
            'email'         => ['required', 'email','unique:users'],
            'password'      => ['required', 'confirmed'],
            'agree'         => ['required'],
        ],
            [
                'full_name.required'    => 'Masukkan Nama Lengkap Anda !',
                'username.required'     => 'Masukkan Username Anda !',
                'username.unique'       => 'Username Sudah Terdaftar !',
                'email.required'        => 'Masukkan Alamat Email Anda !',
                'email.unique'          => 'Alamat Email Sudah Terdaftar !',
                'password.required'     => 'Masukkan Password Anda !',
                'password.confirmed'    => 'Konfirmasi Password Salah !',
                'agree.required'        => 'Silahkan Centang Kebijakan dan Ketentuan !',
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'full_name'     => $data['full_name'],
            'username'      => $data['username'],
            'email'         => $data['email'],
            'password'      => Hash::make($data['password']),
        ]);
    }


}
