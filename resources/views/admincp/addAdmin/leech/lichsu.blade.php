@extends('layouts.ad_add')

@section('content')
<table class="table" id="">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Tên phim</th>
        <th scope="col">Tên chính thức</th>
        <th scope="col">Hình ảnh phim</th>
        <th scope="col">Slug</th>
        <th scope="col">Id Leech</th>
        <th scope="col">Year</th>
        <th scope="col">Quản lý</th>
      </tr>
    </thead>
    <tbody class="order_position">
        @foreach($list as $key => $res)
      <tr >
        <th scope="row">{{$key}}</th>
        <td>{{$res->movie->title}}</td>
        <td>{{$res->movie->name_eng}}</td>
        <td> <img src="{{$res->movie->image}}" height="80" width="80" alt=""> </td>
        <td>{{$res->movie->slug}}</td>
        <td>{{$res->movie->id_leech}}</td>
        <td>{{$res->movie->year}}</td>
        <td> 
            <a href="{{route('leech-detail',$res->movie->slug)}}" class="btn btn-primary btn-sm">Chi tiết phim</a> 
            <a href="{{route('leech-episode',$res->movie->slug)}}" class="btn btn-warning btn-sm">Tập phim</a> 
            @php
                $movie = \App\Models\Movie::where('slug',$res->movie->slug)->first();
            @endphp
            @if(!$movie)
            <form action="{{route('leech-store',$res->movie->slug)}}" method="post">
                @csrf
                <input type="submit" class="btn btn-success" value="Thêm Phim">
            </form>
            @else
            <a class="btn btn-danger" href="{{route('destroy-leech', $movie->id)}}">Xóa</a>
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