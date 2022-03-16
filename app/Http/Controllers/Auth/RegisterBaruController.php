<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Permission;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class RegisterBaruController extends Controller
{
    //

    public function index(){
        return view('auth.register');
    }

    public function registerpost(Request $request){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'numeric', 'unique:mahasiswa'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ],[
            'name.*'=> 'Nama Wajib di Isi',
            'nim.required'=> 'Nim Wajib di Isi',
            'nim.numeric'=> 'Nim Harus berupa nomor',
            'nim.unique'=> 'Nim Sudah Tersedia',
            'email.required'=> 'Email Wajib di Isi',
            'email.unique'=> 'Email Sudah Tersedia',
            'password.required'=> 'Password harus di Isi',
        ]);

        DB::beginTransaction();
        try{

            $user = User::create([
                'name' => $request->name,
                'email' =>  $request->email,
                'password' => Hash::make($request->password)
            ]);

            Mahasiswa::create([
                'user_id'=>$user->id,
                'nim'=> $request->nim,
                
            ]);

            $user_id = $user->id;
            $role_id = 3;
            $user_type = 'App\Models\User';
    
            DB::table('role_user')->insert(
                array(
                        'role_id'     =>   $role_id,
                        'user_id'     =>   $user_id,
                        'user_type'   =>   $user_type,
                )
            );

            DB::commit();
            return Redirect::route('login.view')->with('success', 'Silahkan Login');
        }catch(Exception $e){
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }


    }
}
