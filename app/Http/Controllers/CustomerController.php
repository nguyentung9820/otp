<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use App\History;
use App\Transactions;
use App\Configuration;

class CustomerController extends Controller
{
    public function index() {
        $session = Session::get('username');
        if(!empty($session)) {
            $data = User::all()->where('is_admin','==',0);
            return view('admin.index', ['data' => $data]);
        } else {
            return redirect('/');
        }

    }
    public function changePassword(Request $request){
        if ($request->new_password == $request->confirm_password){

        } else {
            return redirect('/')->with('notification', 'Xác thực không hợp lệ');
        }
    }
    public function viewChangePassword(){
        $session = Session::get('username');
        if(!empty($session)) {
            return view('customer.password');
        } else {
            return redirect('/');
        }
    }
    public function viewTransactions() {
        $session = Session::get('username');
        if(!empty($session)) {
            $user = User::all()->where('email','==',$session)->first();
            $data = Transactions::all()->where('user_id','=',$user->id);
            return view('customer.history', ['data' => $data]);
        } else {
            return redirect('/');
        }
    }
    public function viewDashboard() {
        $session = Session::get('username');
        $user = User::all()->where('email','==',$session)->first();
        $transactions = Transactions::all()->where('user_id','=',$user->id);
        $totalNap = 0;
        foreach($transactions as $transaction) {
            $totalNap += ($transaction->new_money - $transaction->old_money);
        }
        $otp = History::all()->where('user_id','=',$user->id);
        $count = 0;
        foreach ($otp as $data) {
            if ($data->otp) {
                $count++;
            }
        }
        if(!empty($session)) {
            return view('customer.dashboard',['tong_tien_nap' => $totalNap, 'so_du' => $user->money, 'success' => $count, 'failed' => 0]);
        } else {
            return redirect('/');
        }
    }

    public function viewNapTien() {
        $session = Session::get('username');
        if(!empty($session)) {
            return view('customer.naptien');
        } else {
            return redirect('/');
        }
    }

    public function viewDocument() {
        $session = Session::get('username');
        $user = User::all()->where('email','==',$session)->first();
        $document = Configuration::all()->where('user_id','==',$user->id)->first();
        if(!empty($session)) {
            return view('customer.document', ['data' => $document->api_key ?? '']);
        } else {
            return redirect('/');
        }
    }

    public function getOtp(Request $request) {
        $session = Session::get('username');
        $id = $request->get('history_id');
        $history = new History();
        $data = $history->where('id', $id)->first();
        $phoneNumber = $data->phone;
        $otpUrl = 'https://sosotps.com/get_code.php?apikey='.User::ADMIN_TOKEN.'&dichvu=10&sdt='.$phoneNumber;
        $res = Http::get($otpUrl);
        $result = explode('|',$res->body());
        if ($result[0] == 'OK'){
            $otp = $result[1];
            $data->otp = $otp;
            $data->status = 1;
            $data->save();
            return redirect('/thueotp')->with('notification', 'Thuê OTP thành công');
        } else {
            return redirect('/thueotp')->with('notification', 'Thuê OTP thất bại, vui lòng thử lại');
        }
    }
    public function getNumber(Request $request) {
        $session = Session::get('username');
        if (!empty($session) && $request->get('service') == 'facebook') {
            $user = User::where('email',$session)->first();
            if ($user->money < 900) {
                return redirect('/thueotp')->with('notification', 'Số dư của bạn không đủ');
            } else {
                try {
                    $url = 'https://sosotps.com/get_sdt.php?apikey='.User::ADMIN_TOKEN.'&dichvu=10';
                    $res = Http::get($url)->body();
                    $result = explode('|',$res);
                    if ($result[0] == 'OK') {
                        $user = User::where('email', $session)->first();
                        $user->money = $user->money - 900;
                        $user->save();
                        $history = new History();
                        $history->service = 'facebook';
                        $history->price = 900;
                        $history->phone = $result[1];
                        $history->user_id = $user->id;
                        $history->save();
                        return redirect('/thueotp')->with('notification', 'Tạo số điện thoại thành công');
                    } else {
                        return redirect('/thueotp')->with('notification', 'Tạo số điện thoại thất bại');
                    }
                } catch (\Exception $e) {
                    return redirect('/thueotp')->with('notification', $e->getMessage());
                }
            }
        }
        return redirect('/thueotp')->with('notification', 'Dịch vụ không tồn tại');
    }

    public function viewThueOtp(Request $request) {
        $session = Session::get('username');
        if(!empty($session)) {
            $user = User::where('email',$session)->first();
            $quantity = $request->get('quantity');
            $data = History::all()->where('user_id','==',$user->id);
            return view('customer.thueotp', ['data' => $data]);
        } else {
            return redirect('/');
        }
    }
}
