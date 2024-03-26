<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Chitiet_Themphim;
use App\Models\Chitiet_Duyetphim;
use App\Models\Movie;
use App\Models\Movie_Comment;
use App\Models\Movie_Comment_Reply;
use App\Models\Rating;
use App\Models\HoaDon;
use DB;
use Carbon\Carbon;

use PragmaRX\Tracker\Vendor\Laravel\Facade as Tracker;
use PragmaRX\Tracker\Vendor\Laravel\Support\Session;

class HomeController extends Controller
{
    public function index()
    {
        $sessions = Tracker::sessions();
        $user = Auth::guard('admin')->user();
        $rating = Rating::orderBy('created_at','desc')->get();
        return view('admincp.admin.index',compact('sessions'));
    }
    public function lichsu_themphim(){
        $list = Chitiet_Themphim::with('movie')->orderBy('id','DESC')->get();
        return view('admincp.admin.lichsu.themphim',compact('list'));
    }
    public function lichsu_duyetphim(){
        $list = Chitiet_Duyetphim::with('movie')->orderBy('id','DESC')->get();
        return view('admincp.admin.lichsu.duyetphim',compact('list'));
    }
    public function test(){
        return view('admincp.admin.thongke.test');
    }
    public function chart(){
        $data_bar_char = Movie::orderBy('count_views','desc')->take(5)->get();
        $rating = Rating::orderBy('created_at','desc')->take(6)->get();
        $movie_comment = Movie_Comment::orderBy('created_at','desc')->take(3)->get();
        $movie_comment_reply = Movie_Comment_Reply::orderBy('created_at','desc')->take(3)->get();
        $monthly_views = Movie::selectRaw('DATE(created) as day, SUM(count_views) as total_views')
                ->whereRaw("DATE(created) BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()") // Use database functions for date calculations
                ->groupBy('day')
                ->get();
        $monthly_sales = HoaDon::selectRaw('DATE(created_at) as day, SUM(total) as total_sales')
                ->whereRaw("DATE(created_at) BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()") // Use database functions for date calculations
                ->groupBy('day')
                ->get();
        return view('admincp.admin.thongke.index',compact('rating','movie_comment','movie_comment_reply','monthly_sales','data_bar_char','monthly_views'));
    }

    public function getMonthViews(Request $request) {
        $data = $request->all();
        $thang = $data['thang'];
        $currentMonth = Carbon::now()->month;
        $currentDay = DB::raw('DAY(NOW())'); // Get current month
    
        if (isset($thang)) {
            $thang = (int) $thang; // Ensure integer value for month
            $day = 30*$thang;
            $currentDay = Carbon::now(); // Get current date and time using Carbon
            $monthlyViews = Movie::selectRaw('DATE(created) as day, SUM(count_views) as total_views')
                ->whereRaw("DATE(created) BETWEEN DATE_SUB(NOW(), INTERVAL $day DAY) AND NOW()") // Use database functions for date calculations
                ->groupBy('day')
                ->get();
         
        }
        return $monthlyViews;
    }
    

    public function getMonthSales(Request $request) {
        $data = $request->all();
        $thang = $data['thang'];
        $currentMonth = Carbon::now()->month;
        $currentDay = DB::raw('DAY(NOW())'); // Get current month
    
        if (isset($thang)) {
            $thang = (int) $thang; // Ensure integer value for month
            $day = 30*$thang;
            $currentDay = Carbon::now(); // Get current date and time using Carbon
            $monthlySales = HoaDon::selectRaw('DATE(created_at) as day, SUM(total) as total_sales')
                ->whereRaw("DATE(created_at) BETWEEN DATE_SUB(NOW(), INTERVAL $day DAY) AND NOW()") // Use database functions for date calculations
                ->groupBy('day')
                ->get();
         
        }
        return $monthlySales;
    }
    
}

