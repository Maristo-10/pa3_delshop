<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use StaticVariable;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    public function redirectTo()
    {
        if (Auth::user()->role_pengguna == 'Admin') {
            return '/dashboard-admin';
        }
        if (Auth::user()->role_pengguna == 'Pegawai') {
            return  '/dashboard-pegawai';
        }
        if (Auth::user()->role_pengguna === 'Publik' | Auth::user()->role_pengguna === 'Dosen/Staff' | Auth::user()->role_pengguna === 'Mahasiswa') {
            return '/home';
        }
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [Lang::get('auth.failed')],
        ])->redirectTo(route('login'))->withMessages(["Email atau Password Anda Salah!"]);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
