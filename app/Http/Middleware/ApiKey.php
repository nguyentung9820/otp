<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Configuration;

class ApiKey extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        $link = $request->getRequestUri();
        $link_array = explode('/',$link);
        $config = Configuration::where('api_key', end($link_array))->first();
        if ($config && $config->user_id) {
            $request->id = $config->user_id;
            return $next($request);
        } else {
            $message = [
                'status' => '200',
                'message' => 'API KEY không hợp lệ'
            ];
            return response()->view('api', $message, 404);
        }
    }
}
