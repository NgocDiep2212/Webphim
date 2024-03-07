@extends('layouts.ad_duyet')
@section('content')

   <div class="container row" >
      <div class="col-sm-6">
         <div class="form-group">Tên phim:
            {!! Form::text('title', isset($movie) ? $movie->title : '', ['class'=>'form-control','readonly']) !!}
         </div>
         <div class="form-group">Thời lượng phim:  
            {!! Form::text('duration', isset($movie) ? $movie->duration : '', ['class'=>'form-control','readonly']) !!}
         </div>
         <div class="form-group">Hình ảnh: <br/> 
            <img style="max-width: 200px" src="{{$movie->image}}" alt=""> 
         </div>
         <div class="form-group">Danh mục phim:  
         
               @foreach($movie->activeMovieCategory as $gen)
               <span class="badge badge-dark">{{$gen->title}}</span>
               @endforeach 

         </div>
         <div class="form-group">Thể loại phim:  
         
               @foreach($movie->activeMovieGenre as $gen)
               <span class="badge badge-dark">{{$gen->title}}</span>
               @endforeach 
            
         </div>
         <div class="form-group">Quốc gia phim:  
            {!! Form::text('country', isset($movie) ? $movie->activeCountry->title : '', ['class'=>'form-control','readonly']) !!}
         </div>
      </div>
      <div class="col-sm-6">
         <div class="form-group">Chất lượng phim:  
            @if($movie->resolution == 0) HD
            @elseif($movie->resolution == 1) SD
            @elseif($movie->resolution == 2) HDCam
            @elseif($movie->resolution == 3) Cam
            @elseif($movie->resolution == 4) FullHD
            @else Trailer
            @endif       
         </div>
         <div class="form-group">Vietsub/thuyết minh:  
            @if($movie->vietsub == 0) Vietsub
            @elseif($movie->vietsub == 1) Thuyết minh
            @endif
         </div>
         <div class="form-group">Năm phim:  {{$movie->year}} </div>
         <div class="form-group">Thuộc phim:  
            @if($movie->thuocphim == 'phimle') Phim lẻ
            @elseif($movie->thuocphim == 'phimbo') Phim bộ
            @endif  
         </div>
         <div class="form-group">Nội dung phim:  
            {!! $movie->description !!}
         </div>

      </div>
      <div class="iframe_phim">
         {!! $episode->episode_server->linkphim !!}
      </div>
      <div class="tab-content">
         <div role="tabpanel" class="tab-pane active server-1" id="server-0">
            <div class="halim-server">
               <ul class="halim-list-eps">
                 {{-- moi server --}}
               @foreach($server as $key => $ser)
                 {{-- Lặp qua từng server --}}
                  @if(count($ser->sodes) != 0)
                     <li class="halim-episode">
                        <span class="halim-btn halim-btn-2 halim-info-1-1 box-shadow">{{$ser->title}}</span>
                     </li>

                     <ul style="list-style: none" class="row">
                     @foreach($ser->sodes as $key => $ser_mov)
                        @if($ser_mov->movie_id == $movie->id)
                        <li>
                           {{-- Kiểm tra xem tập hiện tại có trùng với tập đang xem không --}}
                           @if($episode_link->episode_id == $ser_mov->id)
                              {{-- Hiển thị trạng thái active --}}
                              <span class="active col-sm-2" style="background-color: rgb(227, 227, 242);padding: 2px; border-radius: 5px;" >
                           @else
                              <span class="col-sm-2">
                           @endif
                           {{-- Hiển thị liên kết của tập --}}
                           <a href="{{url('admin/duyet-ct/'.$ser_mov->movie->slug.'/tap-'.$ser_mov->episode.'/server-'.$ser_mov->pivot->server_id)}}"> 
                              Tập {{$ser_mov->episode}}
                           </a>
                           </span>
                     </li>
                        @endif
                     @endforeach 
                  </ul>
                  @endif
                @endforeach
             
               </ul>
               <div class="clearfix"></div>
            </div>
         </div>
      </div>
      <a class="btn btn-success" href="{{route('duyet-accept', $movie->slug)}}">Duyệt phim</a>
      <a class="btn btn-danger" href="{{route('duyet-cancel', $movie->slug)}}">Loại phim</a>
   </div>
@endsection