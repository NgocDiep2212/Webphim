@extends('layouts.app')

@section('content')
<table class="table" id= "tablephim">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Slug</th>
        <th scope="col">Description</th>
        <th scope="col">Active/Inactive</th>
        <th scope="col">Manage</th>
      </tr>
    </thead>
    <tbody>
        @foreach($list as $key => $cate)
      <tr>
        <th scope="row">{{$key}}</th>
        <td>{{$cate->title}}</td>
        <td>{{$cate->slug}}</td>
        <td>{{$cate->description}}</td>
        <td>
            @if($cate->status) Hiển thị
            @else Không hiển thị
            @endif 
            
        </td>
        <td>
            {!! Form::open([
                'method' => 'DELETE',
                'route' =>['country.destroy',$cate->id],
                'onsubmit' => 'return confirm("Xóa?")'
            ]) !!}
            {!! Form::submit('Xóa',['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
            <a href="{{route('country.edit', $cate->id)}}" class="btn btn-warning">Sửa</a>
        </td>
      </tr>
        @endforeach 
    </tbody>
  </table>
@endsection