<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Movie_Genre;
use App\Models\Movie_Category;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Chitiet_Themphim;
use Carbon\Carbon; //xu ly time
use File;
use DB;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //1 phim co nhieu tap, episode count dua vao id movie cua tap 
        $list = Movie::with('activeCategory','activeMovieGenre','activeMovieCategory','activeCountry','activeGenre')->orderBy('id', 'DESC')->get();//category -> ten function
        $destinationPath=public_path()."/json_file/";
        if(!is_dir($destinationPath)){
            //tao va cap quyen them sua xoa
            mkdir($destinationPath,0777,true);
        }
        File::put($destinationPath.'movies.json',json_encode($list));
       
        return view('admincp.addAdmin.movie.index', compact('list'));
    }

    public function lichsu(){
        $user = Auth::guard('admin')->user();
        $list = Chitiet_Themphim::with('activeMovie')->where('admin_id',$user->id)->orderBy('id','DESC')->get();
        return view('admincp.addAdmin.movie.lichsu',compact('list'));
    }

    public function phim_xoa(){
        $user = Auth::guard('admin')->user();
        $list = Chitiet_Themphim::where('status',2)->orderBy('id','DESC')->get()->unique('admin_id');
        return view('admincp.addAdmin.movie.phim_xoa',compact('list'));
    }

    public function update_year(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->year = $data['year'];
        $movie->save();
    }

    public function update_season(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->season = $data['season'];
        $movie->save();
    }

    public function update_topview(Request $request ){
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->topview = $data['topview'];
        $movie->update();
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('status',1)->pluck('title','id');
        $genre = Genre::where('status',1)->pluck('title','id');
        $list_genre = Genre::where('status',1)->get();
        $list_category = Category::where('status',1)->get();
        $country = Country::where('status',1)->pluck('title','id');
        $list = Movie::with('category','genre','country')->where('status',1)->orderBy('id', 'DESC')->get();//category -> ten function
        return view('admincp.addAdmin.movie.form', compact('list','category','genre','list_genre','list_category','country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $movie = new Movie();
        $movie->title = $data['title'];
        $movie->thuocphim = $data['thuocphim'];
        $movie->sotap = $data['sotap'];
        $movie->trailer = $data['trailer'];
        $movie->tags = $data['tags'];
        $movie->duration = $data['duration'];
        $movie->resolution = $data['resolution'];
        $movie->phim_hot = $data['phim_hot'];
        $movie->name_eng = $data['name_eng'];
        $movie->vietsub = $data['vietsub'];
        $movie->slug = $data['slug'];
        $movie->year = $data['year'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        // $movie->category_id = $data['category_id'];
        $movie->country_id = $data['country_id'];
        $movie->image = $data['image'];
        $movie->count_views = rand(100, 99999);
        $movie->created = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->updated = Carbon::now('Asia/Ho_Chi_Minh');

        foreach($data['genre'] as $key => $gen){
            $movie->genre_id = $gen[0];
        }

        foreach($data['category'] as $key => $gen){
            $movie->category_id = $gen[0];
        }

        // //add image
        // $get_image = $request->file('image');

        // //add image
        // if($get_image){
        //     $get_name_image = $get_image->getClientOriginalName(); // hinhanh.jpg
        //     $name_image = current(explode('.',$get_name_image)); //hinhanh . jpg => hinhanh
        //     $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension(); //hinhanh1234.jpg
        //     $get_image->move('uploads/movie/',$new_image); //dua h.a vao path
        //     $movie->image = $new_image;
        
        // }
        $movie->save();
        $id_mov = DB::connection()->getPdo()->lastInsertId();
        //them nhieu the loai cho phim
        // 1 id movie, nhieu id genre them vao movie_genre
        $movie->movie_genre()->attach($data['genre']);
        foreach($data['category'] as $key => $gen){
            $movie->movie_category()->attach($gen);
        }
        $ct_add = new Chitiet_Themphim();
        $user = Auth::guard('admin')->user();
        $ct_add->movie_id = $id_mov;
        $ct_add->admin_id = $user->id;
        $ct_add->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $ct_add->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $ct_add->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::where('status',1)->pluck('title','id');
        $genre = Genre::where('status',1)->pluck('title','id');
        $list_genre = Genre::where('status',1)->get();
        $list_category = Category::where('status',1)->get();
        $country = Country::where('status',1)->pluck('title','id');
        $movie = Movie::find($id);
        $movie_genre = $movie->activeMovieGenre;
        $movie_category = $movie->activeCategory;
        
        return view('admincp.addAdmin.movie.form', compact('list_category','genre','country','category','movie','list_genre', 'movie_genre', 'movie_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        // return response()->json($data['genre']);
        $movie = Movie::find($id);
        $movie->title = $data['title'];
        $movie->thuocphim = $data['thuocphim'];
        $movie->sotap = $data['sotap'];
        $movie->trailer = $data['trailer'];
        $movie->tags = $data['tags'];
        $movie->duration = $data['duration'];
        $movie->resolution = $data['resolution'];
        $movie->phim_hot = $data['phim_hot'];
        $movie->name_eng = $data['name_eng'];
        $movie->vietsub = $data['vietsub'];
        $movie->slug = $data['slug'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->country_id = $data['country_id'];
        $movie->image = $data['image'];

        //$movie->count_views = rand(100, 99999);
        $movie->updated = Carbon::now('Asia/Ho_Chi_Minh');

        foreach($data['genre'] as $key => $gen){
            $movie->genre_id = $gen[0];
        }

        foreach($data['category'] as $key => $gen){
            $movie->category_id = $gen[0];
        }
        $movie->movie_genre()->sync($data['genre']);
        $movie->movie_category()->sync($data['category']);

        // //add image
        // $get_image = $request->file('image');

        // if($get_image){
        //     if(file_exists('uploads/movie/'.$movie->image)){
        //         unlink('uploads/movie/'.$movie->image);
        //     }else{
        //         $get_name_image = $get_image->getClientOriginalName(); // hinhanh.jpg
        //         $name_image = current(explode('.',$get_name_image)); //hinhanh . jpg => hinhanh
        //         $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension(); //hinhanh1234.jpg
        //         $get_image->move('uploads/movie/',$new_image); //dua h.a vao path
        //         $movie->image = $new_image;
        //     }
        
        // }

        $movie->update();
        
        $ct_add = new Chitiet_Themphim();
        $user = Auth::guard('admin')->user();
        $ct_add->status = 1;
        $ct_add->movie_id = $id;
        $ct_add->admin_id = $user->id;
        $ct_add->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $ct_add->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $ct_add->save();
        return redirect()->route('movie.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);
        $movie->status = 0;
        $movie->update();

        $ct_add = new Chitiet_Themphim();
        $user = Auth::guard('admin')->user();
        $ct_add->status = 2;
        $ct_add->movie_id = $id;
        $ct_add->admin_id = $user->id;
        $ct_add->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $ct_add->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $ct_add->save();
        //xoa anh
        // if(file_exists('uploads/movie/'.$movie->image)){
        //     unlink('uploads/movie/'.$movie->image);
        // }  
        
        //xoa tap phim
        // $ep = Episode::whereIn('movie_id',[$movie->id]);
        // $ep->status = 0;
        // $movie->update();
        return redirect()->back();
    }
    public function destroy_leech($id)
    {
        $mov= Movie::find($id);
        $mov->delete();
        //xoa tap phim
        $ep = Episode::where('movie_id',$id);
        if(isset($ep)){
            $ep->delete();
        }
        return redirect()->back();
    }
}
