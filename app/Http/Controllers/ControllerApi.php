<?php

namespace App\Http\Controllers;

use App\History;
use App\User;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Configuration;

class ControllerApi extends Controller
{
    public function getApiKey() {
        $session = Session::get('username');
        if(!empty($session)) {
            $user = User::where('email',$session)->first();
            try {
                Configuration::where('user_id', $user->id)->delete();
                $config = new Configuration();
                $config->user_id = $user->id;
                $config->api_key = $this->getRandomString();
                $config->save();
                return redirect('/document')->with('notification', 'Lấy thành công API Key');

            } catch (\Exception $e) {
                return redirect('/document')->with('notification', $e->getMessage());
            }
        } else {
            return redirect('/');
        }
    }
    public function getRandomString() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < 31; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }


    public function checkBalanceOTP(Request $request) {
        $id = $request->id;
        $user = User::where('id',$id)->first();
        $message = [
            'status' => 200,
            'message' => [
                'status' => 200,
                'message' => "Thành công",
                'balance' => $user->money
            ],
        ];
        return view('api', $message, ['Content-Type' => 'application/json']);
    }
    public function getServices() {
        $message = [
            'status' => 200,
            'message' => [
                "status" => 200,
                "message" => "Thành công",
                "data" => [
                    "id" => 10,
                    "service_name" => "Facebook",
                    "price" => 900
                ]
            ],
        ];
        return view('api', $message, ['Content-Type' => 'application/json']);
    }

    public function getOTPCode(Request $request) {
        $phone = $request->phone;
        $history = new History();
        $data = $history->where('phone', $phone)->first();
        $otpUrl = 'https://sosotps.com/get_code.php?apikey='.User::ADMIN_TOKEN.'&dichvu=10&sdt='.$phone;
        $res = Http::get($otpUrl);
        $result = explode('|',$res->body());
        if ($result[0] == 'OK'){
            $otp = $result[1];
            $data->otp = $otp;
            $data->status = 1;
            $data->save();
            $message = [
                'status' => 200,
                'message' => [
                    "status" => 200,
                    "message" => "Thành công",
                    "otpcode" => $otp
                ],
            ];
            return view('api', $message, ['Content-Type' => 'application/json']);
        } else {
            $message = [
                'status' => 200,
                'message' => 'Lấy OTP thất bại. Vui lòng thử sau ít phút'
            ];
            return view('api', $message, ['Content-Type' => 'application/json']);
        }
    }
    public function createRequestOTP(Request $request){
        $user = User::where('id', $request->id)->first();
        if ($user->money < 900) {
            $message = [
                'status' => 200,
                'message' => 'Số dư của bạn không đủ'
            ];
            return view('api', $message, ['Content-Type' => 'application/json']);
        } else {
            try {
                $url = 'https://sosotps.com/get_sdt.php?apikey='.User::ADMIN_TOKEN.'&dichvu=10';
                $res = Http::get($url)->body();
                $result = explode('|',$res);
                if ($result[0] == 'OK') {
                    $user->money = $user->money - 900;
                    $user->save();
                    $history = new History();
                    $history->service = 'facebook';
                    $history->price = 900;
                    $history->phone = $result[1];
                    $history->user_id = $user->id;
                    $history->save();
                    $message = [
                        'status' => 200,
                        'message' => [
                            "status" => 200,
                            "message" => "Thành công",
                            "data" => [
                                "phone" => $result[1],
                                "otp_code" => "",
                                "status" => 200,
                                "name" => "Facebook",
                                "price" => 900,
                            ]
                        ],
                    ];
                    return view('api', $message, ['Content-Type' => 'application/json']);
                } else {
                    $message = [
                        'status' => 200,
                        'message' => 'Không thể lấy số điện thoại. Vui lòng thử lại sau ít phút'
                    ];
                    return view('api', $message, ['Content-Type' => 'application/json']);
                }
            } catch (\Exception $e) {
                $message = [
                    'status' => 200,
                    'message' => 'Có lỗi xảy ra, vui lòng thử lại sau ít phút'
                ];
                return view('api', $message, ['Content-Type' => 'application/json']);
            }
        }
    }
}
