<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginViewController extends Controller
{
    //
    public function index(){
        return redirect()->route('login');
        // return view('auth.loginview');
    }

    public function loginpost(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password'    => 'required|string',
        ]);

        
        $User = User::where([
            ['email', $request->email],
            ['password' => $request->pasword]
        ])->first();

        
        $auth_attempt = Auth::attempt([
            'email' => $request->email,
            'password'    => $request->password
        ]);

        // dd($auth_attempt);


        if ($User && $auth_attempt) {
            // Login Success
            Auth::login($User);
            return redirect()->route('cek.role');
        }
        return redirect()->back()->with('user_not_found', 'Email / Password tidak valid');
    }

}
