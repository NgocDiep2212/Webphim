@extends('layouts.app')

@section('content')

  <div id="chart-container row">
    <div class="card col-md-6">
      <div class="card-header">
        Top Phim được xem nhiều nhất
      </div>
      <div class="card-body">
        <canvas id="myChart" style="width:100%;max-width:700px"></canvas>
      </div>
    </div>
    <div class="card col-md-6">
      <div class="card-header">
        Doanh thu bán gói VIP
        <select name="salesMonthSelect" class="salesMonthSelect">
          <option value="1">1 Tháng</option>
          <option value="3">3 Tháng</option>
          <option value="6">6 Tháng</option>
          <option value="12">12 Tháng</option>
        </select>
      </div>
      <div class="card-body">
        <canvas id="salesChart" style="width:100%;max-width:700px"></canvas>
      </div>
    </div>
    <div class="card col-md-6">
      <div class="card-header">COMMENTS</div>
      <div class="card-body">
        @foreach($movie_comment as $key => $cmt)
        <div style="display:flex;" class="list-group-item">
          <div style="width:8%">
            <img src="https://w7.pngwing.com/pngs/178/595/png-transparent-user-profile-computer-icons-login-user-avatars-thumbnail.png" alt="user-img" style="max-width: 30px;">
          </div>
          <div style="width:80%">
            <div style="display: flex; justify-content: space-between;">
              <h4 style="font-weight: 600">{{$cmt->user->name}} </h4>
              <span style="color: grey;">{{$cmt->created_at}}</span>
            </div>  
            <span>{{$cmt->noidung}}</span> <br/>
            <a href="" style="color: red">Rejected</a>
          </div>
        </div>
        @endforeach
        @foreach($movie_comment_reply as $key => $cmt)
        <div style="display:flex;" class="list-group-item">
          <div style="width:8%">
            <img src="https://w7.pngwing.com/pngs/178/595/png-transparent-user-profile-computer-icons-login-user-avatars-thumbnail.png" alt="user-img" style="max-width: 30px;">
          </div>
          <div style="width:80%">
            <div style="display: flex; justify-content: space-between;">
              <h4 style="font-weight: 600">{{$cmt->user_reply->name}} </h4>
              <span style="color: grey;">{{$cmt->created_at}}</span>
            </div>  
            <span>{{$cmt->noidung}}</span> <br/>
            <a href="" style="color: red">Rejected</a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    <div class="card col-md-6">
      <div class="card-header">RATINGS</div>
      <div class="card-body">
        @foreach($rating as $key => $rate)
        <div style="display:flex;" class="list-group-item">
          <div style="width:8%">
            <img src="https://w7.pngwing.com/pngs/178/595/png-transparent-user-profile-computer-icons-login-user-avatars-thumbnail.png" alt="user-img" style="max-width: 30px;">
          </div>
          <div style="width:80%">
            <div style="display: flex; justify-content: space-between;">
              <h4 style="font-weight: 600">{{$rate->user->name}} </h4>
              <span style="color: grey;">{{$rate->created_at}}</span>
            </div>  
            <span>{{$rate->movie->title}}</span>
            <span>
            @for($i=1; $i<=$rate->rate;$i++)
              <i class="fa fa-star" style="color: rgb(248, 203, 0);"></i>
            @endfor
            </span> <br/>
          </div>
        </div>
        @endforeach
        
      </div>
    </div>
    {{-- <div class="card col-md-6">
      <div class="card-header">
        Lượt xem phim
        <select name="viewsMonthSelect" class="viewsMonthSelect">
          <option value="1">1 Tháng</option>
          <option value="3">3 Tháng</option>
          <option value="6">6 Tháng</option>
          <option value="12">12 Tháng</option>
        </select>
      </div>
      <div class="card-body">
        <canvas id="viewsChart" style="width:100%;max-width:700px"></canvas>
      </div>
    </div> --}}
    
    
    
    
    
  </div>
  

@endsection