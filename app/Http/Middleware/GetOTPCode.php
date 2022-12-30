<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Configuration;
use App\History;

class GetOTPCode extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        $link = $request->getRequestUri();
        $link_array = explode('/',$link);
        $config = Configuration::where('api_key', $link_array[3])->first();
        if ($config && $config->user_id) {
            $request->id = $config->user_id;
            $phone = end($link_array);
            $history = History::where('phone',$phone)->where('user_id',$config->user_id)->first();
            if ($history) {
                if ($history->user_id != $config->user_id) {
                    $message = [
                        'status' => '200',
                        'message' => 'Số điện thoại không tồn tại'
                    ];
                    return response()->view('api', $message, 404);
                }
                $request->phone = $phone;
                return $next($request);
            } else {
                $message = [
                    'status' => '200',
                    'message' => 'Số điện thoại không tồn tại'
                ];
                return response()->view('api', $message, 404);
            }
        } else {
            $message = [
                'status' => '200',
                'message' => 'API KEY không hợp lệ'
            ];
            return response()->view('api', $message, 404);
        }
    }
}
