@extends('layouts.app')

@section('content')
<table class="table" id="tablephim">
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
        @foreach($resp->items as $key => $res)
      <tr >
        <th scope="row">{{$key}}</th>
        <td>{{$res->name}}</td>
        <td>{{$res->origin_name}}</td>
        <td> <img src="{{$resp->pathImage.$res->thumb_url}}" height="80" width="80" alt=""> </td>
        <td><img src="{{$resp->pathImage.$res->poster_url}}" height="80" width="80" alt=""> </td>
        <td>{{$res->slug}}</td>
        <td>{{$res->_id}}</td>
        <td>{{$res->year}}</td>
        <td> 
            <a href="{{route('leech-detail',$res->slug)}}" class="btn btn-primary btn-sm">Chi tiết phim</a> 
            <a href="{{route('leech-episode',$res->slug)}}" class="btn btn-warning btn-sm">Tập phim</a> 
            @php
                $movie = \App\Models\Movie::where('slug',$res->slug)->first();
            @endphp
            @if(!$movie)
            <form action="{{route('leech-store',$res->slug)}}" method="post">
                @csrf
                <input type="submit" class="btn btn-success" value="Thêm Phim">
            </form>
            @else
            <form action="{{route('movie.destroy',$movie->id)}}" method="post">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn btn-danger" value="Xóa Phim">

            </form>

            @endif
        </td>
       
        {{-- <td>
            {!! Form::open([
                'method' => 'DELETE',
                'route' =>['category.destroy',$cate->id],
                'onsubmit' => 'return confirm("Xóa?")'
            ]) !!}
            {!! Form::submit('Xóa',['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
            <a href="{{route('category.edit', $cate->id)}}" class="btn btn-warning">Sửa</a>
        </td> --}}
      </tr>
        @endforeach 
    </tbody>
  </table>
@endsection