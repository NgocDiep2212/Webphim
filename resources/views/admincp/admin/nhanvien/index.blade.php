@extends('layouts.app')

@section('content')
<table class="table" id="tablephim">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Tên</th>
        <th scope="col">Email</th>
        <th scope="col">Tên chức vụ</th>
        <th scope="col">Người thêm</th>
        <th scope="col">Tạo vào lúc</th>
        <th scope="col">Cập nhật vào lúc</th>
        <th scope="col">Manage</th>
      </tr>
    </thead>
    <tbody class="order_position">
        @foreach($list as $key => $cate)
      <tr id="{{$cate->id}}">
        <th scope="row">{{$key}}</th>
        <td>{{$cate->name}}</td>
        <td>{{$cate->email}}</td>
        <td>{{$cate->role['name']}}</td>
        <td> 
          @if($cate->nguoithem)
            {{($cate->nguoithem['name_admin'])}}
          @else Không có
          @endif
        </td>
        <td>{{$cate->created_at}}</td>
        <td>{{$cate->updated_at}}</td>
        <td>
            {!! Form::open([
                'method' => 'DELETE',
                'route' =>['nhanvien.destroy',$cate->id],
                'onsubmit' => 'return confirm("Xóa?")'
            ]) !!}
            {!! Form::submit('Xóa',['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
            <a href="{{route('nhanvien.edit', $cate->id)}}" class="btn btn-warning">Sửa</a>
        </td>
      </tr>
        @endforeach 
    </tbody>
  </table>
@endsection