<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Pembelimiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->role_pengguna == 'Publik' ||Auth::user()->role_pengguna == 'Dosen/Staff' || Auth::user()->role_pengguna == 'Mahasiswa') {
            return $next($request);
        } else {
            return back()->with('status', 'you are not allowed to access the admin dashboard');
        }
    }
}
