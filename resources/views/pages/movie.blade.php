@extends('layout')
@section('content')
<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
       <div class="panel-heading">
          <div class="row">
             <div class="col-xs-6">
                <div class="yoast_breadcrumb hidden-xs"><span><span><a href="{{route('category',[$movie->category->slug])}}">{{$movie->category->title}}</a> » <span><a href="{{route('country',[$movie->country->slug])}}">{{$movie->country->title}}</a> 
                  »
                  @foreach($movie->movie_genre as $gen )
                     <a href="{{route('genre',[$gen->slug])}}">{{$gen->title}}</a> »
                  @endforeach
                  <span class="breadcrumb_last" aria-current="page">{{$movie->title}}</span></span></span></span></div>
             </div>
          </div>
       </div>
       <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
          <div class="ajax"></div>
       </div>
    </div>
    <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
       <section id="content" class="test">
          <div class="clearfix wrap-content">
            
             <div class="halim-movie-wrapper">
                <div class="title-block">
                   <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="38424">
                      <div class="halim-pulse-ring"></div>
                   </div>
                   <div class="title-wrapper" style="font-weight: bold;">
                      Bookmark
                   </div>
                </div>
                <div class="movie_info col-xs-12">
                   <div class="movie-poster col-md-3">
                     @php
                        $image_check = substr($movie->image,0,5);
                     @endphp
                     @if($image_check =='https')
                     <img class="movie-thumb" src="{{$movie->image}}" alt="GÓA PHỤ ĐEN">

                     @else
                     <img class="movie-thumb" src="{{asset('uploads/movie/'.$movie->image)}}" alt="GÓA PHỤ ĐEN">

                     @endif
                      @if($movie->resolution != 5)
                        @if(isset($movie->episode))
                        <div class="bwa-content">
                           <div class="loader"></div>
                           <a href="{{url('xem-phim/'.$movie->slug.'/tap-'.$episode_first->episode.'/server-'.$episode_first->server)}}" class="bwac-btn">
                           <i class="fa fa-play"></i>
                           </a>
                        </div>
                        @endif
                     @else
                        <a href="#watch_trailer" style="display: block" class="btn btn-primary watch_trailer">Xem Trailer</a>
                     @endif
                  </div>
                   <div class="film-poster col-md-9">
                      <h1 class="movie-title title-1" style="display:block;line-height:35px;margin-bottom: -14px;color: #ffed4d;text-transform: uppercase;font-size: 18px;">{{$movie->title}}</h1>
                      <h2 class="movie-title title-2" style="font-size: 12px;">{{$movie->name_eng}}</h2>
                      <ul class="list-info-group">
                         <li class="list-info-group-item"><span>Trạng Thái</span> : <span class="quality">
                           @if($movie->resolution == 0) HD
                           @elseif($movie->resolution == 1) SD
                           @elseif($movie->resolution == 2) HDCam
                           @elseif($movie->resolution == 3) Cam
                           @elseif($movie->resolution == 4) FullHD
                           @else Trailer
                           @endif 
                        </span>
                        @if($movie->resolution != 5)
                           <span class="episode">
                              @if($movie->vietsub == 0) 
                                 Phụ đề
                              @else Thuyết minh 
                              @endif 
                           </span> 
                        @endif
                        </li>
                         {{-- <li class="list-info-group-item"><span>Điểm IMDb</span> : <span class="imdb">7.2</span></li> --}}
                         @if ($movie->season != 0) 
                         <li class="list-info-group-item"><span>Season</span> : {{$movie->season}}</li>
                         @endif
                         <li class="list-info-group-item"><span>Thời lượng</span> : {{$movie->duration}}</li>
                         {{-- sotap trong episode/ sotap trong movie --}}
                         <li class="list-info-group-item"><span>Tập phim</span> : 
                           @if($movie->thuocphim=='phimbo')
                              {{$episode_current_list_count}}/{{$movie->sotap}} - 
                              @if($episode_current_list_count == $movie->sotap)
                                 Hoàn thành
                              @else
                                 Đang cập nhật
                              @endif
                           @else
                              Phim lẻ
                           @endif
                        </li>
                         <li class="list-info-group-item"><span>Thể loại</span> : 
                         @foreach($movie->movie_genre as $gen)
                         <a href="{{route('genre',[$gen->slug])}}" rel="genre tag">{{$gen->title}}</a>, 

                         @endforeach
                        </li>
                         <li class="list-info-group-item"><span>Danh mục phim</span> : 
                           <a href="{{route('category',[$movie->category->slug])}}" rel="category tag">{{$movie->category->title}}</a>, 
                        </li>
                         <li class="list-info-group-item"><span>Quốc gia</span> : <a href="{{route('country',[$movie->country->slug])}}" rel="tag">{{$movie->country->title}}</a></li>
                         <li class="list-info-group-item"><span>Tập phim mới nhất</span> : 
                        
                           
                        @if($episode_current_list_count>0)
                        @foreach($episode as $key => $ep)
                           @if($movie->thuocphim=='phimbo')
                              <a href="{{url('xem-phim/'.$ep->movie->slug.'/tap-'.$ep->episode)}}" rel="tag">Tập {{$ep->episode}}
                              </a>
                              
                           
                           @elseif($movie->thuocphim=='phimle') 
                              <a href="{{url('xem-phim/'.$ep->movie->slug.'/tap-'.$ep->episode)}}" rel="tag">HD</a>
                              <a href="{{url('xem-phim/'.$ep->movie->slug.'/tap-'.$ep->episode)}}" rel="tag">FullHD</a>
                           @endif
                           @endforeach
                        @else
                           Đang cập nhật
                        @endif 
                        </li>
                        {{-- nut like fb --}}
                        @php
                        $current_url = Request::url();
                        @endphp
                        <div class="fb-like" data-href="{{$current_url}}" data-width="" data-layout="" data-action="" data-size="" data-share="true"></div>
                        </ul>
                      <div class="movie-trailer hidden"></div>
                   </div>
                </div>
             </div>
             <div class="clearfix"></div>
             <div id="halim_trailer"></div>
             <div class="clearfix"></div>

             <div class="section-bar clearfix">
               <h2 class="section-title"><span style="color:#ffed4d">NỘI DUNG PHIM</span></h2>
            </div>
            <div class="entry-content htmlwrap clearfix">
               <div class="video-item halim-entry-box">
                  <article id="post-38424" class="item-content">
                     @php echo $movie->description @endphp
                  </article>
               </div>
            </div>

            {{-- Tags phim --}}
             <div class="section-bar clearfix">
                <h2 class="section-title"><span style="color:#ffed4d">TAGS PHIM</span></h2>
             </div>
             <div class="entry-content htmlwrap clearfix">
                <div class="video-item halim-entry-box">
                   <article id="post-38424" class="item-content">
                     @if($movie->tags != NULL)
                        @php 
                           $tags = array();
                           $tags = explode(',',$movie->tags);
                        @endphp
                        @foreach($tags as $key => $tag)
                           <a href="{{url('tag/'.$tag)}}">{{$tag}}</a>   
                        @endforeach
                     @else
                     {{$movie->tags}}
                     @endif
                   </article>
                </div>
             </div>

             {{-- Trailer phim --}}
             @if($movie->trailer!=NULL)
             <div class="section-bar clearfix">
                <h2 class="section-title"><span style="color:#ffed4d">trailer phim</span></h2>
             </div>
             <div class="entry-content htmlwrap clearfix">
                <div class="video-item halim-entry-box">
                   <article id="watch_trailer" class="item-content">
