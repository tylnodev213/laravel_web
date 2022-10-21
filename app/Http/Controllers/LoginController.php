<?php

namespace App\Http\Controllers;


use App\Http\Requests\LoginRequest;
use App\Repositories\Repository;
use App\Repositories\Employee\EmployeeRepositoryInterface;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        if(session()->has('id_admin')) {
            return  redirect()->route('Team.search');
        }
        return view('Auth.login');
    }
    public function processLogin(LoginRequest $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');

        if($email == config('constants.username') && $password == config('constants.password')) {
            session()->put('id_admin', 1);
            return  redirect()->route('Team.search');
        }

        if($email != config('constants.username') || $password != config('constants.password')) {
            session()->put('error_login',config('constants.login_fail'));
        }

        return view('Auth.login',[
            'email' => $email,
            'password' => $password,
        ]);
    }

    public function logout()
    {
        session()->forget('id_admin');
        return view('Auth.login');
    }

}
