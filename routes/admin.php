<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\Controller;
use App\Http\Controllers\Admin\AddController;
use App\Http\Controllers\Admin\DuyetController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\LinkMovieController;
use App\Http\Controllers\Admin\EpisodeController;
use App\Http\Controllers\Admin\LeechMovieController;
use App\Http\Controllers\Admin\LogoutController;
use App\Http\Controllers\Admin\NhanVienController;
use App\Http\Controllers\Admin\KhachHangController;
use App\Http\Controllers\Admin\GoiVipController;
use App\Http\Controllers\Admin\YeuCauController;

Route::match(['get', 'post'], '/login', [LoginController::class, 'login'])->name('admin.login');
Route::middleware('auth:admin')->group(function (){
  
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/home',[HomeController::class,'index'])->name('home');
    //route admin
    //trong resource chua: get, post,...
    Route::resource('/category', CategoryController::class);
    Route::post('resorting', [CategoryController::class,'resorting'])->name('resorting');

    Route::resource('/country', CountryController::class);
    Route::resource('/genre', GenreController::class);
    Route::resource('/movie', MovieController::class);
    Route::resource('/linkmovie', LinkMovieController::class);
    //them tap phim
    Route::resource('/episode', EpisodeController::class);
    Route::get('/select-movie', [EpisodeController::class, 'select_movie'])->name('select-movie');
    //them tap phim trong phim
    Route::get('/add-episode/{id}', [EpisodeController::class, 'add_episode'])->name('add-episode');
    Route::get('/update-top-view', [MovieController::class,'update_topview'])->name('update-top-view');
    Route::get('/update-season-phim', [MovieController::class,'update_season'])->name('update-season-phim');
    Route::get('/update-year-phim', [MovieController::class,'update_year'])->name('update-year-phim');
    Route::get('/update-vip', [MovieController::class,'update_vip'])->name('update-vip');
    Route::get('/test', [HomeController::class,'test'])->name('test');
    

    //route leech movie
    Route::get('/leech-movie', [LeechMovieController::class,'leech_movie'])->name('leech-movie');
    Route::get('/leeched-movie', [LeechMovieController::class,'leeched_movie'])->name('leeched-movie');
    //Route::post('/leech-movie2', [LeechMovieController::class,'leech_movie2'])->name('leech-movie2');
    Route::get('/leech-detail/{slug}', [LeechMovieController::class,'leech_detail'])->name('leech-detail');
    Route::get('/leech-episode/{slug}', [LeechMovieController::class,'leech_episode'])->name('leech-episode');
    Route::post('/leech-store/{slug}', [LeechMovieController::class,'leech_store'])->name('leech-store');
    Route::get('/leech-episode-store/{slug}', [LeechMovieController::class,'leech_episode_store'])->name('leech-episode-store');
    Route::get('/leech-episode-single-store', [LeechMovieController::class,'leech_episode_single_store'])->name('leech-episode-single-store');
    Route::get('/leech-episode-single-delete', [LeechMovieController::class,'leech_episode_single_delete'])->name('leech-episode-single-delete');


    // add admin
    Route::get('/addHomepage', [AddController::class,'index'])->name('addHomepage');
    Route::get('/lichsu-movie',[MovieController::class, 'lichsu'])->name('lichsu-movie');
  //  Route::get('/nhanvien', [NhanVienController::class,'index'])->name('nhanvien');
    Route::get('/duyetHomepage', [DuyetController::class,'index'])->name('duyetHomepage');
    Route::get('/phim-xoa', [MovieController::class,'phim_xoa'])->name('phim-xoa');
    Route::get('/destroy-leech/{slug}', [MovieController::class,'destroy_leech'])->name('destroy-leech');

    //admin
    Route::resource('/nhanvien', NhanVienController::class);
    Route::resource('/khachhang', KhachHangController::class);
    Route::get('/khachvip',[KhachHangController::class, 'khachvip'])->name('khachvip');
    Route::resource('/goivip', GoiVipController::class);
    Route::get('/lichsu-nv',[NhanVienController::class, 'lichsu'])->name('lichsu-nv');
    Route::get('/lichsu-themphim',[HomeController::class, 'lichsu_themphim'])->name('lichsu-themphim');
    Route::get('/lichsu-duyetmovie',[HomeController::class, 'lichsu_duyetphim'])->name('lichsu-duyetmovie');
    Route::get('/xoa-nv',[NhanVienController::class, 'xoa_nv'])->name('xoa-nv');
    Route::post('/khoiphuc-nv/{slug}', [NhanVienController::class,'khoiphuc_nv'])->name('khoiphuc-nv');
    Route::get('/yeucau',[YeuCauController::class, 'index'])->name('yeucau');
    Route::post('/yeucau-accept',[YeuCauController::class, 'accept'])->name('yeucau-accept');
    Route::post('/yeucau-deny',[YeuCauController::class, 'deny'])->name('yeucau-deny');
    Route::get('/thongke',[HomeController::class, 'chart'])->name('thongke');
    Route::get('/get-month-views',[HomeController::class, 'getMonthViews'])->name('get-month-views');
    Route::get('/get-month-sales',[HomeController::class, 'getMonthSales'])->name('get-month-sales');
    
    //duyet admin
    Route::get('/duyet-phim',[DuyetController::class, 'duyetphim'])->name('duyet-phim');
    // Route::get('/duyet-ct/{id}',[DuyetController::class, 'duyet_ct'])->name('duyet-ct');
    Route::get('/duyet-ct/{slug}/{tap?}/{server_active?}',[DuyetController::class, 'duyet_ct'])->name('duyet-ct');
    Route::get('/duyet-accept/{slug}',[DuyetController::class, 'duyet_accept'])->name('duyet-accept');
    Route::get('/duyet-cancel/{slug}',[DuyetController::class, 'duyet_cancel'])->name('duyet-cancel');
    Route::get('/lichsu-duyetphim',[DuyetController::class, 'lichsu'])->name('lichsu-duyetphim');

});
