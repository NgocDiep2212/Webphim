@extends('layouts.app')

@section('content')
<table class="table" id="tablephim">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Tên Nhân Viên</th>
        <th scope="col">Email</th>
        <th scope="col">Tên chức vụ</th>
        <th scope="col">Người thêm</th>
        <th scope="col">Trạng thái</th>
        <th scope="col">Tạo vào lúc</th>
      </tr>
    </thead>
    <tbody class="order_position">
        @foreach($list as $key => $cate)
      <tr id="{{$cate->id}}">
        <th scope="row">{{$key}}</th>
        <td>{{$cate['name_nhanvien']}}</td>
        <td>{{$cate['email_nhanvien']}}</td>
        <td>{{$cate->role['name']}}</td>
        <td>{{$cate['name_admin']}}</td>
        <td>
          @if($cate['status'] == 0) Thêm
          @elseif($cate['status'] == 1) Chỉnh sửa
          @elseif($cate['status'] == 2) Xóa
          @elseif($cate['status'] == 3) Phục hồi
          @endif
        </td>
        <td>{{$cate->created_at}}</td>
        
      </tr>
        @endforeach 
    </tbody>
  </table>
@endsection