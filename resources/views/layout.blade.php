<!DOCTYPE html>
<html lang="vi">
   <head>
      <meta charset="utf-8" />
      <meta content="width=device-width,initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
      <meta name="theme-color" content="#234556">
      <meta http-equiv="Content-Language" content="vi" />
      <meta content="VN" name="geo.region" />
      <meta name="DC.language" scheme="utf-8" content="vi" />
      <meta name="language" content="Việt Nam">
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      

      <link rel="shortcut icon" href="https://www.pngkey.com/png/detail/360-3601772_your-logo-here-your-company-logo-here-png.png" type="image/x-icon" />
      <meta name="revisit-after" content="1 days" />
      <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
      <title>Phim hay 2023 - Xem phim hay nhất</title>
      <meta name="description" content="Phim hay 2021 - Xem phim hay nhất, xem phim online miễn phí, phim hot , phim nhanh" />
      <link rel="canonical" href="">
      <link rel="next" href="" />
      <meta property="og:locale" content="vi_VN" />
      <meta property="og:title" content="Phim hay 2020 - Xem phim hay nhất" />
      <meta property="og:description" content="Phim hay 2020 - Xem phim hay nhất, phim hay trung quốc, hàn quốc, việt nam, mỹ, hong kong , chiếu rạp" />
      <meta property="og:url" content="" />
      <meta property="og:site_name" content="Phim hay 2021- Xem phim hay nhất" />
      <meta property="og:image" content="" />
      <meta property="og:image:width" content="300" />
      <meta property="og:image:height" content="55" />
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
     
      <link rel='dns-prefetch' href='//s.w.org' />
      
      <link rel='stylesheet' id='bootstrap-css' href='{{asset('css/bootstrap.min.css?ver=5.7.2')}}' media='all' />
      
      <link rel='stylesheet' id='style-css' href='{{asset('css/style.css?ver=5.7.2')}}' media='all' />
      <link rel='stylesheet' id='wp-block-library-css' href='{{asset('css/style.min.css?ver=5.7.2')}}' media='all' />
      <script src="{{asset('js/movie.js')}}" type='text/javascript'></script>
      <script type='text/javascript' src='{{asset('js/jquery.min.js?ver=5.7.2')}}' id='halim-jquery-js'></script>
      <style type="text/css" id="wp-custom-css">
         .textwidget p a img {
         width: 100%;
         }
         
      </style>
      <style> 
         /* Ẩn modal theo mặc định */
         #my-modal {
         display: none;
         position: absolute;
         top: 145px;
         left: 18%;
         width: 380px;
         transform: translate(-50%, -50%);
         background-color: #12171b;
         padding: 16px;
         border-radius: 10px;
         z-index: 10;
         text-align: left;
         color: #ffffffe0;
         border: 1px solid white;
         }

         /* Hiển thị modal khi hover vào button */
         #my-button:hover + #my-modal {
         display: block;
         }

         /* Nút đóng modal */
         #close-modal {
         background-color: #ccc;
         padding: 5px 10px;
         border-radius: 5px;
         cursor: pointer;
         }
      </style>
      <style>#header .site-title {background: url(https://phimmoiiii.net/wp-content/uploads/2023/03/phimmoi.png) no-repeat top left;background-size: contain;text-indent: -9999px;}</style>
   </head>
   <body class="home blog halimthemes halimmovies" data-masonry="">
      <header id="header">
         <div class="container">
            <div class="row" id="headwrap">
               <div class="col-md-3 col-sm-6 slogan">
                  <p class="site-title" style="margin-top: 14px"><a class="logo" href="" title="phim hay ">Phim Hay</p>
                  </a>
               </div>
               <div class="col-md-5 col-sm-6 halim-search-form hidden-xs">
                  <div class="header-nav">
                     <div class="col-xs-12">
                       
                           <div class="form-group form-timkiem">
                              <div class="input-group col-xs-12 ">
                                 <form action="{{route('tim-kiem')}}" method="get" style="display: flex" >
                                    <input id="timkiem" type="text" name="search" class="form-control" placeholder="Tìm kiếm..." autocomplete="off">
                                    <button class="btn btn-primary" >Tìm kiếm</button>
                                 </form>
                                 <i class="animate-spin hl-spin4 hidden"></i>
                              </div>
                           </div>
                       
                        <ul class="list-group" id="result" style="display: none">
                          
                        </ul>
                     </div>
                  </div>
               </div>

                  <div class="col-md-4 hidden-xs" style="display: flex;">
                     <div style="relative">
                      <?php 
                           use Illuminate\Support\Facades\Auth;
                           use App\Models\HoaDon;
                           use Carbon\Carbon;
                           $date_now = Carbon::now()->format('Y-m-d');
                           $user_id = Auth::guard('web')->user()->id;
                           $hoadon = HoaDon::where('user_id',$user_id)->orderBy('created_at','desc')->first();
                           if(isset($hoadon)){
                              if($hoadon->expired_at >= $date_now){
                                 $expired = Carbon::parse($hoadon->expired_at);
                                 $vip = true;
                                 $time_expired = $expired->diffInDays($date_now);
                              } 

                           }
                      ?>
                      @if(!isset($vip))
                        <a href="{{route('muagoi')}}" id="my-button" class="btn btn-warning" style="margin-right: 10px;">
                           Đăng ký gói
                        </a>
                        
                        <div id="my-modal">
                           <h5 style="font-weight: 600;color: #f7d800;">Đăng ký gói để hưởng những quyền lợi của VIP</h5>
                           <p>Xem phim không giới hạn</p>
                           <p>Xem nội dung sớm nhất và độc quyền</p>
                           <p>Không quảng cáo</p>
                           <p>Tùy chọn Phụ Đề/Lồng Tiếng/Thuyết Minh</p>

                         </div>
                     </div>
                     @else 
                     <div class="btn btn-warning" style="margin-right: 10px;">
                       {{-- {{$hoadon->goivip->name}} <br/> --}}
                       {{$time_expired}} Ngày
                     </div>
                     @endif

                     @if(isset($yeuthich_list) && $yeuthich_list != null)
                     <div id="get-bookmark" class="box-shadow" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-bookmark"></i><span> Bookmarks</span><span style="
                        margin-left: 5px;
                        background-color: red;
                        padding: 2px 5px;
                        border-radius: 50%;
                    "><?php $n = 0; foreach($yeuthich_list as $key => $yeu){
                       if($yeu->movie != null) 
                           $n= $n +1;
                        }
                        echo $n;
                     ?>
                     </span></div>
      
                     <!-- Modal -->
                     <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                           <div class="modal-header" >
                              <h4 class="modal-title" id="exampleModalLongTitle" style="text-align: center; font-weight: 600; color: red">Danh sách phim yêu thích</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 30px;position: absolute;top: 15px;right: 20px;">
                              <span aria-hidden="true">&times;</span>
                              </button>
                           </div>
                           <div class="modal-body">
                              <ul>
                                 
                                    @foreach($yeuthich_list as $key => $yeu)
                                       @if($yeu->movie != null)
                                       <li style="cursor:pointer; list-style: none;" class="list-group-item link-class">
                                          <a href="{{route('movie',$yeu->movie->slug)}}" style="display: flex; ">
                                             <img src="{{$yeu->movie->image}}" style="margin-right: 20px; max-height: 180px;" />
                                             <div style="text-align: justify; color: #0d0a76;">
                                                <h4 style="font-weight: 600;">{{$yeu->movie->title}} | </h4>
                                                {!! $yeu->movie->description !!}
                                             </div>
                                          </a>
                                       </li>
                                       @endif
                                    @endforeach
                          
                              </ul>
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary">Save changes</button>
                           </div>
                        </div>
                        </div>
                  </div>
                  @endif
                  <div class="dropdown">
                     <i class="fa fa-user"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="
                     font-size: 24px;border: 3px solid white;padding: 3px 5px;color: white;border-radius: 50%;cursor: pointer;"></i>
                     {{-- <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       Dropdown button
                     </button> --}}
                     <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="
                     width: 200px; margin-left: auto;padding: 12px 30px;">
                       <a class="dropdown-item"  href="#" >Tài khoản của tôi</a> <br/>
                       <a class="dropdown-item" href="#">Action</a> <br/>
                       <form action="{{route('logout')}}" method="post">
                        @csrf
                        <i class="fa fa-sign-out"></i><input type="submit" value="Đăng xuất"style="
                        border: none;
                        background: none;
                    "/>
                      </form>
                     </div>
                   </div>
               
                  
            </div>
            {{-- <div id="get-bookmark" class="box-shadow"><i class="hl-bookmark"></i><span> Bookmarks</span><span class="count">0</span></div> --}}
            <div id="bookmark-list" class="hidden bookmark-list-on-pc">
               <ul style="margin: 0;"></ul>
            </div>
         </div>
         </div>
      </header>
      <div class="navbar-container">
         <div class="container">
            <nav class="navbar halim-navbar main-navigation" role="navigation" data-dropdown-hover="1">
               <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed pull-left" data-toggle="collapse" data-target="#halim" aria-expanded="false">
                  <span class="sr-only">Menu</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  </button>
                  <button type="button" class="navbar-toggle collapsed pull-right expand-search-form" data-toggle="collapse" data-target="#search-form" aria-expanded="false">
                  <span class="hl-search" aria-hidden="true"></span>
                  </button>
                  <button type="button" class="navbar-toggle collapsed pull-right get-bookmark-on-mobile">
                  Bookmarks<i class="hl-bookmark" aria-hidden="true"></i>
                  <span class="count">0</span>
                  </button>
                  <button type="button" class="navbar-toggle collapsed pull-right get-locphim-on-mobile">
                  <a href="javascript:;" id="expand-ajax-filter" style="color: #ffed4d;">Lọc <i class="fas fa-filter"></i></a>
                  </button>
               </div>
               <div class="collapse navbar-collapse" id="halim">
                  <div class="menu-menu_1-container">
                     <ul id="menu-menu_1" class="nav navbar-nav navbar-left">
                        <li class="current-menu-item active"><a title="Trang Chủ" href="{{route('homepage')}}">Trang Chủ</a></li>
                        <li class="mega dropdown">
                           <a title="Thể Loại" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Thể Loại <span class="caret"></span></a>
                           <ul role="menu" class=" dropdown-menu">
                              @foreach($genre as $key => $gen)
                                 <li><a title="{{$gen->title}}" href="{{route('genre',$gen->slug)}}">{{$gen->title}}</a></li>
                              @endforeach
                           </ul>
                        </li>
                        <li class="mega dropdown">
                           <a title="Quốc Gia" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Quốc Gia <span class="caret"></span></a>
                           <ul role="menu" class=" dropdown-menu">
                              @foreach($country as $key => $count)
                                 <li><a title="{{$count->title}}" href="{{route('country',$count->slug)}}">{{$count->title}}</a></li>
                              @endforeach
                           </ul>
                        @foreach($category as $key => $cate)
                           <li class="mega"><a title="{{$cate->title}}" href="{{route('category',$cate->slug)}}">{{$cate->title}}</a></li>
                        @endforeach
                       
                        </li>
                        <li class="mega dropdown">
                           <a title="Năm Phim" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Năm phim<span class="caret"></span></a>
                           <ul role="menu" class=" dropdown-menu">
                             @for($year=2024;$year>=2000;$year--)
                                 <li><a title="{{$year}}" href="{{url('nam/'.$year)}}">{{$year}}</a></li>
                              @endfor
                           </ul>
                       
                        </li>
                        
                     </ul>
                  </div>
                  {{-- <ul class="nav navbar-nav navbar-left" style="background:#000;">
                     <li><a href="#" onclick="locphim()" style="color: #ffed4d;">Lọc Phim</a></li>
                  </ul> --}}
               </div>
            </nav>
            <div class="collapse navbar-collapse" id="search-form">
               <div id="mobile-search-form" class="halim-search-form"></div>
            </div>
            <div class="collapse navbar-collapse" id="user-info">
               <div id="mobile-user-login"></div>
            </div>
         </div>
      </div>
      </div>
      
      <div class="container">
         <div class="row fullwith-slider"></div>
      </div>
      <div class="container">
         @yield('content')
      </div>
      <div class="clearfix"></div>
      <footer id="footer" class="clearfix">
         <div class="container footer-columns">
            <div class="row container">
               <div class="widget about col-xs-12 col-sm-4 col-md-3">
                  <div class="footer-logo" style="margin-top: -5px;">
                     <img class="img-responsive" src="https://phimmoiiii.net/wp-content/uploads/2023/03/phimmoi.png" alt="Phim hay 2021- Xem phim hay nhất" />
                  </div>
                  
                  <div>
                     <a href="#" style="font-weight: 600;">Phimmoi</a> 
                     <span> - Trang xem phim Online với giao diện mới được bố trí và thiết kế thân thiện với người dùng. Nguồn phim được tổng hợp từ các website lớn với đa dạng các đầu phim và thể loại vô cùng phong phú.</span>
                  </div>
               </div>
               <div class="widget about col-xs-12 col-sm-4 col-md-3">
                  <h4>Phim mới</h4>
                  <a href="#">Phim Chiếu Rạp</a> <br>
                  <a href="#">Phim Thuyết Minh</a> <br>
                  <a href="#">Phim Hoạt Hình</a> <br>
                  <a href="#">Phim Bộ</a> <br>
                  <a href="#">Phim Lẻ</a> <br>
               </div>
               <div class="widget about col-xs-12 col-sm-4 col-md-3">
                  <h4>Phim hay nhất</h4>
                  <a href="#">Việt Nam</a> <br>
                  <a href="#">Âu Mỹ</a> <br>
                  <a href="#">Tây Ban Nha</a> <br>
                  <a href="#">Trung Quốc</a> <br>
                  <a href="#">Nhật Bản</a> <br>
               </div>
               <div class="widget about col-xs-12 col-sm-4 col-md-3">
                  <h4>Thông tin</h4>
                  <a href="#">Giới thiệu</a> <br>
                  <a href="#">Liên hệ chúng tôi</a> <br>
                  <a href="#">Điều khoản dịch vụ</a> <br>
                  <a href="#">Chính sách riêng tư</a> <br>
                  <a href="#">Khiếu nại bản quyền</a> <br>
                  <a href="#" data-toggle="modal" data-target="#exampleModalCenter">Nâng cấp tài khoản</a>
                   
                   <!-- Modal -->
                   <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered" role="document">
                       <div class="modal-content">
                         <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                           </button>
                         </div>
                         <div class="modal-body" style="color: #000">
                           Bạn muốn gửi yêu cầu nâng cấp thành tài khoản Admin?
                         </div>
                         <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                           <form action="{{route('nangcap')}}" method="post">
                              @csrf
                              <button type="submit" class="btn btn-primary">Gửi</button>
                           </form>
                         </div>
                       </div>
                     </div>
                   </div>
               </div>
            </div>
         </div>
      </footer>
      <div id='easy-top'></div>
     
      <script type='text/javascript' src='{{asset('js/bootstrap.min.js?ver=5.7.2')}}' id='bootstrap-js'></script>
      <script type='text/javascript' src='{{asset('js/owl.carousel.min.js?ver=5.7.2')}}' id='carousel-js'></script>
     
      <script type='text/javascript' src='{{asset('js/halimtheme-core.min.js?ver=1626273138')}}' id='halim-init-js'></script>
      <div id="fb-root"></div>
      <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v18.0" nonce="mrsqI3km"></script>
     
      <script type="text/javascript">
      $(document).ready(function(){
         $('#timkiem').keyup(function() {
         $('#result').html('');
         var search = $('#timkiem').val();
         if (search != '') {
            var expression = new RegExp(search, "i");
            var existingMovies = []; // Khởi tạo mảng trống để lưu trữ tiêu đề phim hiện có

            $.getJSON('/json_file/movies.json', function(data) {
               $.each(data, function(key, value) {
               if (value.title.search(expression) != -1) {
                  if (existingMovies.indexOf(value.title) === -1) { // Kiểm tra xem tiêu đề phim đã có trong mảng chưa
                     $('#result').css('display', 'inherit');
                     existingMovies.push(value.title); // Thêm tiêu đề phim vào mảng để tránh trùng lặp
                     $('#result').append('<li style="cursor:pointer; display:flex;" class="list-group-item link-class"><img src="' + value.image + '" style="margin-right: 20px; max-width=60px; max-height: 60px;" /><div><div>'+ value.title + ' | </div><span class="text-muted">' + value.description + '</span></div></li>');
                  }
                  }
                  });
               });
               } else {
                  $('#result').css('display', 'none');
               }
            }
         );



         $('#result').on('click','li', function(){
            var click_text = $(this).text().split('|');
            $('#timkiem').val($.trim(click_text[0]));
            $('#result').html('');
            $('#result').css('display','none');
         });
      });
      </script>
      <script type='text/javascript'>
      $(".watch_trailer").click(function(e){
         e.preventDefault();
         var aid = $(this).attr("href");
         $('html,body').animate({scrollTop: $(aid).offset().top}, 'slow');
      })
      </script>
     
      <script type='text/javascript'>
      $(document).ready(function(){
         
         $.ajax({
            url:"{{route('filter-topview-default')}}",
            method:"GET",
            success:function(data)
            {
               $('#show_data_default').html(data);
            }
         });
   
      
         $('.filter-sidebar').click(function(){
            var href = $(this).attr('href');
            if(href =='#ngay'){
               var value = 1;
            }else if(href =='#tuan'){
               var value = 2;
            }else if(href =='#thang'){
               var value = 3;
            }
            $.ajax({
               url:"{{route('filter-topview-phim')}}",
               method:"POST",
               data:{value:value},
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               // success:function(data)
               // {
               //    $('#halim-ajax-popular-post-default').css('display','none');
               //    $('#show_data').html(data);
               // }
               success:function(data)
            {
               $('#show_data_default').html(data);
            }
            });
         })
      })
      </script>
   
      <style>#overlay_mb{position:fixed;display:none;width:100%;height:100%;top:0;left:0;right:0;bottom:0;background-color:rgba(0, 0, 0, 0.7);z-index:99999;cursor:pointer}#overlay_mb .overlay_mb_content{position:relative;height:100%}.overlay_mb_block{display:inline-block;position:relative}#overlay_mb .overlay_mb_content .overlay_mb_wrapper{width:600px;height:auto;position:relative;left:50%;top:50%;transform:translate(-50%, -50%);text-align:center}#overlay_mb .overlay_mb_content .cls_ov{color:#fff;text-align:center;cursor:pointer;position:absolute;top:5px;right:5px;z-index:999999;font-size:14px;padding:4px 10px;border:1px solid #aeaeae;background-color:rgba(0, 0, 0, 0.7)}#overlay_mb img{position:relative;z-index:999}@media only screen and (max-width: 768px){#overlay_mb .overlay_mb_content .overlay_mb_wrapper{width:400px;top:3%;transform:translate(-50%, 3%)}}@media only screen and (max-width: 400px){#overlay_mb .overlay_mb_content .overlay_mb_wrapper{width:310px;top:3%;transform:translate(-50%, 3%)}}</style>
    
      <style>
         #overlay_pc {
         position: fixed;
         display: none;
         width: 100%;
         height: 100%;
         top: 0;
         left: 0;
         right: 0;
         bottom: 0;
         background-color: rgba(0, 0, 0, 0.7);
         z-index: 99999;
         cursor: pointer;
         }
         #overlay_pc .overlay_pc_content {
         position: relative;
         height: 100%;
         }
         .overlay_pc_block {
         display: inline-block;
         position: relative;
         }
         #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
         width: 600px;
         height: auto;
         position: relative;
         left: 50%;
         top: 50%;
         transform: translate(-50%, -50%);
         text-align: center;
         }
         #overlay_pc .overlay_pc_content .cls_ov {
         color: #fff;
         text-align: center;
         cursor: pointer;
         position: absolute;
         top: 5px;
         right: 5px;
         z-index: 999999;
         font-size: 14px;
         padding: 4px 10px;
         border: 1px solid #aeaeae;
         background-color: rgba(0, 0, 0, 0.7);
         }
         #overlay_pc img {
         position: relative;
         z-index: 999;
         }
         @media only screen and (max-width: 768px) {
         #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
         width: 400px;
         top: 3%;
         transform: translate(-50%, 3%);
         }
         }
         @media only screen and (max-width: 400px) {
         #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
         width: 310px;
         top: 3%;
         transform: translate(-50%, 3%);
         }
         }
      </style>
     
      <style>
         .float-ck { position: fixed; bottom: 0px; z-index: 9}
         * html .float-ck /* IE6 position fixed Bottom */{position:absolute;bottom:auto;top:expression(eval (document.documentElement.scrollTop+document.docum entElement.clientHeight-this.offsetHeight-(parseInt(this.currentStyle.marginTop,10)||0)-(parseInt(this.currentStyle.marginBottom,10)||0))) ;}
         #hide_float_left a {background: #0098D2;padding: 5px 15px 5px 15px;color: #FFF;font-weight: 700;float: left;}
         #hide_float_left_m a {background: #0098D2;padding: 5px 15px 5px 15px;color: #FFF;font-weight: 700;}
         span.bannermobi2 img {height: 70px;width: 300px;}
         #hide_float_right a { background: #01AEF0; padding: 5px 5px 1px 5px; color: #FFF;float: left;}
      </style>

      
   </body>
</html>