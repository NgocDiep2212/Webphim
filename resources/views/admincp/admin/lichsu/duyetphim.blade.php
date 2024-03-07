@extends('layouts.app')

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
                    <th scope="col">Phim hot</th>
                    <th scope="col">Thêm vào lúc</th>
                    <th scope="col">Sửa vào lúc</th>
                    <th scope="col">Top views</th>
                    <th scope="col">Trạng thái phim</th>
                    <th scope="col">Trạng thái duyệt phim</th>
                    <th scope="col">Người thêm</th>
                    <th scope="col">Người duyệt</th>
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
                        {{$cate->admin->name}}
                    </td>
                    <td>
                      @if(isset($cate->movie->movie_history->admin->name))
                        {{$cate->movie->movie_history->admin->name}}
                      @endif
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