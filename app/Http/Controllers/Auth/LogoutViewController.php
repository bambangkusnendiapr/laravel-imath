<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutViewController extends Controller
{
    //
    public function index()
    {
        Session::flush();
        
        Auth::logout();

        return redirect('/');
    }

}
