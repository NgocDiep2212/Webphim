<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Movie_Genre;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Episode;
use Carbon\Carbon; //xu ly time
use File;

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
        $list = Movie::with('category','movie_genre','country','genre')->withCount('episode')->orderBy('id', 'DESC')->get();//category -> ten function
        
        $destinationPath=public_path()."/json_file/";
        if(!is_dir($destinationPath)){
            //tao va cap quyen them sua xoa
            mkdir($destinationPath,0777,true);
        }
        File::put($destinationPath.'movies.json',json_encode($list));
       
        return view('admincp.movie.index', compact('list'));
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

    public function update_topview(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->topview = $data['topview'];
        $movie->save();
    }

    public function filter_topview(Request $request){
        $data = $request->all();
        $movie = Movie::where('topview',$data['value'])->orderBy('updated','DESC')->get();
        $output = '';
        foreach($movie as $key => $mov){
            if($mov->resolution == 0) $text = 'HD';
            elseif($mov->resolution == 1) $text = 'SD';
            elseif($mov->resolution == 2) $text = 'HDCam';
            elseif($mov->resolution == 3) $text = 'Cam';
            elseif($mov->resolution == 4) $text = 'FullHD';
            else $text = 'Trailer';
            $output .='<div class="item">
                <a href="'.url('phim/'.$mov->slug).'" title="'.$mov->title.'">
                    <div class="item-link">
                    <img src="'.asset("uploads/movie/".$mov->image).'" class="lazy post-thumb" alt="'.$mov->title.'" title="'.$mov->title.'" />
                    <span class="is_trailer">'.$text.'</span>
                    </div>
                    <p class="title">'.$mov->title.'</p>
                </a>
                <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                <div style="float: left;">
                    <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                    <span style="width: 0%"></span>
                    </span>
                </div>
            </div>';
        }
        echo $output;
    }
    public function filter_topview_default(Request $request){
        $data = $request->all();
        $movie = Movie::where('topview',1)->orderBy('updated','DESC')->get();
        $output = '';
        foreach($movie as $key => $mov){
            if($mov->resolution == 0){
                $text = 'HD';
            }else if($mov->resolution == 1){
                $text = 'SD';
            }else if($mov->resolution == 2){
                $text = 'HDCam';
            }else{
                $text = 'Cam';
            }
            $output .='<div class="item">
                <a href="'.url('phim/'.$mov->slug).'" title="'.$mov->title.'">
                    <div class="item-link">
                    <img src="'.asset("uploads/movie/".$mov->image).'" class="lazy post-thumb" alt="'.$mov->title.'" title="'.$mov->title.'" />
                    <span class="is_trailer">'.$text.'</span>
                    </div>
                    <p class="title">'.$mov->title.'</p>
                </a>
                <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                <div style="float: left;">
                    <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                    <span style="width: 0%"></span>
                    </span>
                </div>
            </div>';
        }
        echo $output;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::pluck('title','id');
        $genre = Genre::pluck('title','id');
        $list_genre = Genre::all();
        $country = Country::pluck('title','id');
        $list = Movie::with('category','genre','country')->orderBy('id', 'DESC')->get();//category -> ten function
        return view('admincp.movie.form', compact('list','category','genre','list_genre','country'));
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
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->category_id = $data['category_id'];
        $movie->country_id = $data['country_id'];
        $movie->count_views = rand(100, 99999);
        $movie->created = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->updated = Carbon::now('Asia/Ho_Chi_Minh');

        foreach($data['genre'] as $key => $gen){
            $movie->genre_id = $gen[0];
        }

        //add image
        $get_image = $request->file('image');

        //add image
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName(); // hinhanh.jpg
            $name_image = current(explode('.',$get_name_image)); //hinhanh . jpg => hinhanh
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension(); //hinhanh1234.jpg
            $get_image->move('uploads/movie/',$new_image); //dua h.a vao path
            $movie->image = $new_image;
        
        }
        $movie->save();
        //them nhieu the loai cho phim
        // 1 id movie, nhieu id genre them vao movie_genre
        $movie->movie_genre()->sync($data['genre']);
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
        $category = Category::pluck('title','id');
        $genre = Genre::pluck('title','id');
        $list_genre = Genre::all();
        $country = Country::pluck('title','id');
        $movie = Movie::find($id);
        $movie_genre = $movie->movie_genre;
        return view('admincp.movie.form', compact('genre','country','category','movie','list_genre', 'movie_genre'));
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
        $movie->category_id = $data['category_id'];
        $movie->country_id = $data['country_id'];
        //$movie->count_views = rand(100, 99999);
        $movie->updated = Carbon::now('Asia/Ho_Chi_Minh');

        foreach($data['genre'] as $key => $gen){
            $movie->genre_id = $gen[0];
        }
        $movie->movie_genre()->sync($data['genre']);

        //add image
        $get_image = $request->file('image');

        if($get_image){
            if(file_exists('uploads/movie/'.$movie->image)){
                unlink('uploads/movie/'.$movie->image);
            }else{
                $get_name_image = $get_image->getClientOriginalName(); // hinhanh.jpg
                $name_image = current(explode('.',$get_name_image)); //hinhanh . jpg => hinhanh
                $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension(); //hinhanh1234.jpg
                $get_image->move('uploads/movie/',$new_image); //dua h.a vao path
                $movie->image = $new_image;
            }
        
        }

        $movie->save();
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
        //xoa anh
        if(file_exists('uploads/movie/'.$movie->image)){
            unlink('uploads/movie/'.$movie->image);
        }  
        //xoa the loai
        Movie_Genre::whereIn('movie_id',[$movie->id])->delete();
        
        //xoa tap phim
        Episode_Genre::whereIn('movie_id',[$movie->id])->delete();
        
        $movie->delete();
        return redirect()->back();
    }
}
