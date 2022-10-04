<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use http\Env\Request;

class LoginController
{
    public function login()
    {
        return view('Auth.login');
    }
    public function process_login(Request $request)
    {
        try {
            $user = Employee::query()
                -> where('email', $request->get('email'))
                -> where('password', $request->get('password'))
                ->findOrFail();

            session()->put('id', $user->id);
            session()->put('name ', $user->name);

            return  redirect()->route('team.search');
        }catch (\Throwable $e) {
            return redirect()->route('login');
        }
    }

}
