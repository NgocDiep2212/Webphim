<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Episode;
use App\Models\LinkMovie;
use App\Models\Episode_Server;
use App\Models\Chitiet_Duyetphim;
use Carbon\Carbon;

class DuyetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //asc: số 0 đi đầu, desc: cuối đi đầu
        return view('admincp.duyetAdmin.index');
    }

    public function lichsu(){
        $user = Auth::guard('admin')->user();
        $list = Chitiet_Duyetphim::where('admin_id',$user->id)->orderBy('id','DESC')->get();
        return view('admincp.duyetAdmin.duyetphim.lichsu',compact('list'));
    }

    public function duyet_ct($slug,$tap =null,$server_active = null)
    {
        //asc: số 0 đi đầu, desc: cuối đi đầu
        $movie = Movie::where('slug',$slug)->first();
        $ep = Episode::where('movie_id',$movie->id)->count();
        if($ep == 0){
            echo 'Chưa thêm tập phim';
        }else{
            //lay tap 
            if(isset($tap)){
                $tapphim = $tap;
                $tapphim = substr($tap,4,20);
                $server = substr($server_active, -1);
                $episode = Episode::where('movie_id',$movie->id)->where('episode',$tapphim)->first(); 
            }else{
                $tapphim = 1;
                $episode = Episode::where('movie_id',$movie->id)->where('episode',$tapphim)->first(); 
                if(!isset($episode)){
                    $episode = Episode::where('movie_id',$movie->id)->first(); 
                }
            }
    
            // $first_ep = Episode::where('movie_id',$id)->first();
            $server = LinkMovie::with('sodes')->orderBy('id','DESC')->get();
            $episode_movie = Episode::where('movie_id',$movie->id)->orderBy('episode','ASC')->get()->unique('server');
            $episode_link = Episode_Server::where('episode_id', $episode->id)->first();
            $episode_list = Episode::where('movie_id',$movie->id)->orderBy('episode','ASC')->get();
            return view('admincp.duyetAdmin.duyetphim.chitietphim',compact('movie','episode','server','episode_movie','episode_link','episode_list'));
            //return $movie;

        }
    }
    public function duyetphim()
    {
        //asc: số 0 đi đầu, desc: cuối đi đầu
        $list = Movie::where('status',1)->where('duyet',0)->orderBy('id','ASC')->get();
        return view('admincp.duyetAdmin.duyetphim.index',compact('list'));
    }
    public function duyet_accept($slug)
    {
        //asc: số 0 đi đầu, desc: cuối đi đầu
        $movie = Movie::where('slug',$slug)->first();
        $movie->duyet = 1;
        
        $ct_add = new Chitiet_Duyetphim();
        $user = Auth::guard('admin')->user();
        $ct_add->status = 1;
        $ct_add->movie_id = $movie->id;
        $ct_add->admin_id = $user->id;
        $ct_add->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->update();
        $ct_add->save();
        return redirect()->route('duyet-phim');
    }
    public function duyet_cancel($slug)
    {
        //asc: số 0 đi đầu, desc: cuối đi đầu
        $movie = Movie::where('slug',$slug)->first();
        $movie->duyet = 2;

        $ct_add = new Chitiet_Duyetphim();
        $user = Auth::guard('admin')->user();
        $ct_add->status = 0;
        $ct_add->movie_id = $movie->id;
        $ct_add->admin_id = $user->id;
        $ct_add->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        
        $movie->update();
        $ct_add->save();
        return redirect()->route('duyet-phim');
    }

}
