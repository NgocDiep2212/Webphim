@extends('layouts.ad_add')

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
                    {{-- <th scope="col">Từ khóa</th>
                    <th scope="col">Thời lượng phim</th> --}}
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Phim hot</th>
                    <th scope="col">Định dạng</th>
                    <th scope="col">Phụ đề</th>
                    <th scope="col">Đường dẫn</th>
                    {{-- <th scope="col">Description</th> --}}
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Danh mục</th>
                    <th scope="col">Thể loại</th>
                    <th scope="col">Quốc gia</th>
                    <th scope="col">Thuộc thể loại</th>
                    <th scope="col" hidden>Ngày tạo</th>
                    <th scope="col" hidden>Ngày cập nhật</th>
                    <th scope="col">Năm phim</th>
                    {{-- <th scope="col">Season</th> --}}
                    <th scope="col">Top views</th>
                    <th scope="col">Phim VIP</th>
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
                      <a href="{{route('add-episode',[$cate->id])}}" class="btn btn-danger btn-sm">Thêm tập phim</a>
                    </td>
                    {{-- <td>
                      @if(strlen($cate->tags)>100)
                        @php
                         $tag = substr($cate->tags,0 , 50);
                         echo $tag.'...'   
                        @endphp
                      @endif  
                    </td>
                    <td>{{$cate->duration}}</td> --}}
                    
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
                    <td>
                      @if($cate->phim_hot == 0) Không
                      @else Có
                      @endif 
                    </td>

                    <td>
                      @if($cate->resolution == 0) HD
                      @elseif($cate->resolution == 1) SD
                      @elseif($cate->resolution == 2) HDCam
                      @elseif($cate->resolution == 3) Cam
                      @elseif($cate->resolution == 4) FullHD
                      @else Trailer
                      @endif 
                    </td>
                    <td>
                      @if($cate->vietsub == 0) Phụ đề
                      @else Thuyết minh
                      @endif 
                    </td>
                    <td>{{$cate->slug}}</td>
                    {{-- <td>{{$cate->description}}</td> --}}
                    <td>
                        @if($cate->status) Hiển thị
                        @else Không hiển thị
                        @endif 
                        
                    </td>
                   
                    {{-- <td>{{$cate->category->title}}</td> --}}
                    {{-- bang movie_genre thuoc movie --}}
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
                      {!! Form::selectYear('year', 2000,2023,isset($cate->year) ? $cate->year : '',['class' => 'select-year', 'id'=>$cate->id, 'placeholder'=>"--Năm phim--"]) !!}
                    </td>
                    {{-- <td>
                      {!! Form::selectRange('season', 0,20,isset($cate->season) ? $cate->season : '',['class' => 'select-season', 'id'=>$cate->id]) !!}
                    </td> --}}
                    <td>
                      {!! Form::select('topview', [ '1' => 'Ngày', '2' => 'Tuần', '3' => 'Tháng'],isset($cate->topview) ? $cate->topview : '', ['class'=>'select-topview','id'=>$cate->id, 'placeholder'=>"--Views--"]) !!}
                    </td>
                    <td>
                      {!! Form::select('vip', [ '0' => 'Không', '1' => 'VIP'],isset($cate->vip) ? $cate->vip : '', ['class'=>'select-vip','id'=>$cate->id, 'placeholder'=>"--Chọn--"]) !!}
                    </td>
                    <td>
                        {!! Form::open([
                            'method' => 'DELETE',
                            'route' =>['movie.destroy',$cate->id],
                            'onsubmit' => 'return confirm("Xóa?")'
                        ]) !!}
                        {!! Form::submit('Xóa',['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                        <a href="{{route('movie.edit', $cate->id)}}" class="btn btn-warning">Sửa</a>
                    </td>
                  </tr>
                    @endforeach 
                </tbody>
              </table>

        </div>
    </div>
</div>
@endsection