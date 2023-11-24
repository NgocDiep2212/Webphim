<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Episode;
use Carbon\Carbon;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_ep = Episode::with('movie')->orderBy('episode' ,'ASC')->get();
        return view('admincp.episode.index',compact('list_ep'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_movie = Movie::orderBy('id','DESC')->pluck('title','id');
        return view('admincp.episode.form',compact('list_movie'));
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
        $episode_check = Episode::where('episode',$data['episode'])->where('movie_id', $data['movie_id'])->count();
        if($episode_check > 0){
            return redirect()->back();
        }else{
            $ep = new Episode();
            $ep->movie_id = $data['movie_id'];
            $ep->linkphim = $data['linkphim'];
            $ep->episode = $data['episode'];
            $ep->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $ep->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            $ep->save();
        }
        
        return redirect()->back();
    }

    public function add_episode($id){
        $movie = Movie::find($id);
        $list_ep = Episode::with('movie')->where('movie_id',$id)->orderBy('episode', 'DESC')->get();
        return view('admincp.episode.add_episode',compact('list_ep','movie'));
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
        $list_movie = Movie::orderBy('id','DESC')->pluck('title','id');
        $episode = Episode::find($id);
        return view('admincp.episode.form',compact('episode', 'list_movie'));
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
        $ep = Episode::find($id);
        $ep->movie_id = $data['movie_id'];
        $ep->linkphim = $data['linkphim'];
        $ep->episode = $data['episode'];
        $ep->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $ep->save();
        return redirect()->to('episode');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $episode = Episode::find($id)->delete();
        return redirect()->to('episode');
    }

    public function select_movie(){
       $id = $_GET['id'];
       $movie = Movie::find($id);
       $output='<option>--- Chọn Tập Phim ---</option>';
       if($movie->thuocphim == 'phimbo'){
           for($i=1;$i<=$movie->sotap;$i++){
                $output.='<option value="'.$i.'">'.$i.'</option>';
           }
       }
       else{
        $output.='<option value="HD">HD</option>
        <option value="FullHD">FullHD</option>
        <option value="FullHD">Cam</option>
        <option value="FullHD">HDCam</option>';
       }
       echo $output;
    }
    
}
