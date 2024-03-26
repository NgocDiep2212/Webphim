<?php
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\IndexController;
use App\Http\Controllers\User\LogoutController;


// Tạo route để quên mật khẩu
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/reset', [ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset/{token}', [ResetPasswordController::class, 'reset']);

// Tạo route để tạo tài khoản mới
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::match(['get', 'post'], '/login', [LoginController::class, 'login'])->name('login');

Route::get('/danh-muc/{slug}',[IndexController::class, 'category'])->name('category');
Route::get('/the-loai/{slug}',[IndexController::class, 'genre'])->name('genre');
Route::get('/quoc-gia/{slug}',[IndexController::class, 'country'])->name('country');
Route::get('/phim/{slug}',[IndexController::class, 'movie'])->name('movie');
Route::get('/xem-phim/{slug}/{tap}/{server_active}',[IndexController::class, 'watch']);
Route::get('/so-tap',[IndexController::class, 'episode'])->name('so-tap');
Route::get('/nam/{year}', [IndexController::class,'year']);
Route::get('/tag/{tag}', [IndexController::class,'tag']);
Route::get('/tim-kiem', [IndexController::class,'timkiem'])->name('tim-kiem');
Route::get('/locphim', [IndexController::class,'locphim'])->name('locphim');
Route::post('/filter-topview-phim', [IndexController::class,'filter_topview'])->name('filter-topview-phim');
Route::get('/filter-topview-default', [IndexController::class,'filter_topview_default'])->name('filter-topview-default');

Route::get('/', [IndexController::class, 'home'])->name('homepage');
Route::middleware('auth')->group(function (){
    //Route::get('/logout', ['LogoutController::class', 'perform'])->name('logout');
    Route::post('/logout', [LogoutController::class,'perform'])->name('logout');

    Route::post('/binhluanphim', [IndexController::class,'binhluanphim'])->name('binhluanphim');
    Route::post('/add-rating', [IndexController::class,'add_rating'])->name('add-rating');
    Route::post('/add-yeuthich', [IndexController::class,'add_yeuthich'])->name('add-yeuthich');
    
    Route::get('/muagoi', [IndexController::class,'muagoi'])->name('muagoi');
    Route::post('/thanh-toan', [IndexController::class,'thanh_toan'])->name('thanh-toan');
    Route::post('/thanh-toan-vnpay', [IndexController::class,'thanh_toan_vnpay'])->name('thanh-toan-vnpay');
    Route::get('/thanh-toan-vnpay-success', [IndexController::class,'thanh_toan_vnpay_success'])->name('thanh-toan-vnpay-success');
    Route::get('/pay-success', [IndexController::class,'pay_success'])->name('pay-success');
    Route::post('/nangcap', [IndexController::class,'nangcap'])->name('nangcap');
    Route::get('/related', [IndexController::class,'related_movie'])->name('related');
});