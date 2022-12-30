<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\User;

class Admin extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        $username = Session::get('username');
        $password = Session::get('password');
        if ($username == User::ADMIN_TOKEN) {
            if (Auth::attempt(['name' => 'admin', 'password' => $password])) {
                return $next($request);
            } else {
                Session::forget('username');
                Session::forget('password');
                Auth::logout();
                return redirect('/');
            }
        } else {
                Session::forget('username');
                Session::forget('password');
                Auth::logout();
                return redirect('/');
        }
    }
}
