@extends('layouts.app')

@section('content')
<table class="table" id="tablephim">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Mã hóa đơn</th>
        <th scope="col">Tên</th>
        <th scope="col">Email</th>
        <th scope="col">Tên gói</th>
        <th scope="col">Hình thức thanh toán</th>
        <th scope="col">Số tiền thanh toán</th>
        <th scope="col">Tạo vào lúc</th>
        <th scope="col">Trạng thái</th>
      </tr>
    </thead>
    <tbody class="order_position">
        @foreach($list as $key => $cate)
        <tr id="{{$cate->id}}">
            <th scope="row">{{$key}}</th>
            <td>{{$cate->id}}</td>
            <td>{{$cate->user->name}}</td>
            <td>{{$cate->user->email}}</td>
            <td>{{$cate->goivip->name}}</td>
            <td>{{$cate->hinhthuctt}}</td>
            <td>{{$cate->total}}</td>
            <td>{{$cate->created_at}}</td>
            <td>
                @if($cate->expired_at >= $date_now) <p class="btn btn-success">Còn hạn</p>
                @else <p class="btn btn-danger">Hết hạn</p>
                @endif
            </td>
          
        </tr>
        @endforeach 
    </tbody>
  </table>
@endsection