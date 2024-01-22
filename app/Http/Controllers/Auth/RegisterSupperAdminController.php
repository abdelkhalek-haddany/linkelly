<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Register;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterSupperAdminController extends Controller
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

    // use RegistersUsers;

    protected function create(Register $register)
    {
        return User::create([
            'first_name' => $register->first_name,
            'last_name' => $register->last_name,
            'phone' => $register->phone,
            'user_type' => $register->user_type,
            'email' => $register->email,
            'avatar' => 'avatar.png',
            'password' => Hash::make($register->password),
        ]);
    }
}
