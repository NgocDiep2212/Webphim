@extends('layouts.app')

@section('content')
<table class="table" id="tablephim">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Tên</th>
        <th scope="col">Email</th>
        <th scope="col">Tên chức vụ</th>
        <th scope="col">Người xóa</th>
        <th scope="col">Xóa vào lúc</th>
        <th scope="col">Manage</th>
      </tr>
    </thead>
    <tbody class="order_position">
        @foreach($list as $key => $cate)
        @if(isset($cate->nhanvien) && $cate->nhanvien['status'] == 0 && $cate['status'] == 2)
      <tr id="{{$cate->id}}">
        <th scope="row">{{$key}}</th>
        <td>{{$cate->name_nhanvien}}</td>
        <td>{{$cate->email_nhanvien}}</td>
        <td>{{$cate->role['name']}}</td>
        <td>{{$cate->name_admin}}</td>
        <td>{{$cate->created_at}}</td>
        <td>
          <form action="{{route('khoiphuc-nv', $cate->id_nhanvien)}}" method="post">
            @csrf
            <input type="submit" class="btn btn-primary" value="Khôi phục">
          </form>
        </td>
      </tr>
        @endif
        @endforeach 
    </tbody>
  </table>
@endsection