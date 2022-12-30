<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerLogin;
use App\Http\Controllers\ControllerAdmin;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ControllerApi;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('login.adminlogin');
});

Route::post('/register',[ControllerLogin::class, 'register'])->name('register');
Route::post('/getnumber',[CustomerController::class, 'getNumber'])->name('getNumber')->middleware('customer');
Route::post('/getotp',[CustomerController::class, 'getOtp'])->name('getOtp')->middleware('customer');

Route::get('/register', function () {
    return view('login.signin');
});

Route::get('/dashboard', [CustomerController::class, 'viewDashboard'])->middleware('customer');
Route::get('/naptien', [CustomerController::class, 'viewNapTien'])->middleware('customer');
Route::get('/document', [CustomerController::class, 'viewDocument'])->middleware('customer');
Route::get('/thueotp', [CustomerController::class, 'viewThueOtp'])->middleware('customer');
Route::get('/transactions', [CustomerController::class, 'viewTransactions'])->middleware('customer');



Route::get('admin/login', function () {
    return view('login.adminlogin');
});
Route::post('getApiKey',[ControllerApi::class, 'getApiKey'])->middleware('customer');


Route::post('admin/login',[ControllerLogin::class, 'Adminlogin'])->name('Adminlogin');

Route::get('logout',[ControllerLogin::class, 'logout']);
Route::get('forgetpassword',[ControllerLogin::class, 'forgetPassword']);
Route::post('resetpassword',[ControllerLogin::class, 'resetPassword']);
Route::get('updatepassword/{code}',[ControllerLogin::class, 'updatePassword']);
Route::post('changePassword',[ControllerLogin::class, 'changePassword']);
Route::get('password',[CustomerController::class, 'viewChangePassword'])->middleware('customer');
Route::post('password',[CustomerController::class, 'changePassword'])->middleware('customer');

// group Admin
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('home',[ControllerAdmin::class, 'index'])->name('home');
    Route::get('history', [ControllerAdmin::class, 'viewTransactions']);
    Route::get('account/block/{id}',[ControllerAdmin::class, 'blockUser'])->name('blockUser');
    Route::get('account/open/{id}',[ControllerAdmin::class, 'openUser'])->name('openUser');
    Route::post('account/add_money/{id}',[ControllerAdmin::class, 'addMoney'])->name('addMoney');

    //Account
    Route::post('account/update',[ControllerAdmin::class, 'updateAccount'])->name('UpdateAccount');
    Route::get('account/edit_account/{id}',[ControllerAdmin::class, 'editAccount'])->name('ViewEditAccount');
    Route::get('delete/{key}/{id}',[ControllerAdmin::class, 'deleteByKey']);

});

Route::prefix('api')->group(function () {
    Route::get('checkBalanceOTP/{apiKey}',[ControllerApi::class, 'checkBalanceOTP'])->middleware('checkApiKey')->name('checkBalanceOTP');
    Route::get('getServices',[ControllerApi::class, 'getServices'])->name('getServices');
    Route::get('createRequestOTP/{api_key}/service_id/{service_id}',[ControllerApi::class, 'createRequestOTP'])
        ->middleware('getPhone')
        ->name('createRequestOTP');
    Route::get('getOTPCode/{api_key}/phone/{phone_number}',[ControllerApi::class, 'getOTPCode'])
        ->middleware('GetOTPCode')
        ->name('getOTPCode');
});


