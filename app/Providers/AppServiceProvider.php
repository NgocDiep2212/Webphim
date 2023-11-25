<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Movie;
use App\Models\Episode;
use App\Models\Movie_Genre;
use Carbon\Carbon;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    
    public function boot()
    {
        // $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->orderBy('updated','DESC')->take(30)-get();
        // $phimhot_sidebar = Movie::where('resolution',5)->where('status',1)->orderBy('updated','DESC')->take(10)-get();
        // $category = Category::orderBy('position','ASC')->where('status',1)->get();
        // $genre = Genre::orderBy('position','ASC')->get();
        // $country = Country::orderBy('position','ASC')->get();

        //total admin
        $category_total = Category::all()->count();
        $genre_total = Genre::all()->count();
        $country_total = Country::all()->count();
        $movie_total = Movie::all()->count();

        //tracking user activity
        // $total_users = DB::table('tracker_sessions')->count();
        // $total_users_week = DB::table('tracker_sessions')->where('created_at','>=', Carbon::now('Asia/Ho_Chi_Minh')->subDays(7))->count();
        // $total_users_month = DB::table('tracker_sessions')->where('created_at','>=', Carbon::now('Asia/Ho_Chi_Minh')->subMonths())->count();
        // $total_users_3months = DB::table('tracker_sessions')->where('created_at','>=', Carbon::now('Asia/Ho_Chi_Minh')->subMonth(3))->count();
        // $total_users_thisyear = DB::table('tracker_sessions')->where('created_at','>=', Carbon::now('Asia/Ho_Chi_Minh')->subYear())->count();
        // $info = Info::find(1);

        View::share([
            // 'total_users' => $total_users,
            // 'total_users_week' => $total_users_week,
            // 'total_users_month' => $total_users_month,
            // 'total_users_3months' => $total_users_3months,
            // 'total_users_thisyear' => $total_users_thisyear,
            // 'info'=>$info,

            'category_total' => $category_total,
            'genre_total' => $genre_total,
            'country_total' => $country_total,
            'movie_total' => $movie_total,
            // 'info'=>$info,
        ]);
    }
}
