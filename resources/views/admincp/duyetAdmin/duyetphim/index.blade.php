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
                    <th scope="col" hidden>Ngày tạo</th>
                    <th scope="col" hidden>Ngày cập nhật</th>
                    {{-- <th scope="col">Season</th> --}}
                    <th scope="col">Quản lý</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($list as $key => $cate)
                  <tr>
                    <th scope="row">{{$key}}</th>
                    <td>{{$cate->title}}</td>
                    <td>{{count($cate->activeMovieEpisodeServer)}}/{{$cate->sotap}} tập</td>
                   
                    <td> 
                      @php
                        $image_check = substr($cate->image,0,5);
                      @endphp
                      @if($image_check =='https')
                      <img width="60%" src="{{$cate->image}}" alt="">
                      @else
                      <img width="60%" src="{{asset('uploads/movie/'.$cate->image)}}" alt="">

                      @endif
                    </td>
                    <td>{!! $cate->description !!}</td>
                    <td>
                      @foreach($cate->activeMovieCategory as $gen)
                      <span class="badge badge-dark">{{$gen->title}}</span>
                      @endforeach
                    </td>
                    <td>
                      @foreach($cate->movie_genre as $gen)
                      <span class="badge badge-dark">{{$gen->title}}</span>
                      @endforeach
                    </td>

                    <td >@if (isset($cate->country)){{$cate->country->title}} @endif</td>
                    
                    <td>
                      @if($cate->thuocphim == 'phimle')
                        Phim lẻ
                      @elseif (($cate->thuocphim == 'phimbo')) 
                        Phim bộ
                      @else
                        Không
                      @endif
                    </td>
                    
                    <td hidden>{{$cate->created}}</td>
                    <td hidden>{{$cate->updated}}</td>
                    
                    <td>
                        {{-- {!! Form::open([
                            'method' => 'DELETE',
                            'route' =>['movie.destroy',$cate->id],
                            'onsubmit' => 'return confirm("Xóa?")'
                        ]) !!}
                        {!! Form::submit('Xóa',['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!} --}}

                        {{-- <form action="{{route('duyet-ct', $cate->id)}}" method="get">
                          <input type="submit" class="btn btn-primary" value="Chi tiết phim">
                        </form> --}}
                        <a class="btn btn-primary" href="{{route('duyet-ct', $cate->slug)}}">Chi tiết phim</a>
                        <a class="btn btn-success" href="{{route('duyet-accept', $cate->slug)}}">Duyệt phim</a>
                        <a class="btn btn-danger" href="{{route('duyet-cancel', $cate->slug)}}">Loại phim</a>
                    </td>
                  </tr>
                    @endforeach 
                </tbody>
              </table>

        </div>
    </div>
</div>
@endsection