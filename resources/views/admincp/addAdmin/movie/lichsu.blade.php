@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <a href="{{route('movie.create')}}" class="btn btn-primary">Thêm phim</a>
        <div class="col-md-12">
            <table class="table table-responsive" id="tablephim">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên phim</th>
                    <th scope="col">Số tập phim</th>
                    <th scope="col">Tập phim</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Phim hot</th>
                    <th scope="col">Thêm vào lúc</th>
                    <th scope="col">Sửa vào lúc</th>
                    <th scope="col">Top views</th>
                    <th scope="col">Trạng thái phim</th>
                    <th scope="col">Trạng thái duyệt phim</th>
                    <th scope="col">Quản lý</th>
                  </tr>
                </thead>
                <tbody>
                    @if(isset($list))
                    @foreach($list as $key => $cate)
                  <tr>
                    <th scope="row">{{$key}}</th>
                    <td>{{$cate->movie->title}}</td>
                    <td>{{count($cate->movie->activeMovieEpisodeServer)}}/{{$cate->movie->sotap}} tập</td>
                    <td>
                      <a href="{{route('add-episode',[$cate->movie->id])}}" class="btn btn-danger btn-sm">Thêm tập phim</a>
                    </td>
                    
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
                    <td>
                      @if($cate->movie->phim_hot == 0) Không
                      @else Có
                      @endif 
                    </td>

                    
                    <td>{{$cate->created_at}}</td>
                    <td>{{$cate->updated_at}}</td>
                    <td>
                        {!! Form::select('topview', [ '1' => 'Ngày', '2' => 'Tuần', '3' => 'Tháng'],isset($cate->movie->topview) ? $cate->movie->topview : '', ['class'=>'select-topview','id'=>$cate->movie->id, 'placeholder'=>"--Views--"]) !!}
                    </td>
                    <td>
                        @if($cate->movie->status) Hiển thị
                        @else Không hiển thị
                        @endif 
                    </td>
                    <td>
                        @if($cate->movie->duyet == 0) Chưa duyệt
                        @elseif($cate->movie->duyet == 1) Đã duyệt
                        @elseif($cate->movie->duyet == 2) Từ chối
                        @endif 
                    </td>
                    <td>
                        {!! Form::open([
                            'method' => 'DELETE',
                            'route' =>['movie.destroy',$cate->movie->id],
                            'onsubmit' => 'return confirm("Xóa?")'
                        ]) !!}
                        {!! Form::submit('Xóa',['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                        <a href="{{route('movie.edit', $cate->movie->id)}}" class="btn btn-warning">Sửa</a>
                    </td>
                  </tr>
                    @endforeach 
                    @endif
                </tbody>
              </table>

        </div>
    </div>
</div>
@endsection