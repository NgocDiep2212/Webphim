@extends('layouts.app')

@section('content')
<table class="table" id="tablephim">
  <a href="{{route('refresh-json')}}" class="btn btn-info">
    <i class="fa fa-retweet"></i> Refresh
  </a>
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Tên phim</th>
        <th scope="col">Tên chính thức</th>
        <th scope="col">Hình ảnh phim</th>
        <th scope="col">Hình ảnh poster</th>
        <th scope="col">Slug</th>
        <th scope="col">_Id</th>
        <th scope="col">Year</th>
        <th scope="col">Quản lý</th>
      </tr>
    </thead>
    <tbody class="order_position">
      {{-- @if(is_array($data)) true @else {{$data['items'][0]}} @endif --}}
      @if(isset ($datas['items']))
        @foreach($datas['items'] as $key => $res)
      <tr >
        <th scope="row">{{$key}}</th>
        <td>{{$res['name']}}</td>
        <td>{{$res['origin_name']}}</td>
        <td> <img src="{{$datas['pathImage'][0].$res['thumb_url']}}" height="80" width="80" alt=""> </td>
        <td><img src="{{$datas['pathImage'][0].$res['poster_url']}}" height="80" width="80" alt=""> </td>
        <td>{{$res['slug']}}</td>
        <td>{{$res['_id']}}</td>
        <td>{{$res['year']}}</td>
        <td> 
            <a href="{{route('leech-detail',$res['slug'])}}" class="btn btn-primary btn-sm">Chi tiết phim</a> 
            <a href="{{route('leech-episode',$res['slug'])}}" class="btn btn-warning btn-sm">Tập phim</a> 
            @php
                $movie = \App\Models\Movie::where('slug',$res['slug'])->first();
            @endphp
            @if(!$movie)
            <form action="{{route('leech-store',$res['slug'])}}" method="post">
                @csrf
                <a href="{{route('leech-episode-store',[$res['slug']])}}"></a>
                <input type="submit" class="btn btn-success" value="Thêm Phim">
            </form>
            @else
            <a class="btn btn-danger" href="{{route('destroy-leech', $movie['id'])}}">Xóa</a>
            @endif
        </td>
       
        {{-- <td>
            {!! Form::open([
                'method' => 'DELETE',
                'route' =>['category.destroy',$cate['id']],
                'onsubmit' => 'return confirm("Xóa?")'
            ]) !!}
            {!! Form::submit('Xóa',['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
            <a href="{{route('category.edit', $cate['id'])}}" class="btn btn-warning">Sửa</a>
        </td> --}}
      </tr>
        @endforeach 
      @endif
    </tbody>

  </table>
  {{-- <ul style="justify-content: center; display:flex;" class="pagination"> --}}
</ul>
@endsection