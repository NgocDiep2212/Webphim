@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
           
            <table class="table table-responsive" id= "tablephim">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Movie image</th>
                    <th scope="col">Movie link</th>
                    <th scope="col">Episode</th>
                    {{-- <th scope="col">Active/Inactive</th> --}}
                    <th scope="col">Manage</th>
                  </tr>
                </thead>
                <tbody class="order_position">
                    @foreach($list_ep as $key => $cate)
                        <tr>
                            <th scope="row">{{$key}}</th>
                            <td>{{$cate->movie->title}}</td>
                            <td> <img width="60%" src="{{asset('uploads/movie/'.$cate->movie->image)}}" alt=""></td>
                            <td>{{$cate->linkphim}}</td>

                            <td>{{$cate->episode}}</td>
                            {{-- <td>
                                @if($cate->status) Hiển thị
                                @else Không hiển thị
                                @endif 
                                
                            </td> --}}
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
                </tbody>
              </table>

        </div>
    </div>
</div>
@endsection