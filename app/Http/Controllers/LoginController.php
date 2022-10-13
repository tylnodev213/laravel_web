<?php

namespace App\Http\Controllers;


use App\Repositories\Repository;
use App\Repositories\Employee\EmployeeRepositoryInterface;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        return view('Auth.login');
    }
    public function processLogin(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        if($email == 'admin@gmail.com' && $password == '123456') {
            session()->put('id_admin', 1);
            return  redirect()->route('Team.search');
        }
        return redirect()->route('login');
    }

    public function logout()
    {
        session()->forget('id_admin');
        return view('Auth.login');
    }

}
