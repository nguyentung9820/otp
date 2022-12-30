<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Otp;
class ControllerLogin extends Controller
{
    public function Adminlogin(Request $request)
    {
        $this->validate($request,
            [
                'username'=> 'required',
                'password' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
            ],
            [
                'username' => 'Username',
                'password' => 'Password',
            ]);

        $username = $request['username'];
        $password = $request['password'];
        if ($username == 'admin') {
            if (Auth::attempt(['name' => $username, 'password' => $password])) {
                Session::put('username', User::ADMIN_TOKEN);
                Session::put('password', $password);
                return redirect()->route('home');
            } else {
                return redirect('/')->with('notification', 'Tên đăng nhập hoặc mật khẩu không đúng');
            }
        } else {
            $secondCheck = User::where('email',$username)->first();
            if ($secondCheck && Auth::attempt(['email' => $username, 'password' => $password])) {
                Session::put('username',$username);
                Session::put('password', $password);
                return redirect('/dashboard');
            }
            return redirect('/')->with('notification', 'Tên đăng nhập hoặc mật khẩu không đúng');
        }
    }

    public function register(Request $request) {
        $this->validate($request,
            [
                'username'=> 'required',
                'password' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
            ],
            [
                'username' => 'Username',
                'password' => 'Password',
            ]);

        $username = $request['username'];
        if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
            return redirect('/register')->with('notification', 'Sai định dạng Email');
        }
        $password = $request['password'];
        $firstCheck = User::where('email',$username)->first();
        if (!$firstCheck) {
                //Data Request
                $user = new User();
                $password = bcrypt($password);
                $user->name = $username;
                $user->password = $password;
                $user->is_admin = 0;
                $user->is_active = 1;
                $user->email = $username;
                try {
                    $user->save();
                    return redirect('/')->with('notification', 'Đăng ký thành công');
                } catch (\Exception $e) {
                    return redirect('/register')->with('notification', 'Có lỗi xảy ra, vui lòng liên hệ quản trị viên');
                }
        } else {
            return redirect('/register')->with('notification', 'Tài khoản đã tồn tại');
        }
    }
    public function logout()
    {
        Session::forget('username');
        Auth::logout();
        return redirect('/');
    }

    public function forgetPassword(){
        return view('login.password');
    }

    public function resetPassword(Request $request){
        $email = $request->email;
        if (!User::where('email', $email)->first()){
            return redirect('/forgetpassword')->with('notification','Tài khoản không tồn tại');
        }
        try {
            $old = OTP::where('email', $email)->first();
            if (!$old){
                $otp = new Otp();
                $otp->type = 'password';
                $otp->status = 1;
                $otp->email = $email;
                $code = $this->getRandomString();
                $otp->code = $code;
                $otp->save();
                $this->sendEmail($email, $otp->code);
                return redirect('/forgetpassword')->with('notification','Thông tin thay đổi mật khẩu đã được gửi tới email'.$code);
            } else {
                if($old->count < 2) {
                    $code = $this->getRandomString();
                    $old->code = $code;
                    $old->count += 1;
                    $old->save();
                    $this->sendEmail($email, $code);
                    return redirect('/forgetpassword')->with('notification','Thông tin thay đổi mật khẩu đã được gửi tới email'.$code);
                } else {
                    $now = new \DateTime();
                    if ($old->updated_at->getTimestamp() - 60*60 > $now->getTimestamp()){
                        $code = $this->getRandomString();
                        $old->code = $code;
                        $old->count = 0;
                        $old->save();
                        $this->sendEmail($email, $code);
                        return redirect('/forgetpassword')->with('notification','Thông tin thay đổi mật khẩu đã được gửi tới email'.$code);
                    } else {
                        return redirect('/forgetpassword')->with('notification','Bạn đã quá số lần đổi mật khẩu, vui lòng chờ 1 tiếng để thực hiện lại');
                    }
                }
            }
        } catch (\Exception $e){
            return redirect('/forgetpassword')->with('notification','Vui lòng thử lại sau ít phút');
        }

    }

    public function sendEmail($email, $code){
        $otpUrl = 'localhost:993';
        $res = Http::post($otpUrl,[
            'email' => $email,
            'url' => $code
        ]);
    }
    public function getRandomString() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < rand(600,700); $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    public function updatePassword(Request $request){
        if($request->code){
            $otp = OTP::where('code', $request->code)->first();
            if ($otp){
                return view('login.reset',['code' => $request->code]);
            } else {
                return redirect('/')->with('notification','Yêu cầu không tồn tại');
            }
        } else {
            return redirect('/')->with('notification','Yêu cầu không tồn tại');
        }
    }
    public function changePassword(Request $request) {
        $this->validate($request,
            [
                'password2nd'=> 'required',
                'password' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
            ],
            [
                'password2nd' => 'Password2nd',
                'password' => 'Password',
            ]);
        if ($request->code){
            if ($request->password != $request->password2nd) {
                return redirect('/updatepassword/'.$request->code)->with('notification','Mật khẩu không trùng khớp');
            }
            $otp = OTP::where('code', $request->code)->first();
            if ($otp) {
                $user = User::where('email', $otp->email)->first();
                if (!$user) {
                    return redirect('/')->with('notification','Tài khoản không tồn tại');
                }
                try {
                    $user->password = bcrypt($request->password);
                    $user->save();
                    $otp->delete();
                    return redirect('/')->with('notification','Đổi mật khẩu thành công');
                } catch (\Exception $e){
                    return redirect('/')->with('notification','Đổi mật khẩu thất bại');
                }
            } else {
                return redirect('/')->with('notification','Đổi mật khẩu thất bại');
            }
        } else {
            return redirect('/')->with('notification','Đổi mật khẩu thất bại');
        }

    }
}
