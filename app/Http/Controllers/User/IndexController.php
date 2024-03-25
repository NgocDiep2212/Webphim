<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Movie;
use App\Models\Episode;
use App\Models\Movie_Genre;
use App\Models\LinkMovie;
use App\Models\Episode_Server;
use App\Models\Movie_Category;
use App\Models\Movie_Comment;
use App\Models\Movie_Comment_Reply;
use App\Models\Rating;
use App\Models\YeuThich;
use App\Models\GoiVip;
use App\Models\HoaDon;
use App\Models\YeuCau;

use Algenza\Cosinesimilarity\Cosine;
use Mail;
use Carbon\Carbon;
use DB;

class IndexController extends Controller
{

    public function home(){
        //nested trong laravel: noi cac bang
        $user = Auth::guard('web')->user();
        
        $visitor = \Tracker::currentSession();
        if($visitor) {
            $visitor->user_id= Auth::user()->id;
            $visitor->save();
        }
        $yeuthich_list = YeuThich::where('user_id',$user->id)->with('movie')->with('movie_sum')->get();
        // $category_home = Category::with(['movie' => function($q){
        //                                                 $q->withCount('episode');
        //                                             }])->orderBy('id','DESC')->where('status',1)->get();
        $category_home = Category::orderBy('id','ASC')->where('status',1)->get();
        return view('pages.home', compact('category_home','yeuthich_list'));
    }
    public function category($slug){
        $cate_slug = Category::where('slug',$slug)->where('status',1)->first();

        //nhieu the loai
        $movie_category = Movie_Category::where('category_id',$cate_slug->id)->get();
        $many_category = [];
        foreach($movie_category as $key => $movi){
            $many_category[] = $movi->movie_id;
        }
        $movie = Movie::withCount('episode')->whereIn('id',$many_category)->where('status',1)->where('duyet',1)->orderBy('updated','DESC')->paginate(40);
        //$movie = Movie::where('id',$movie_cate->movie_id)->orderBy('updated','DESC')->paginate(10);
        return view('pages.category', compact('cate_slug','movie'));
    }
    public function year($year){
        $year = $year;
        $movie = Movie::withCount('episode')->where('status',1)->where('duyet',1)->where('year',$year)->orderBy('updated','DESC')->paginate(5);
        return view('pages.year', compact('year','movie'));
    }
    public function tag($tag){
        $tag = $tag;
        $movie = Movie::withCount('episode')->where('duyet',1)->where('tags','LIKE','%'.$tag.'%')->where('status',1)->orderBy('updated','DESC')->paginate(5);
        return view('pages.tag', compact('tag','movie'));
    }
    public function genre($slug){
        $gen_slug = Genre::where('slug',$slug)->where('status',1)->first();
        //nhieu the loai
        $movie_genre = Movie_Genre::where('genre_id',$gen_slug->id)->get();
        $many_genre = [];
        foreach($movie_genre as $key => $movi){
            $many_genre[] = $movi->movie_id;
        }
        $movie = Movie::withCount('episode')->whereIn('id',$many_genre)->where('duyet',1)->where('status',1)->orderBy('updated','DESC')->paginate(40);
        return view('pages.genre', compact('gen_slug','movie'));
    }
    public function country($slug){
        $count_slug = Country::where('slug',$slug)->first();
        $movie = Movie::withCount('episode')->where('country_id',$count_slug->id)->where('duyet',1)->where('status',1)->orderBy('updated','DESC')->paginate(40);
        return view('pages.country', compact('count_slug','movie'));
    }
    public function movie($slug){
       
        $movie = Movie::with('category','genre','country')->where('slug',$slug)->where('duyet',1)->where('status',1)->first();
        //lay tap phim dau tien
        $episode_first = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('episode','asc')->first();
        
        //order by random but not chứa phim có slug hiện tại, phim có thể bạn thích dựa vào cùng category
        $related = Movie::with('category','genre','country')->where('country_id',$movie->country->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->where('status',1)->where('duyet',1)->get();
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
        //binh luan
        $bl_temp = Movie_Comment::where('movie_id', $movie->id)->with('movie_comment_reply')->get();
        if(isset($bl_temp)) $bl = $bl_temp;

        //rating
        $rating = Rating::where('movie_id', $movie->id)->avg('rate');
        $rating = round($rating);
        $count_total = Rating::where('movie_id', $movie->id)->count();

        //yeuthich
        $user = Auth::guard('web')->user();
        $yeuthich_list = YeuThich::where('user_id',$user->id)->with('movie')->with('movie_sum')->get();
        $yeuthich = YeuThich::where('movie_id',$movie->id)->with('movie')->where('user_id',$user->id)->count();
        return view('pages.movie',compact('user','yeuthich','yeuthich_list','rating','count_total','bl','movie','related','episode','episode_first','episode_current_list_count'));
    }
    public function watch($slug, $tap, $server_active){
        $movie = Movie::with('category','genre','movie_genre','country','episode')->where('slug',$slug)->where('duyet',1)->where('status',1)->first();
        //$related = Movie::with('category','genre','country')->where('category_id',$movie->category->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get();
        $related = Movie::with('category','genre','country')->where('country_id',$movie->country->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->where('duyet',1)->get();
        
        //lay tap 
        if(isset($tap)){
            $tapphim = $tap;
            $tapphim = substr($tap,4,20);
            $server = substr($server_active, -1);
            
        }else{
            $tapphim = 1;
        }
        $ep = Episode::where('movie_id',$movie->id)->where('episode',$tapphim)->first(); 
        $episode = Episode_Server::where('episode_id',$ep->id)->where('server_id',$server)->first(); 

        $server = LinkMovie::orderBy('id','DESC')->get();
        $episode_movie = Episode::where('movie_id',$movie->id)->orderBy('episode','ASC')->get()->unique('server');
        //$episode_link = Episode_Server::where('episode_id', $episode->id)->first();
        $episode_list = Episode::where('movie_id',$movie->id)->orderBy('episode','ASC')->get();
        $user = Auth::guard('web')->user();
        $yeuthich_list = YeuThich::where('user_id',$user->id)->with('movie')->with('movie_sum')->get();
        return view('pages.watch',compact('yeuthich_list','server_active','episode_list','episode_movie','server','movie','tapphim','episode','related')); 
    }
    public function episode(){
        return view('pages.episode');
    }

    public function timkiem(){
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $movie = Movie::where('title','LIKE','%'.$search.'%')->where('duyet',1)->where('status',1)->orderBy('updated','DESC')->paginate(10);
            return view('pages.search', compact('search','movie'));
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
            $phimhot_trailer = Movie::where('resolution',5)->where('status',1)->where('duyet',1)->orderBy('updated','DESC')->take('5')->get();
            $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->where('duyet',1)->orderBy('updated','DESC')->take('8')->get();
            $genre = Genre::orderBy('id','DESC')->where('status',1)->get();
            $category = Category::orderBy('id','DESC')->where('status',1)->get();
            $country = Country::orderBy('id','DESC')->where('status',1)->get();
            $movie_array = Movie::withCount('episode')->where('status',1)->where('duyet',1); // lay ra phim va dem so tap
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
            //echo $movie;
            return view('pages.locphim', compact('category','genre','country','movie','phimhot_sidebar','phimhot_trailer'));
            
        }
    }

    public function binhluanphim(Request $data){
        //return $data;
        if(isset($data->rep_id)){
            $bl = new Movie_Comment_Reply();
            $user = Auth::guard('web')->user();
            $bl->cmt_id = $data->rep_id;
            $bl->noidung = $data->noi_dung;
            $bl->user_reply_id = $user->id;
            $bl->user_cmt_id = $data->user_rep_id;
            $bl->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $bl->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            $bl->save();
        }else{
            $bl = new Movie_Comment();
            $user = Auth::guard('web')->user();
            $bl->movie_id = $data->movie_id;
            $bl->noidung = $data->noi_dung;
            $bl->user_id = $user->id;
            $bl->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $bl->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            $bl->save();
        }
        return redirect()->back();
    }

    public function add_rating(Request $request){
        $data = $request->all();
        $user = Auth::guard('web')->user();
        $rating_count = Rating::where('movie_id',$data['movie_id'])->where('user_id',$user->id)->count();

        if($rating_count>0){
            echo 'exist';
        }else{
            $rating = new Rating();
            $rating->movie_id = $data['movie_id'];
            $rating->rate = $data['index'];
            $rating->user_id = $user->id;
            $rating->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $rating->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            $rating->save();
            echo 'done';
        }

    }

    public function add_yeuthich(Request $request){
        $data = $request->all();
        $user = Auth::guard('web')->user();
        $yeuthich_count = YeuThich::where('movie_id',$data['movie_id'])->where('user_id',$user->id)->count();

        if($yeuthich_count>0){
            $yeuthich = YeuThich::where('movie_id',$data['movie_id'])->where('user_id',$user->id);
            $yeuthich->delete();
            echo 'exist';
        }else{
            $yeuthich = new yeuthich();
            $yeuthich->movie_id = $data['movie_id'];
            $yeuthich->user_id = $user->id;
            $yeuthich->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $yeuthich->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            $yeuthich->save();
            echo 'done';
        }

    }

    public function filter_topview(Request $request){
        $data = $request->all();
        $movie = Movie::where('topview',$data['value'])->where('status',1)->where('duyet',1)->orderBy('updated','DESC')->get();
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
                    <img src="'.asset($mov->image).'" class="lazy post-thumb" alt="'.$mov->title.'" title="'.$mov->title.'" />
                    <span class="is_trailer">'.$text.'</span>
                    </div>
                    <p class="title">'.$mov->title.'</p>
                </a>
                <div class="viewsCount" style="color: #9d9d9d;">'.$mov->count_views.' Lượt quan tâm</div>
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
        $movie = Movie::where('topview',1)->where('status',1)->where('duyet',1)->orderBy('updated','DESC')->get();
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
                    <img src="'.asset($mov->image).'" class="lazy post-thumb" alt="'.$mov->title.'" title="'.$mov->title.'" />
                    <span class="is_trailer">'.$text.'</span>
                    </div>
                    <p class="title">'.$mov->title.'</p>
                </a>
                <div class="viewsCount" style="color: #9d9d9d;">'.$mov->count_views.' Lượt quan tâm</div>
                <div style="float: left;">
                    <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                    <span style="width: 0%"></span>
                    </span>
                </div>
            </div>';
        }
        echo $output;
    }

