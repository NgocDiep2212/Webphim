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
use App\Models\Comment;
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
    public function chart(Request $request){
        
        $monthly_sales = HoaDon::selectRaw('DATE(created_at) as day, SUM(total) as total_sales')
            ->whereRaw("DATE(created_at) BETWEEN DATE_SUB(NOW(), INTERVAL 60 DAY) AND NOW()") // Use database functions for date calculations
            ->groupBy('day')
            ->get();
        
        $labels_sales = [];
        $datasets_sales = [];
        $min_time_sales = 3000-01-01;
        foreach ($monthly_sales as $key => $item) {
            $labels_sales[] = $item->day;
            $datasets_sales[] = $item->total_sales;
            $min_time_sales = MIN($min_time_sales, $item->day);
        }
        $labels_sales = json_encode($labels_sales);
        $datasets_sales = json_encode($datasets_sales);

        $monthly_views = Movie::selectRaw('DATE(created) as day, SUM(count_views) as total_views, title')
            ->whereRaw("DATE(created) BETWEEN DATE_SUB(NOW(), INTERVAL 60 DAY) AND NOW()") // Use database functions for date calculations
            ->groupBy("day")
            ->groupBy("title")
            ->orderBy('count_views','desc')
            ->take(5)
            ->get();
        
        $labels_views = [];
        $datasets_views = [];
        $min_time_views = 3000-01-01;
        foreach ($monthly_views as $key => $item) {
            $labels_views[] = $item->title;
            $datasets_views[] = $item->total_views;
            $min_time_views = MIN($min_time_views, $item->day);
        }
        
        $labels_views = json_encode($labels_views);
        $datasets_views = json_encode($datasets_views);

        $data_bar_char = Movie::orderBy('count_views','desc')->take(5)->get();
        $rating = Rating::orderBy('created_at','desc')->take(6)->get();
        $movie_comment = Movie_Comment::orderBy('created_at','desc')->take(3)->get();
        $movie_comment_reply = Movie_Comment_Reply::orderBy('created_at','desc')->take(3)->get();
        $today = Carbon::now()->format('Y-m-d');

        //return compact('today');
        return view('admincp.admin.thongke.index',compact('today','min_time_sales','min_time_views', 'labels_views','datasets_views','labels_sales','datasets_sales','rating','movie_comment','movie_comment_reply','monthly_sales','data_bar_char','monthly_views'));
    }
    
    public function sales_chart_time(Request $request){
        $data = $request->all();
        $labels = [];
        $datasets = [];
        if(isset($data['dayStart']) && isset($data['dayEnd']) && $data['dayStart'] && $data['dayEnd']){
            $dayStart = $data['dayStart'];
            $dayEnd = $data['dayEnd'];
        }
        if(isset($dayStart) && isset($dayEnd)){
            $monthly_sales = HoaDon::selectRaw('DATE(created_at) as day, SUM(total) as total_sales')
                ->whereRaw("DATE(created_at) BETWEEN '$dayStart' AND '$dayEnd'") // Use database functions for date calculations
                ->groupBy('day')
                ->get();
                
            foreach ($monthly_sales as $key => $item) {
                $labels[] = $item->day;
                $datasets[] = $item->total_sales;
            }
        }
        return compact('labels','datasets');
        
    }
    
    public function views_chart_time(Request $request){
        $data = $request->all();
        $labels_views = [];
        $datasets_views = [];
        if(isset($data['dayStart_views']) && isset($data['dayEnd_views']) && $data['dayStart_views'] && $data['dayEnd_views']){
            $dayStart_views = $data['dayStart_views'];
            $dayEnd_views = $data['dayEnd_views'];
        }
        if(isset($dayStart_views) && isset($dayEnd_views)){
            
            $monthly_views = Movie::selectRaw('DATE(created) as day, SUM(count_views) as total_views, title')
                ->whereRaw("DATE(created) BETWEEN '$dayStart_views' AND '$dayEnd_views'") // Use database functions for date calculations
                ->groupBy("day")
                ->groupBy("title")
                ->orderBy('count_views','desc')
                ->take(5)
                ->get();

            foreach ($monthly_views as $key => $item) {
                $labels_views[] = $item->title;
                $datasets_views[] = $item->total_views;
            }
        }
        //return $monthly_views;
        return compact('labels_views','datasets_views');
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

    public function banCmt(Request $request){
        $data = $request->all();
        if(isset( $data['cmtId'] )){
            $cmt_id = $data['cmtId'];
            $cmt = Movie_Comment::find($cmt_id);
            $cmt->status = 0;
            $cmt_rep = Movie_Comment_Reply::where('cmt_id', $cmt_id);
            if (isset($cmt_rep) && $cmt_rep->count() > 0) {
                foreach ($cmt_rep->get() as $reply) {
                  $reply->status = 0;
                  $reply->update(); // Update each reply object
                }
              }
            $cmt->update();
        }
        if(isset( $data['repCmtId'] )){
            $cmt_id = $data['repCmtId'];
            $cmt = Movie_Comment_Reply::find($cmt_id);
            $cmt->status = 0;
            $cmt->update();
        }
        return redirect()->back();
    }
    
}

