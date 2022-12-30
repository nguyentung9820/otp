<?php

namespace App\Http\Controllers;

use App\User;
use App\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ControllerAdmin extends Controller
{
    public function index() {
        $session = Session::get('username');
        if(!empty($session) && $session == User::ADMIN_TOKEN) {
            $data = User::all()->where('is_admin','==',0);
            return view('admin.index', ['data' => $data]);
        } else {
            return redirect('/');
        }
    }

    public function viewChangePassword(){
        $session = Session::get('username');
        if(!empty($session) && $session == User::ADMIN_TOKEN) {
            return view('admin.edit.password');
        } else {
            return redirect('/');
        }
    }
    public function viewTransactions() {
        $session = Session::get('username');
        if(!empty($session) && $session == User::ADMIN_TOKEN) {
            $data = Transactions::all();
            return view('admin.history', ['data' => $data]);
        } else {
            return redirect('/');
        }
    }

    public function editAccount(string $id){
        $session = Session::get('username');
        if(!empty($session)) {
            $data = User::find($id);
            return view('admin.edit.account', ['data' => $data]);
        } else {
            return redirect('/');
        }
    }

    public function addMoney(Request $request){
        $session = Session::get('username');
        if(!empty($session)) {
            $user = User::find($request->id);
            $transaction = new Transactions();
            $transaction->old_money = $user->money;
            $user->money = $user->money + $request->money;
            $transaction->new_money = $user->money;
            $transaction->user_id = $request->id;
            $transaction->email = $user->email;
            try {
                $user->save();
                $transaction->save();
                return redirect('admin/home')->with('notification', 'Nạp tiền thành công');

            } catch (\Exception $e) {
                return redirect('admin/home')->with('notification', $e->getMessage());
            }
        } else {
            return redirect('/');
        }
    }
    public function updateAccount(Request $request){
        $session = Session::get('username');
        if(!empty($session)) {
            $user = User::find($request->id);
            if($request->is_active == 'on') {
                $user->is_active = 1;
            } else{
                $user->is_active = 0;
            }
            $user->money = $request->money;
            try {
                $user->save();
                return redirect('admin/home')->with('notification', 'Sửa thông tin thành công');

            } catch (\Exception $e) {
                return redirect('admin/home')->with('notification', $e->getMessage());
            }
        } else {
            return redirect('/');
        }
    }
    public function deleteByKey($key, $id){
        $session = Session::get('username');
        if(!empty($session)) {
            switch ($key) {
                case 'delete_user' :
                    User::where('id', $id)->delete();
                    return redirect('admin/home')->with('notification', 'Xóa thành công');
                default :
                    return null;
            }
        } else {
            return redirect('/');
        }
    }

    public function blockUser(Request $request) {
        $session = Session::get('username');
        if(!empty($session)) {
            $user = User::find($request->id);
            $user->is_active = 0;
            try {
                $user->save();
                return redirect('admin/home')->with('notification', 'Khóa tài khoản thành công');
            } catch (\Exception $e) {
                return redirect('admin/home')->with('notification', $e->getMessage());
            }
        } else {
            return redirect('/');
        }
    }
    public function openUser(Request $request) {
        $session = Session::get('username');
        if(!empty($session)) {
            $user = User::find($request->id);
            $user->is_active = 1;
            try {
                $user->save();
                return redirect('admin/home')->with('notification', 'Mở tài khoản thành công');
            } catch (\Exception $e) {
                return redirect('admin/home')->with('notification', $e->getMessage());
            }
        } else {
            return redirect('/');
        }
    }
}
