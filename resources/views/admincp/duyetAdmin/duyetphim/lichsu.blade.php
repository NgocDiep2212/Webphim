@extends('layouts.ad_duyet')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table table-responsive" id="tablephim">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên phim</th>
                    <th scope="col">Số tập phim</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Nội dung</th>
                    <th scope="col">Danh mục</th>
                    <th scope="col">Thể loại</th>
                    <th scope="col">Quốc gia</th>
                    <th scope="col">Phim lẻ/bộ</th>
                    <th scope="col" >Ngày tạo</th>
                    <th scope="col" >Trạng thái phim</th>
                    <th scope="col" >Trạng thái duyệt phim</th>
                    {{-- <th scope="col">Season</th> --}}
                    <th scope="col">Quản lý</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($list as $key => $cate)
                  <tr>
                    <th scope="row">{{$key}}</th>
                    <td>{{$cate->movie->title}}</td>
                    <td>{{count($cate->movie->activeMovieEpisodeServer)}}/{{$cate->movie->sotap}} tập</td>
                   
                    <td> 
                      @php
                        $image_check = substr($cate->movie->image,0,5);
                      @endphp
                      @if($image_check =='https')
                      <img width="60%" src="{{$cate->movie->image}}" alt="">
                      @else
                      <img width="60%" src="{{asset('uploads/movie/'.$cate->movie->image)}}" alt="">

                      @endif
                    </td>
                    <td>{!! $cate->movie->description !!}</td>
                    <td>
                      @foreach($cate->movie->activeMovieCategory as $gen)
                      <span class="badge badge-dark">{{$gen->title}}</span>
                      @endforeach
                    </td>
                    <td>
                      @foreach($cate->movie->movie_genre as $gen)
                      <span class="badge badge-dark">{{$gen->title}}</span>
                      @endforeach
                    </td>

                    <td >@if (isset($cate->movie->country)){{$cate->movie->country->title}} @endif</td>
                    
                    <td>
                      @if($cate->movie->thuocphim == 'phimle')
                        Phim lẻ
                      @elseif (($cate->movie->thuocphim == 'phimbo')) 
                        Phim bộ
                      @else
                        Không
                      @endif
                    </td>
                    
                    <td>{{$cate->movie->created}}</td>
                    <td>
                        @if($cate->movie->status == 1) Hiển thị
                        @else Không hiển thị 
                        @endif
                    </td>
                    <td>
                        @if($cate->status == 1) Đã duyệt
                        @elseif($cate->status == 0) Từ chối 
                        @else Chưa duyệt
                        @endif
                    </td>
                    
                    <td>
                        {{-- {!! Form::open([
                            'method' => 'DELETE',
                            'route' =>['movie.destroy',$cate->movie->id],
                            'onsubmit' => 'return confirm("Xóa?")'
                        ]) !!}
                        {!! Form::submit('Xóa',['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!} --}}

                        {{-- <form action="{{route('duyet-ct', $cate->movie->id)}}" method="get">
                          <input type="submit" class="btn btn-primary" value="Chi tiết phim">
                        </form> --}}
                        <a class="btn btn-primary" href="{{route('duyet-ct', $cate->movie->slug)}}">Chi tiết phim</a>
                    </td>
                  </tr>
                    @endforeach 
                </tbody>
              </table>

        </div>
    </div>
</div>
@endsection