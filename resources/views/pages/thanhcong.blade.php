@extends('layout')

@section('content')
    <div class="container" style="text-align: center;">
        <h4 style="font-size: 18px; margin-top: 50px; text-transform: uppercase;
        color: #4ece4e;font-weight: 600;">Chúc mừng</h4>
        <h4 style="font-size: 18px;
        margin-top: 10px;
        text-transform: uppercase;
        color: #4ece4e;
        font-weight: 600">Bạn đã thanh toán thành công</h4>
        <div class="box-content" style="margin-top: 20px;margin-bottom: 30px;">
            <h4>Mã đơn hàng: #{{$order->transactionNo}}</h4>
            <h4>Thanh toán vào ngày: {{date('d-m-Y', strtotime($order->created_at))}}</h4>
            <h4>Hết hạn vào ngày: {{date('d-m-Y', strtotime($order->expired_at))}}</h4>
            <h4>Gói: {{$order->goivip->name}}</h4>
            <h4>Số tiền: {{$order->total}}</h4>
            <h4>Hình thức thanh toán: {{$order->hinhthuctt}}</h4>
        </div>
    </div>
@endsection