<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\User;

class Customer extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        $username = Session::get('username');
        $password = Session::get('password');
        $user = User::where('email', $username)->first();
        if ($user && $user->is_active == 1) {
            if (Auth::attempt(['name' => $username, 'password' => $password])) {
                return $next($request);
            } else {
                Session::forget('username');
                Session::forget('password');
                Auth::logout();
                return redirect('/')->with('notification', 'Thông tin không chính xác');
            }
        } else {
            Session::forget('username');
            Session::forget('password');
            Auth::logout();
            return redirect('/')->with('notification', 'Tài khoản không khả dụng');
        }
    }
}
