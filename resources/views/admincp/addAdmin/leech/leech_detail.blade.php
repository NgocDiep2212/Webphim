@extends('layouts.ad_add')

@section('content')
<table class="table" id="">
    <thead>
      <tr>
        {{-- <th scope="col">#</th> --}}
        <th scope="col">Tên phim</th>
        <th scope="col">Tên chính thức</th>
        <th scope="col">Hình ảnh phim</th>
        <th scope="col">Hình ảnh poster</th>
        <th scope="col">content</th>
        <th scope="col">type</th>
        <th scope="col">status</th>
        <th scope="col">trailer_url</th>
        <th scope="col">time</th>
        <th scope="col">episode_current</th>
        <th scope="col">episode_total</th>
        <th scope="col">quality</th>
        <th scope="col">lang</th>
        <th scope="col">year</th>
        <th scope="col">view</th>
        <th scope="col">actor</th>
        <th scope="col">category</th>
        <th scope="col">country</th>
        {{-- <th scope="col">episodes</th> --}}

        {{-- <th scope="col">Quản lý</th> --}}
      </tr>
    </thead>
    <tbody class="order_position">
      <tr >
        {{-- <th scope="row">{{$key}}</th> --}}
        <td>{{$resp_movie->name}}</td>
        <td>{{$resp_movie->origin_name}}</td>
        <td><img src="{{$resp_movie->thumb_url}}" height="80" width="80" alt=""></td>
        <td><img src="{{$resp_movie->poster_url}}" height="80" width="80" alt=""></td>
        <td>{{$resp_movie->content}}</td>
        <td>{{$resp_movie->type}}</td>
        <td>{{$resp_movie->status}}</td>
        <td>{{$resp_movie->trailer_url}}</td>
        <td>{{$resp_movie->time}}</td>
        <td>{{$resp_movie->episode_current}}</td>
        <td>{{$resp_movie->episode_total}}</td>
        <td>{{$resp_movie->quality}}</td>
        <td>{{$resp_movie->lang}}</td>
        <td>{{$resp_movie->year}}</td>
        <td>{{$resp_movie->view}}</td>
        <td>
            @foreach($resp_movie->actor as $actor)
                <span class="badge badge-info">{{$actor}}</span>
            @endforeach
        </td>
        <td>
            @foreach($resp_movie->category as $cate)
            <span class="badge badge-info">{{$cate->name}}</span>
            @endforeach
        </td>
        <td>
            @foreach($resp_movie->country as $coun)
            <span class="badge badge-info">{{$coun->name}}</span>
            @endforeach</td>
        {{-- <td>{{$resp_movie->episodes}}
            
        </td> --}}
        {{-- <td></td>
        <td>{{$res->origin_name}}</td>
        <td> <img src="{{$resp->pathImage.$res->thumb_url}}" height="80" width="80" alt=""> </td>
        <td><img src="{{$resp->pathImage.$res->poster_url}}" height="80" width="80" alt=""> </td>
        <td>{{$res->slug}}</td>
        <td>{{$res->_id}}</td>
        <td>{{$res->year}}</td> --}}
       
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
    </tbody>
  </table>
@endsection