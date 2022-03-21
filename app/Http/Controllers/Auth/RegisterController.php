<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['nim'].'@unsika.ac.id',
            'password' => Hash::make($data['password']),
        ]);

        DB::table('role_user')->insert(
            ['user_id' => $user->id + 1, 'role_id' => 3, 'user_type' => 'App\Models\User']
        );

        Mahasiswa::create([
            'user_id' => $user->id + 1,
            'nim' => $data['nim'],
            'prodi' => $data['prodi'],
        ]);

        $userDel = User::find($user->id);
        $userDel->delete();

        return User::create([
            'name' => $data['name'],
            'email' => $data['nim'].'@student.unsika.ac.id',
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function registered()
    {
        $this->guard()->logout();
        return redirect()->back()->with('success', 'Registrasi berhasil, silahkan verifikasi email anda.');
    }
}
