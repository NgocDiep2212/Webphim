@extends('layout')
@section('content')
<div class="row container" id="wrapper">
    <div class="content row container" style="text-align: center;margin: 0px auto 38px auto;">
         <h4 style="color: #e1a626; font-weight: 600;font-size: 24px; margin: 20px;">Đặc Quyền Thành Viên VIP</h4>
         <div class="col-sm-3"> 
            <img src="https://static2.vieon.vn/vieon-images/2022-payment-image/08/17/web/slide-benefit/web-benefit-2-xem-som-nhat.svg" alt=""> 
         </div>
         <div class="col-sm-3"> 
            <img src="https://static2.vieon.vn/vieon-images/2022-payment-image/08/17/web/slide-benefit/web-benefit-3-khong-quang-cao.svg" alt=""> 
         </div>
         <div class="col-sm-3"> 
            <img src="https://static2.vieon.vn/vieon-images/2022-payment-image/08/17/web/slide-benefit/web-benefit-4-subtitle.svg" alt=""> 
         </div>
         <div class="col-sm-3"> 
            <img src="https://static2.vieon.vn/vieon-images/2022-payment-image/08/17/web/slide-benefit/web-benefit-5-quality.svg" alt=""> 
         </div>
    </div>
    <div class="content container" style="text-align: center; margin: auto;">
         <h4 style="color: #e1a626; font-weight: 600;font-size: 24px;">Chọn Gói Phù Hợp Với Bạn</h4>
         <div class="row" style="display: flex; justify-content: space-around; margin-top: 20px;">
         @foreach($list as $key => $goi)
         <div class="col-sm-3" style="border: 2px solid #e1a626; padding-top: 20px;padding-bottom: 36px;"> 
            <form action="{{route('thanh-toan')}}" method="post">
               @csrf
               <input type="hidden" name="id_goi" value="{{$goi->id}}">
               <h4 style="font-weight: 600;color: #e1a626">{{$goi->name}}</h4>
               <p style="font-size: 26px; font-weight: 600;color: white;">{{$goi->price}}đ</p>
               <p>{{$goi->duration}}</p>
               <button type="submit" class="btn btn-warning" style=" margin-top: 6px;">Mua ngay</button>
            </form>
         </div>
         @endforeach
      </div>
      
    </div>

</div>
@endsection