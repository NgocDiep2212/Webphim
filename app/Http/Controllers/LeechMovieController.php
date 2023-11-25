<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Episode;
use App\Models\LinkMovie;
use Carbon\Carbon;

class LeechMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function leech_movie(){
        $client = new Client([
            'verify' => false
        ]);
        $data = $client->get('https://ophim1.com/danh-sach/phim-moi-cap-nhat?page=3')->getBody()->getContents();

        // Decode the JSON string into an object
        $resp = json_decode($data);
        
        return view('admincp.leech.index',compact('resp'));
    }

    public function leech_episode($slug){
        $client = new Client([
            'verify' => false
        ]);
        $data = $client->get('https://ophim1.com/phim/'.$slug)->getBody()->getContents();

        // Decode the JSON string into an object
        $resp = json_decode($data);
        
        return view('admincp.leech.leech_episode',compact('resp'));
    }

    public function leech_episode_store(Request $request, $slug){
        $movie = Movie::where('slug',$slug)->first();

        $client = new Client([
            'verify' => false
        ]);
        $data = $client->get('https://ophim1.com/phim/'.$slug)->getBody()->getContents();

        // Decode the JSON string into an object
        $resp = json_decode($data);
        foreach($resp->episodes as $episode ){
            foreach($episode->server_data as $key_data => $server){
                $ep = new Episode();
                $ep->movie_id = $movie->id;
                $ep->linkphim = '<iframe width="560" height="315" src="'.$server->link_embed.'"  allowfullscreen></iframe>';
           
                $ep->episode = $server->name;
                if($key_data==0){
                    $linkmovie = LinkMovie::orderBy('id','DESC')->first();
                    $ep->server = $linkmovie->id;

                }else{
                    $linkmovie = LinkMovie::orderBy('id','ASC')->first();
                    $ep->server = $linkmovie->id;
                }
                $ep->created_at = Carbon::now('Asia/Ho_Chi_Minh');
                $ep->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
                $ep->save();
            }
                
        }
        return redirect()->route('leech-movie');

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
        return view('admincp.leech.leech_detail',compact('resp_movie'));

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
            $movie->thuocphim = 'phimbo';
            $movie->sotap = $resp_movie->episode_total;
            $movie->trailer = $resp_movie->trailer_url;
            $movie->tags = $resp_movie->name.','.$resp_movie->slug;
            $movie->duration = $resp_movie->time;
            $movie->resolution =0;
            $movie->phim_hot = 1;
            $movie->name_eng = $resp_movie->origin_name;
            $movie->vietsub = 0;
            $movie->slug = $resp_movie->slug;
            $movie->description = $resp_movie->content;
            $movie->image = $resp_movie->thumb_url;
            $movie->status = 1;
            $category = Category::orderBy('id','DESC')->first();
            $movie->category_id = $category->id;
            $country = Country::orderBy('id','DESC')->first();
            $movie->country_id = $country->id;
            $genre = Genre::orderBy('id','DESC')->first();
            $movie->genre_id = $genre->id;
            $movie->year = $resp_movie->year;
            $movie->count_views = rand(100, 99999);
            $movie->created = Carbon::now('Asia/Ho_Chi_Minh');
            $movie->updated = Carbon::now('Asia/Ho_Chi_Minh');

            $movie->save();

            $movie->movie_genre()->attach($genre);
        
        

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
