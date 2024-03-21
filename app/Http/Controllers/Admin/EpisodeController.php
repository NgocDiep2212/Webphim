<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\LinkMovie;
use App\Models\Episode;
use App\Models\Episode_Server;
use Carbon\Carbon;
use DB;

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
        return view('admincp.addAdmin.episode.index',compact('list_ep'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_movie = Movie::orderBy('id','DESC')->pluck('title','id');
        return view('admincp.addAdmin.episode.form',compact('list_movie'));
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
        $ep = new Episode();
        $ep->movie_id = $data['movie_id'];
        $ep->episode = $data['episode'];
        $ep->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $ep->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $ep->save();

        //server tap phim
        $id_ep = DB::connection()->getPdo()->lastInsertId();
        $episode_server = new Episode_Server();
        $episode_server->server_id = $data['linkserver'];
        //$episode_server->linkphim = '<iframe width="560" height="315" src="'.$data['linkphim'].'"  allowfullscreen></iframe>';
        $episode_server->linkphim = $data['linkphim'];
        $episode_server->episode_id = $id_ep;
        
       
        $episode_server->save();
 
        return redirect()->back();
    }

    public function add_episode($id){
        //dem so tap phim co server bi xoa
        $ep_se = Episode_Server::where('episode_id',$id)->where('status',0)->count();
        //dem tong so tap - neu co 1 tap va 1 tap do co server bi xoa thi khong hien thi
        $ep_se_sum = Episode_Server::where('episode_id',$id)->count();
        $linkmovie = LinkMovie::orderBy('id','desc')->pluck('title','id');
        $list_server = LinkMovie::orderBy('id','desc')->get();
        $movie = Movie::find($id);
        $list_ep = Episode::with('movie')->where('movie_id',$id)->orderBy('episode', 'DESC')->get();
        return view('admincp.addAdmin.episode.add_episode',compact('ep_se','ep_se_sum','list_ep','movie','linkmovie','list_server'));
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
        $linkmovie = LinkMovie::orderBy('id','desc')->pluck('title','id');
        $list_server = LinkMovie::orderBy('id','desc')->get();
        $list_movie = Movie::orderBy('id','DESC')->pluck('title','id');
        $episode = Episode::find($id);
        return view('admincp.addAdmin.episode.form',compact('linkmovie', 'list_server','episode', 'list_movie'));
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
        $ep->server = $data['linkserver'];
        $ep->episode = $data['episode'];
        $ep->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $ep->save();
        return redirect()->to('add-episode/'.$ep->movie_id);
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
