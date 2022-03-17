<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekRoleController extends Controller
{
    //
    public function index(){
        if (Auth::user()->hasRole('admin|dosen')) {
                return redirect()->route('dashboard.index');
        }else{
            return redirect()->route('summary.index');
        }
    }
}