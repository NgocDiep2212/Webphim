<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Episode;
use App\Models\LinkMovie;
use App\Models\Episode_Server;
use App\Models\Movie_Category;
use App\Models\Chitiet_Themphim;
use Carbon\Carbon;
use DB;
use File;
use Exception;
class LeechMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function saveJsonToFile() {
        

        $destinationPath=public_path()."/json_file/";
        if(!is_dir($destinationPath)){
            //tao va cap quyen them sua xoa
            mkdir($destinationPath,0777,true);
        }
        
        $data_new = [];
        ini_set('max_execution_time', 300);
        try {
            $client = new Client([
                'verify' => false
            ]);
        
            for($i = 1; $i<= 30; $i++){
                
                $data = $client->get('https://ophim1.com/danh-sach/phim-moi-cap-nhat?page='.$i)->getBody()->getContents();
                $json = json_decode($data,true);
                $data_new = array_merge_recursive($data_new, $json);
            }

        } catch (Exception $e) {
            echo $e;
        }
        $filePath = $destinationPath . 'movies_leech.json';
        if (file_exists($filePath)) {
            // Delete existing file to prevent duplicates
            unlink($filePath);
        }
        File::put($destinationPath.'movies_leech.json',json_encode($data_new));
        return redirect()->back();
        
      }
      

    // public function leech_movie(){
        
    //     try {
    //         $client = new Client([
    //             'verify' => false
    //         ]);
    //         if(isset($_GET['page'])){
    //             $page = $_GET['page'];
    //         }
    //         if(!isset($page)){
    //             $page=1;
    //         }
    
    //         $data = $client->get('https://ophim1.com/danh-sach/phim-moi-cap-nhat?page='.$page)->getBody()->getContents();
            
    //         $resp = json_decode($data);
    //         $totalPage = $resp->pagination->totalPages;
    
    //         return view('admincp.addAdmin.leech.index',compact('resp','totalPage','page'));
    //     } catch (Exception $e) {
    //         echo $e;
    //     }
    // }
    public function leech_movie(){

        //$this->saveJsonToFile();
        $destinationPath = public_path() . "/json_file/";
        $filePath = $destinationPath . 'movies_leech.json';
        $datas = file_get_contents($filePath);
        $datas = json_decode($datas,true);
        //return $datas;
       
        return view('admincp.addAdmin.leech.index',compact('datas'));
       
    }

    public function leeched_movie(){
        $user = Auth::guard('admin')->user();
        //$t = $this->movie_history();
        $list = Chitiet_Themphim::where('admin_id', $user->id)->get();
        return view('admincp.addAdmin.leech.lichsu',compact('list'));
        //return $t;
    }
    

    public function leech_episode($slug){
        $client = new Client([
            'verify' => false
        ]);
        $data = $client->get('https://ophim1.com/phim/'.$slug)->getBody()->getContents();

        // Decode the JSON string into an object
        $resp = json_decode($data);
        
        return view('admincp.addAdmin.leech.leech_episode',compact('resp','slug'));
    }

    public function leech_episode_single_store(Request $request){
        $data = $request->all();
        $slug = $data['slug'];
        $tap = $data['tap'];
        $movie = Movie::where('slug',$slug)->first();
        if(!isset($movie)){
            echo '<script>alert("Vui lòng thêm phim trước khi thêm tập phim")</script>';
        }else{

            $client = new Client([
                'verify' => false
            ]);
            $data = $client->get('https://ophim1.com/phim/'.$slug)->getBody()->getContents();
    
            // Decode the JSON string into an object
            $resp = json_decode($data);
            foreach($resp->episodes as $episode ){
                    
                foreach($episode->server_data as $key_data => $server){
                    if($server->name == $tap){
    
                        $ep = new Episode();
                        $ep->movie_id = $movie->id;
                        $ep->episode = $server->name;
                        $ep->created_at = Carbon::now('Asia/Ho_Chi_Minh');
                        $ep->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
                        $ep->save();
        
                        //server tap phim
                        $linkmovie = $episode->server_name;
                        $id_ep = DB::connection()->getPdo()->lastInsertId();
                        
                        $exist_server = LinkMovie::where('title',$linkmovie)->where('status',1)->first();
                        $ids = $exist_server->pluck('id');
                        // Đếm số lượng bản ghi
                        $count = count($ids);
                        if($count != 0){
                            
                            $episode_server = new Episode_Server();
                            $episode_server->server_id = $exist_server->id;
                            $episode_server->linkphim = '<iframe width="560" height="315" src="'.$server->link_embed.'"  allowfullscreen></iframe>';
                            $episode_server->episode_id = $id_ep;
                            
                        }else{
                            $new_server = new LinkMovie();
                            $new_server->title = $linkmovie;
                            $new_server->save();
                            $id_server_new = DB::connection()->getPdo()->lastInsertId();
        
                            $episode_server = new Episode_Server();
                            $episode_server->server_id = $id_server_new;
                            $episode_server->episode_id = $id_ep;
                            $episode_server->linkphim = '<iframe width="560" height="315" src="'.$server->link_embed.'"  allowfullscreen></iframe>';
                        }
                        $episode_server->save();
                    }
                }
                
            }
            return redirect()->back();
        }
        
    }

    public function leech_episode_store($slug){
        $movie = Movie::where('slug',$slug)->first();

        $client = new Client([
            'verify' => false
        ]);
        $data = $client->get('https://ophim1.com/phim/'.$slug)->getBody()->getContents();

        // Decode the JSON string into an object
        $resp = json_decode($data);
        foreach($resp->episodes as $episode ){
                
            foreach($episode->server_data as $key_data => $server){
                $movie_ep = Episode::where('movie_id',$movie->id)->where('episode', $server->name)->first();
                if(!isset($movie_ep)){

                    $ep = new Episode();
                    $ep->movie_id = $movie->id;
                    $ep->episode = $server->name;
                    $ep->created_at = Carbon::now('Asia/Ho_Chi_Minh');
                    $ep->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
                    $ep->save();
    
                    //server tap phim
                    $linkmovie = $episode->server_name;
                    $id_ep = DB::connection()->getPdo()->lastInsertId();
                    
                    $exist_server = LinkMovie::where('title',$linkmovie)->where('status',1)->first();
                    $ids = $exist_server->pluck('id');
                    // Đếm số lượng bản ghi
                    $count = count($ids);
                    if($count != 0){
                        
                        $episode_server = new Episode_Server();
                        $episode_server->server_id = $exist_server->id;
                        $episode_server->linkphim = '<iframe width="560" height="315" src="'.$server->link_embed.'"  allowfullscreen></iframe>';
                        $episode_server->episode_id = $id_ep;
                        
                    }else{
                        $new_server = new LinkMovie();
                        $new_server->title = $linkmovie;
                        $new_server->save();
                        $id_server_new = DB::connection()->getPdo()->lastInsertId();
    
                        $episode_server = new Episode_Server();
                        $episode_server->server_id = $id_server_new;
                        $episode_server->episode_id = $id_ep;
                        $episode_server->linkphim = '<iframe width="560" height="315" src="'.$server->link_embed.'"  allowfullscreen></iframe>';
                    }
                    $episode_server->save();
                }
            }
            
        }
        return redirect()->back();

    }

    public function leech_detail($slug){
        $client = new Client([
            'verify' => false
        ]);
        $data = $client->get('https://ophim1.com/phim/'.$slug)->getBody()->getContents();

        // Decode the JSON string into an object
        $resp = json_decode($data);
        $resp_movie = $resp->movie;
        // dd($resp_movie);
        return view('admincp.addAdmin.leech.leech_detail',compact('resp_movie'));

    }


    public function leech_store(Request $request, $slug){
        $client = new Client([
            'verify' => false
        ]);
        $data = $client->get('https://ophim1.com/phim/'.$slug)->getBody()->getContents();

        // Decode the JSON string into an object
        $resp = json_decode($data);
        $resp_movie = $resp->movie;
        $movie = new Movie();
        
            $movie->title = $resp_movie->name;
            $movie->slug = $resp_movie->slug;
            $movie->id_leech = $resp_movie->_id;
            $movie->name_eng = $resp_movie->origin_name;
            $movie->description = $resp_movie->content;
            if($resp_movie->type == 'single'){
                $movie->thuocphim = 'phimle';
            }else{
                $movie->thuocphim = 'phimbo';
            }
            // $movie->image = $resp_movie->thumb_url;

            //image
            try {
                $response = $client->get($resp_movie->thumb_url);
        
                if ($response->getStatusCode() === 200) {
                    $imageContent = $response->getBody()->getContents();
                    $filename = uniqid() . '.jpg';  // Generate unique filename with .jpg extension
                    $storagePath = public_path('uploads/movie/');
        
                    if (!File::exists($storagePath)) {
                        // Create the directory if it doesn't exist
                        File::makeDirectory($storagePath, 0755, true);  // Recommended permissions
                    }
        
                    if (File::put($storagePath . $filename, $imageContent)) {
                        $movie->image = $filename;  // Update movie object with saved image path
                    } 
                }
            } catch (Exception $e) {
                echo 'Lỗi lưu ảnh';
            }

            $movie->trailer = $resp_movie->trailer_url;
            $movie->duration = $resp_movie->time;
            $movie->sotap = $resp_movie->episode_total;
            $movie->tags = $resp_movie->name.','.$resp_movie->slug;
            $movie->resolution =0;
            if($resp_movie->lang == 'Vietsub'){
                $movie->vietsub = 0;
            } 
            else {
                $movie->vietsub = 1;
            }
            $movie->phim_hot = 1;
            $movie->status = 1;
            $movie->actors = implode(',',$resp_movie->actor);
            
            //genre
            $firstgenre = $resp_movie->category[0];
            $genre = Genre::where('slug',$firstgenre->slug)->orderBy('id','DESC')->first();
            if(!isset($genre)){
                $new_ca = new genre();
                $new_ca->slug = $firstgenre->slug;
                $new_ca->title = $firstgenre->name;
                $new_ca->save();
                $id_ca_new = DB::connection()->getPdo()->lastInsertId();
                $movie->genre_id = $id_ca_new;
            }else{
                $movie->genre_id = $genre->id;
            }
            
            //country
            $firstcountry = $resp_movie->country[0];
            $country = Country::where('slug',$firstcountry->slug)->orderBy('id','DESC')->first();
            if(!isset($country)){
                $new_ca = new Country();
                $new_ca->slug = $firstcountry->slug;
                $new_ca->title = $firstcountry->name;
                $new_ca->save();
                $id_ca_new = DB::connection()->getPdo()->lastInsertId();
                $movie->country_id = $id_ca_new;
            }else{
                $movie->country_id = $country->id;
            }
            
            //category
            $cate = [];
            if($resp_movie->chieurap == "true") array_push($cate, 'phim-chieu-rap');
            if((int)$resp_movie->year == (int)date("Y")) array_push($cate, 'phim-moi');
            if($resp_movie->lang != "Vietsub") array_push($cate, 'phim-thuyet-minh');
            if($resp_movie->type == "single"){
                array_push($cate, 'phim-le');
            } 
            else if($resp_movie->type == "hoathinh"){
                array_push($cate, 'phim-hoat-hinh');
            }else if($resp_movie->type != "single" && $resp_movie->type != "hoathinh"){
                array_push($cate, 'phim-bo');
            }
            $cate_mov = "";
            while($cate_mov != ""){
                $i = 0;
                $category = Category::where('slug', $cate[$i])->where('status',1)->first();
                if(isset($category)){
                    $cate_mov = $category->id;
                    break;
                }
                $i++;
            }
            if($cate_mov === ""){
                $cate_mov = 4;
            }
            $movie->category_id = $cate_mov;
            $movie->year = $resp_movie->year;
            $movie->count_views = rand(100, 99999);
            $movie->created = Carbon::now('Asia/Ho_Chi_Minh');
            $movie->updated = Carbon::now('Asia/Ho_Chi_Minh');
            $movie->save();

            $id_mov = DB::connection()->getPdo()->lastInsertId();
            //movie-genre
            foreach($resp_movie->category as $res){
                $genre_2 = genre::where('slug',$res->slug)->orderBy('id','DESC')->first();
                // nếu tồn tại cate thì set movie cate và movie_cate
                if(isset($genre_2) && $genre_2->status == 1){
                    $movie->movie_genre()->attach($genre_2);
                }else if(!isset($genre_2)){
                // nếu kh tồn tại cate thì tạo cate mới và gán
                    $new_gen = new Genre();
                    $new_gen->slug = $res->slug;
                    $new_gen->title = $res->name;
                    $new_gen->save();
                    $movie->movie_genre()->attach($new_gen);
                }
            }

            //movie-category
            foreach($cate as $ca){
                $cate_2 = Category::where('slug',$ca)->orderBy('id','DESC')->first();
                if(isset($cate_2)){
                    $movie->movie_category()->attach($cate_2);
                }
            }

            $ct_add = new Chitiet_Themphim();
            $user = Auth::guard('admin')->user();
            $ct_add->movie_id = $id_mov;
            $ct_add->admin_id = $user->id;
            $ct_add->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $ct_add->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            $ct_add->save();
        $this->leech_episode_store($resp_movie->slug);
        return redirect()->back();
    }

    public function leech_episode_single_delete(Request $request){
        $data = $request->all();
        $movie = Movie::where('slug',$data['slug'])->first();
        $episode = Episode::where('movie_id',$movie->id)->where('episode',$data['tap'])->first();
        $episode_server = Episode_Server::where('episode_id',$episode->id);
        $episode->delete();
        $episode_server->delete();
        return redirect()->back();
    }

    public function index()
    {

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
