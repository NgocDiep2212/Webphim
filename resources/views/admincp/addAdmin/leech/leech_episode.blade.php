@extends('layouts.ad_add')

@section('content')
<table class="table" id="">
    <thead>
      <tr>
        {{-- <th scope="col">#</th> --}}
        <th scope="col">Tên phim</th>
        <th scope="col">Link Embeb</th>
        <th scope="col">Link M3u8</th>
        <th scope="col">Slug phim</th>
        <th scope="col">Số tập</th>
        <th scope="col">Tập phim</th>
        <th scope="col">Quản lý</th>
      </tr>
    </thead>
    <tbody class="order_position">
      <tr >
        {{-- <th scope="row">{{$key}}</th> --}}
        <td>{{$resp->movie->name}}</td>
        <td>
            @foreach($resp->episodes as $episode)
            
                @foreach($episode->server_data as $server1)
                <ul>
                    <li>
                        Tập: {{$server1->name}}
                        <input type="text" class="form-control" value={{$server1->link_embed}}>
                    </li>
                </ul>
                @endforeach
             @endforeach
        </td>
        <td>
            @foreach($resp->episodes as $episode)
                @foreach($episode->server_data as $server2)
                <ul>
                    <li>
                        Tập: {{$server2->name}}
                        <input type="text" class="form-control" value={{$server2->link_m3u8}}>
                    </li>
                </ul>
                @endforeach
             @endforeach
        </td>
        <td>{{$resp->movie->slug}}</td>
        <td>{{$resp->movie->episode_total}}</td>

        <td>
            <form action="{{route('leech-episode-store',[$resp->movie->slug])}}" method="post">
                @csrf
                <input type="submit" value="Thêm tập phim" class="btn btn-success btn-sm">
                
            </form>
            {{-- <form action="" method="post">
                @csrf
                <input type="submit" value="Xóa tập phim" class="btn btn-danger btn-sm">
                
            </form> --}}
        </td>
        
        {{-- <td>{{$resp->episodes['server_name']}}</td> --}}
        {{-- @php
            $resp1[] =$resp->episodes->server_data->toArray();
        @endphp
        <td>
            @foreach($resp1 as $key => $server_1)
                <ul>
                    <li>
                        Tap {{$server_1->name}}
                    </li>
                </ul>
            @endforeach
        </td> --}}
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