@extends('layout')
@section('content')
<div class="row container" id="wrapper">
    <div class="content row container" style="text-align: center;margin: 0px auto 38px auto;">
         <h4 style="color: #e1a626; font-weight: 600;font-size: 24px; margin: 20px;">Vui Lòng Chọn Hình Thức Thanh Toán</h4>
         <div class=""> 
            <h4>Thanh toán VNPay</h4>
            <form action="{{route('thanh-toan-vnpay')}}" method="post">
               @csrf
               <input type="hidden" name="goi_id" value="{{$goi->id}}">
               <input type="hidden" name="total_vnpay" value="{{$goi->price}}">
               <button type="submit" class="btn btn-default" name="redirect">
                  Thanh toán VNPay
               </button>
            </form>
         </div>
         
    </div>
    

</div>
@endsection