    public function muagoi(){
        $list = GoiVip::get();
        return view('pages.muagoi', compact('list'));
    }

    public function thanh_toan(Request $request){
        $data = $request->all();
        $goi = GoiVip::where('id',$data['id_goi'])->first();
        return view('pages.thanhtoan',compact('goi'));
        
    }

    function execPostRequest($url, $data)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);
    return $result;
}

    public function thanh_toan_vnpay(Request $request){
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data = $request->all();
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('thanh-toan-vnpay-success');
        $vnp_TmnCode = "RJLXJOSR";//Mã website tại VNPAY 
        $vnp_HashSecret = "CHZQVSUZDBYJAKFNXFRUVYUWHOGICVPH"; //Chuỗi bí mật

        $last_id = HoaDon::orderBy('id','desc')->first();
        $vnp_TxnRef = $last_id->id + 1; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $data['goi_id'];
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $data['total_vnpay'] * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
            
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
            // vui lòng tham khảo thêm tại code demo
        }
    
    public function thanh_toan_vnpay_success(Request $request){
        $user = Auth::guard('web')->user();
        $data= $request->all();
        
        $order = new HoaDon();
        $order->user_id = $user->id;
        $order->goi_id = $data['vnp_OrderInfo'];
        $order->status = 1;
        $date_temp = substr($data['vnp_PayDate'], 0, 8);
        $date = date('d-m-Y', strtotime($date_temp)) ;
        $order->created_at = $date; //20240304
        $order->expired_at =date('d-m-Y', strtotime($date . ' +30 days'));
        $order->hinhthuctt = 'vnpay';
        $order->total = $data['vnp_Amount'];
        $order->bankCode = $data['vnp_BankCode'];
        $order->bankTranNo = $data['vnp_BankTranNo'];
        $order->cardType = $data['vnp_CardType'];
        $order->transactionNo = $data['vnp_TransactionNo'];
        $order->save();
        return redirect()->route('pay-success');
    }

    public function pay_success(){
        $user = Auth::guard('web')->user();
        $order = HoaDon::where('user_id',$user->id)->orderBy('id','desc')->first();
        return view('pages.thanhcong',compact('order'));
    }

    public function nangcap(){
        $user = Auth::guard('web')->user();
        $nc = new YeuCau();
        $nc->user_id = $user->id;
        $nc->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $nc->save();
        return redirect()->back();
    }

    public function related_movie(){
        $rates = Rating::all();

        $matrix = [];

        foreach ($rates as $rate) {
            $matrix[$rate->user_id][$rate->movie_id] = $rate->rate;
        }
        $e = $this->getRecommendation($matrix, 11);
        return $e;
    }

    function getSimilarity($matrix, $item, $otherProduct)
{
	$vectorUser = array();
	$vectorOtherUser = array();
	$match = 0;
	foreach ($matrix[$item] as $key => $value) {
		if (array_key_exists($key, $matrix[$otherProduct])) {
			$vectorUser[] = $value;
			$vectorOtherUser[] = $matrix[$otherProduct][$key];
			$match++;
		} else {
			$vectorUser[] = $value;
			$vectorOtherUser[] = 0;
		}
	}

	foreach ($matrix[$otherProduct] as $key => $value) {
		if (array_key_exists($key, $matrix[$item])) { } else {
			$vectorOtherUser[] = $value;
			$vectorUser[] = 0;
		}
	}
	$data =  Cosine::similarity($vectorUser, $vectorOtherUser);
	if ($match == 0 || $temp < 0.5) {
		return -1;
	}

	return $data;
}

function getRecommendation($matrix, $user)
{
	$total = array();
	$simsums = array();
	$ranks = array();
	foreach ($matrix as $otherUser => $value) {
		if ($otherUser != $user) {
			$sim = $this->getSimilarity($matrix, $user, $otherUser);
			// "Độ gần giống : " . $otherUser . " với " . $user . " là : " . $sim . "<br/>";
			if ($sim == -1) continue;
			foreach ($matrix[$otherUser] as $key => $value) {
				if (!array_key_exists($key, $matrix[$user])) {
                    if (!array_key_exists($key, $total)) {
                        $total[$key] = 0;
                    }
                    $total[$key] += $matrix[$otherUser][$key] * $sim;

                    if (!array_key_exists($key, $simsums)) {
                        $simsums[$key] = 0;
                    }
                    $simsums[$key] += $sim;
				}
			}
		}
	}

	foreach ($total as $key => $value) {
		$ranks[$key] = $value / $simsums[$key];
	}
	array_multisort($ranks, SORT_DESC);
	return $ranks;
}



}
