<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Movie;
use App\Models\Episode;
use App\Models\Movie_Genre;
use App\Models\LinkMovie;
use DB;

class IndexController extends Controller
{
    public function home(){
        $phimhot = Movie::withCount('episode')->where('phim_hot',1)->where('status',1)->orderBy('updated','DESC')->get();
        // phim sap chieu
        $phimhot_trailer = Movie::where('resolution',5)->where('status',1)->orderBy('updated','DESC')->take('5')->get();
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->orderBy('updated','DESC')->take('8')->get();
        $category = Category::orderBy('id','DESC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        //nested trong laravel: noi cac bang
        $category_home = Category::with(['movie' => function($q){
                                                        $q->withCount('episode');
                                                    }])->orderBy('id','DESC')->where('status',1)->get();
        return view('pages.home', compact('category','genre','country','category_home','phimhot','phimhot_sidebar','phimhot_trailer'));
    }
    public function category($slug){
        $category = Category::orderBy('id','DESC')->where('status',1)->get();
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->orderBy('updated','DESC')->take('5')->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $phimhot_trailer = Movie::where('resolution',5)->where('status',1)->orderBy('updated','DESC')->take('5')->get();
        $cate_slug = Category::where('slug',$slug)->first();
        $movie = Movie::withCount('episode')->where('category_id',$cate_slug->id)->orderBy('updated','DESC')->paginate(2);
        return view('pages.category', compact('category','genre','country','cate_slug','movie','phimhot_sidebar','phimhot_trailer'));
    }
    public function year($year){
        $category = Category::orderBy('id','DESC')->where('status',1)->get();
        $year = $year;
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $phimhot_trailer = Movie::where('resolution',5)->where('status',1)->orderBy('updated','DESC')->take('10')->get();
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->orderBy('updated','DESC')->take('5')->get();
        $movie = Movie::withCount('episode')->where('year',$year)->orderBy('updated','DESC')->paginate(5);
        return view('pages.year', compact('category','genre','country','year','movie','phimhot_sidebar','phimhot_trailer'));
    }
    public function tag($tag){
        $category = Category::orderBy('id','DESC')->where('status',1)->get();
        $tag = $tag;
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $phimhot_trailer = Movie::where('resolution',5)->where('status',1)->orderBy('updated','DESC')->take('10')->get();
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->orderBy('updated','DESC')->take('5')->get();
        $movie = Movie::withCount('episode')->where('tags','LIKE','%'.$tag.'%')->orderBy('updated','DESC')->paginate(5);
        return view('pages.tag', compact('category','genre','country','tag','movie','phimhot_sidebar','phimhot_trailer'));
    }
    public function genre($slug){
        $category = Category::orderBy('id','DESC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $gen_slug = Genre::where('slug',$slug)->first();

        //nhieu the loai
        $movie_genre = Movie_Genre::where('genre_id',$gen_slug->id)->get();
        $many_genre = [];
        foreach($movie_genre as $key => $movi){
            $many_genre[] = $movi->movie_id;
        }
        $movie = Movie::withCount('episode')->whereIn('id',$many_genre)->orderBy('updated','DESC')->paginate(40);
        
        $country = Country::orderBy('id','DESC')->get();
        $phimhot_trailer = Movie::where('resolution',5)->where('status',1)->orderBy('updated','DESC')->take('10')->get();
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->orderBy('updated','DESC')->take('5')->get();
        return view('pages.genre', compact('category','genre','country','gen_slug','movie','phimhot_sidebar','phimhot_trailer'));
    }
    public function country($slug){
        $category = Category::orderBy('id','DESC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $count_slug = Country::where('slug',$slug)->first();
        $phimhot_trailer = Movie::where('resolution',5)->where('status',1)->orderBy('updated','DESC')->take('10')->get();
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->orderBy('updated','DESC')->take('5')->get();
        $movie = Movie::withCount('episode')->where('country_id',$count_slug->id)->orderBy('updated','DESC')->paginate(40);
        return view('pages.country', compact('category','genre','country','count_slug','movie','phimhot_sidebar','phimhot_trailer'));
    }
    public function movie($slug){
        $category = Category::orderBy('id','DESC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $phimhot_trailer = Movie::where('resolution',5)->where('status',1)->orderBy('updated','DESC')->take('10')->get();
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->orderBy('updated','DESC')->take('5')->get();
        $movie = Movie::with('category','genre','country')->where('slug',$slug)->where('status',1)->first();
        //lay tap phim dau tien
        $episode_first = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('episode','asc')->take('1')->first();
        
        //order by random but not chứa phim có slug hiện tại, phim có thể bạn thích dựa vào cùng category
        $related = Movie::with('category','genre','country')->where('category_id',$movie->category->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get();
        //lay 3 tap gan nhat
        $episode = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('episode','DESC')->take('3')->get();
        //lay tong tap phim da them
        $episode_current_list = Episode::with('movie')->where('movie_id', $movie->id)->get();
        $episode_current_list_count = $episode_current_list->count();

        //increase moview views -  moi khi vao movie tang len 1
        $count_views = $movie->count_views;
        $count_views = $count_views +1 ;
        $movie->count_views = $count_views ;
        $movie->save();
        return view('pages.movie',compact('category','genre','country','movie','related','phimhot_sidebar','phimhot_trailer','episode','episode_first','episode_current_list_count'));
    }
    public function watch($slug,$tap,$server_active){
     
        $category = Category::orderBy('id','DESC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $phimhot_trailer = Movie::where('resolution',5)->where('status',1)->orderBy('updated','DESC')->take('10')->get();
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->orderBy('updated','DESC')->take('5')->get();
        $movie = Movie::with('category','genre','movie_genre','country','episode')->where('slug',$slug)->where('status',1)->first();
        $related = Movie::with('category','genre','country')->where('category_id',$movie->category->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get();
        
        //lay tap 
        if(isset($tap)){
            $tapphim = $tap;
            $tapphim = substr($tap,4,20);
            $server = substr($server_active, -1);
            $episode = Episode::where('movie_id',$movie->id)->where('episode',$tapphim)->where('server',$server)->first(); 
        }else{
            $tapphim = 1;
            $episode = Episode::where('movie_id',$movie->id)->where('episode',$tapphim)->first(); 
        }

        $server = LinkMovie::orderBy('id','DESC')->get();
        $episode_movie = Episode::where('movie_id',$movie->id)->orderBy('episode','ASC')->get()->unique('server');
        $episode_list = Episode::where('movie_id',$movie->id)->orderBy('episode','ASC')->get();
        return view('pages.watch',compact('server_active','episode_list','episode_movie','server','category','genre','country','movie','phimhot_sidebar','phimhot_trailer','tapphim','episode','related')); 
    }
    public function episode(){
        return view('pages.episode');
    }

    public function timkiem(){
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $category = Category::orderBy('id','DESC')->where('status',1)->get();
            $phimhot_trailer = Movie::where('resolution',5)->where('status',1)->orderBy('updated','DESC')->take('10')->get();
            $genre = Genre::orderBy('id','DESC')->get();
            $country = Country::orderBy('id','DESC')->get();
            $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->orderBy('updated','DESC')->take('5')->get();
            $movie = Movie::where('title','LIKE','%'.$search.'%')->orderBy('updated','DESC')->paginate(2);
            return view('pages.search', compact('search','category','genre','country','movie','phimhot_sidebar','phimhot_trailer'));
        }else{
            return redirect()->to('/');
        }
       
    }

    public function locphim(){
        
        //get
        $order = $_GET['order'];
        $genre_get = $_GET['genre'];
        $country_get = $_GET['country'];
        $year_get = $_GET['year_locphim'];
        if($order == '' && $genre_get == '' && $country_get == '' && $year_get == '' ){
            return redirect()->back();
        }else{
            $category = Category::orderBy('position','DESC')->where('status',1)->get();
            $phimhot_sidebar = Movie::withCount('episode')->where('phim_hot',1)->where('status',1)->orderBy('updated','DESC')->take('10')->get();
            $phimhot_trailer = Movie::where('resolution',5)->where('status',1)->orderBy('updated','DESC')->take('10')->get();
            $genre = Genre::orderBy('id','DESC')->get();
            $country = Country::orderBy('id','DESC')->get();

            $movie_array = Movie::withCount('episode'); // lay ra phim va dem so tap
            if($genre_get){
                $movie_array = $movie_array->where('genre_id',$genre_get);
            }if($country_get){
                $movie_array = $movie_array->where('country_id',$country_get);
            
            }if($year_get){
                $movie_array = $movie_array->where('year',$year_get);
            }if($order){
                $movie_array = $movie_array->orderBy($order,'ASC');
            }
            $movie_array = $movie_array->with('movie_genre');
            $movie = array();

            foreach($movie_array as $mov){//dung de liet ke all genre cua phim, thuoc 1 trong list genre
                foreach($mov->movie_genre as $mov_gen){
                    $movie = $movie_array->whereIn('genre_id',[$mov_gen->genre_id]);
                }
            }
            $movie = $movie_array->paginate(40);
            return view('pages.locphim', compact('category','genre','country','movie','phimhot_sidebar','phimhot_trailer'));
            
        }
    }
}
