<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Chitiet_Themphim;
use App\Models\Chitiet_Duyetphim;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::guard('admin')->user();
        return view('home');
    }
    public function lichsu_themphim(){
        $list = Chitiet_Themphim::with('movie')->orderBy('id','DESC')->get();
        return view('admincp.admin.lichsu.themphim',compact('list'));
    }
    public function lichsu_duyetphim(){
        $list = Chitiet_Duyetphim::with('movie')->orderBy('id','DESC')->get();
        return view('admincp.admin.lichsu.duyetphim',compact('list'));
    }
}

