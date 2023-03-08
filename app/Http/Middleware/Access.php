<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use StaticVariable;
use Illuminate\Support\Facades\Auth;
class Access
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
        if ($request->session()->get('Auth', null) !== null) {
            $user = session()->get('Auth', null);
            if ($user->pelayanGereja) {
                if ($user->role_pengguna === "Admin") {
                    return redirect()->route('admin.dashboard-admin');
                }
                if ($user->role_pengguna === "Public") {
                    return redirect()->route('frontend.dashboard-pembeli');
                }
            } else {
                return redirect()->route('frontend.dashboard-pembeli');
            }
        } else {
            StaticVariable::$user = null;
        }
        return $next($request);
    }
}