@php
// // Tách URL thành một mảng dựa trên ký tự '?'
// $parts = explode('=', $movie->trailer);

// // Lấy phần thứ hai của mảng
// $movie_trailer_url= $parts[1];
echo '<iframe width="100%" height="315" src="'.$movie->trailer.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
@endphp

                   </article>
                </div>
             </div>
             @endif
             {{-- Comment fb --}}
             <div class="section-bar clearfix">
               <h2 class="section-title"><span style="color:#ffed4d">Bình luận</span></h2>
            </div>
            <div class="entry-content htmlwrap clearfix">
               <div class="video-item halim-entry-box">
                  @php
                     $current_url = Request::url();
                  @endphp
                  <article class="item-content" style="background-color: white">
                     <div class="fb-comments" data-href="{{$current_url}}" data-width="100%" data-numposts="5"></div>
                    
                  </article>
               </div>
            </div>
          </div>
       </section>
       <section class="related-movies">
          <div id="halim_related_movies-2xx" class="wrap-slider">
             <div class="section-bar clearfix">
                <h3 class="section-title"><span>CÓ THỂ BẠN MUỐN XEM</span></h3>
             </div>
             <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
               @foreach($related as $key => $hot)
               <article class="thumb grid-item post-38498">
                  <div class="halim-item">
                     <a class="halim-thumb" href="{{route('movie',$hot->slug)}}" title="{{$hot->title}}">
                        <figure>
                           @php
                              $image_check = substr($hot->image,0,5);
                           @endphp
                           @if($image_check =='https')
                           <img class="lazy img-responsive" src="{{$hot->image}}" alt="{{$hot->title}}" title="{{$hot->title}}">

                           @else
                           <img class="lazy img-responsive" src="{{asset('uploads/movie/'.$hot->image)}}" alt="{{$hot->title}}" title="{{$hot->title}}">


                           @endif
                        </figure>
                        <span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                           @if($hot->vietsub == 0) 
                              Phụ đề
                              @if ($hot->season != 0) 
                                - Season: {{$hot->season}}
                              @endif
                           @else Thuyết minh 
                              @if ($hot->season != 0) 
                              - Season: {{$hot->season}}
                              @endif
                           @endif 
                        </span> 
                        <div class="icon_overlay"></div>
                        <div class="halim-post-title-box">
                           <div class="halim-post-title ">
                              <p class="entry-title">{{$hot->title}}</p>
                              <p class="original_title">{{$hot->name_eng}}</p>
                           </div>
                        </div>
                     </a>
                  </div>
               </article>
               @endforeach
            </div>
            <script>
               $(document).ready(function($) {				
               var owl = $('#halim_related_movies-2');
               owl.owlCarousel({loop: true,margin: 5,autoplay: true,autoplayTimeout: 4000,autoplayHoverPause: true,nav: true,navText: ['<i class="hl-down-open rotate-left"></i>', '<i class="hl-down-open rotate-right"></i>'],responsiveClass: true,responsive: {0: {items:2},480: {items:3}, 600: {items:4},1000: {items: 4}}})});
            </script>
         </div>
       </section>
    </main>
    @include('pages.include.sidebar')
 </div>
@endsection