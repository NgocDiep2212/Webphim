@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <a href="{{route('episode.index')}}" class="btn btn-primary">Liệt kê tập phim</a>
                <div class="card-header">
                    Quản lý tập phim
                </div>
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{session('status')}}
                        </div>
                    @endif
                    @if(!isset($episode))
                    {!! Form::open([
                        'method' => 'POST',
                        'route' =>['episode.store']
                    ]) !!}
                    @else 
                    {!! Form::open([
                        'method' => 'PUT',
                        'route' =>['episode.update',$episode->id]
                    ]) !!}
                    @endif
                    <div class="form-group">
                        {!! Form::label('movie_title', 'Phim', []) !!}
                        {!! Form::text('movie_title', isset($movie) ? $movie->title : '', ['class'=>'form-control','readonly']) !!}
                        {!! Form::hidden('movie_id', isset($movie) ? $movie->id : '') !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('linkphim', 'Link Phim', []) !!}
                        {!! Form::text('linkphim', isset($episode) ? $episode->linkphim : '', ['class'=>'form-control', 'required'=>'required']) !!}
                    </div>

                    @if(isset($episode))
                    <div class="form-group">
                        {{-- <select name="episode" class="form-control" id="show_movie"> --}}
                            {!! Form::label('episode', 'Tập Phim', []) !!}
                            {!! Form::text('episode', isset($episode) ? $episode->episode : '', ['class'=>'form-control','placeholder'=>'...', isset($episode) ? 'readonly' : '', 'required'=>'required']) !!}
                        {{-- </select> --}}
                        
                    </div>
                    @else
                        <div class="form-group">
                            {!! Form::label('episode', 'Tập Phim', []) !!}
                            {!! Form::selectRange('episode',1,$movie->sotap,$movie->sotap, ['class'=>'form-control', 'required'=>'required']) !!}
                            
                        </div>
                    @endif
                    <div class="form-group">
                        {!! Form::label('linkserver', 'Link Server', []) !!}
                        {!! Form::select('linkserver',$linkmovie, '',  ['class'=>'form-control']) !!}
                    </div>
                    @if(!isset($episode))
                        {!! Form::submit('Thêm tập phim', ['class'=>'btn btn-success']) !!}
                    @else
                        {!! Form::submit('Cập nhật tập phim', ['class'=>'btn btn-success']) !!}
                    @endif
                        {!! Form::close () !!}

                </div> 
            </div>
        </div>

        {{-- Liệt kê phim --}}
        <div class="col-md-12">
           
            <table class="table table-responsive" id= "tablephim">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    {{-- <th scope="col">Movie image</th> --}}
                    <th scope="col">Movie link</th>
                    <th scope="col">Episode</th>
                    <th scope="col">Server</th>
                    {{-- <th scope="col">Active/Inactive</th> --}}
                    <th scope="col">Manage</th>
                  </tr>
                </thead>
                <tbody class="order_position">
                @if(count($movie->activeMovieEpisodeServer) != $ep_se_sum)
                    @foreach($list_ep as $key => $cate)
                        <tr>
                            <th scope="row">{{$key}}</th>
                            <td>{{$cate->movie->title}}</td>
                            {{-- <td> <img width="60%" src="{{asset('uploads/movie/'.$cate->movie->image)}}" alt=""></td> --}}
                            <td>{{$cate->episode_server->linkphim}}</td>

                            <td>{{$cate->episode}}</td>
                            {{-- <td>
                                @if($cate->status) Hiển thị
                                @else Không hiển thị
                                @endif 
                                
                            </td> --}}
                            
                            <td>
                                @foreach($list_server as $key =>$server_link)
                                    @if($cate->episode_server->server_id ==  $server_link->id)
                                        {{$server_link->title}}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                {!! Form::open([
                                    'method' => 'DELETE',
                                    'route' =>['episode.destroy',$cate->id],
                                    'onsubmit' => 'return confirm("Xóa?")'
                                ]) !!}
                                {!! Form::submit('Xóa',['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                                <a href="{{route('episode.edit', $cate->id)}}" class="btn btn-warning">Sửa</a>
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