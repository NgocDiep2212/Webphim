@extends('layouts.app')

@section('content')
  <div id="chart-container row">
    <div class="card col-md-6">
      <div class="card-body">
        <canvas id="myChart" style="width:100%;max-width:700px"></canvas>
      </div>
    </div>
    <div class="card col-md-6">
      <div class="card-header">
        Doanh thu bán gói VIP
        {{-- <select name="salesMonthSelect" class="salesMonthSelect">
          <option value="1">1 Tháng</option>
          <option value="3">3 Tháng</option>
          <option value="6">6 Tháng</option>
          <option value="12">12 Tháng</option>
        </select> --}}
        {{-- <form action="{{route('thongke')}}" method="post"> --}}
          @if(isset($min_time_sales) && $min_time_sales != null)
            <input type="date" name="dayStart_sales" id="dayStart_sales" value="{{$min_time_sales}}"> - 
          @else
            <input type="date" name="dayStart_sales" id="dayStart_sales"> - 
          @endif
          @if(isset($today) && $today != null)
            <input type="date" name="dayEnd_sales" id="dayEnd_sales" value="{{$today}}">
          @else
            <input type="date" name="dayEnd_sales" id="dayEnd_sales">
          @endif
          <button id="submit-sale">Lọc</button>
        {{-- </form> --}}
      </div>
      
      <div class="card-body">
        <canvas id="salesChart" style="width:100%;max-width:700px"></canvas>
      </div>
    </div>
    <div class="card col-md-6">
    <table class="table" id="tablephim">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Comment</th>
          <th scope="col">Created_at</th>
          <th scope="col">Manage</th>
        </tr>
      </thead>
      <tbody class="order_position">
        @foreach($movie_comment as $key => $cmt)
          @if($cmt->status == 1)
            <tr id="{{$cmt->id}}">
              <th scope="row">{{$key}}</th>
              <td>{{$cmt->user->name}}</td>
              <td>{{$cmt->noidung}}</td>
              <td>{{$cmt->created_at}}</td>
              <td>
                <div class="cmt_id" style="display: none;">{{$cmt->id}}</div>
                <div href="#" style="color: red; cursor: pointer;" class="ban-cmt">Rejected</div>
              </td>
            </tr>
          @endif
        @endforeach 
        @foreach($movie_comment_reply as $key => $cmt)
          @if($cmt->status == 1)
            <tr id="{{$cmt->id}}">
              <th scope="row">{{$key}}</th>
              <td>{{$cmt->user_reply->name}}</td>
              <td>{{$cmt->noidung}}</td>
              <td>{{$cmt->created_at}}</td>
              <td>
                <div class="cmt_id" style="display: none;">{{$cmt->id}}</div>
                <div href="#" style="color: red; cursor: pointer;" class="ban-rep-cmt">Rejected</div>
              </td>
            </tr>
          @endif
        @endforeach 
      </tbody>
    </table>
  </div>
    {{-- <div class="card col-md-6">
      <div class="card-header">COMMENTS</div>
      <div class="card-body">
        
        @foreach($movie_comment as $key => $cmt)
        @if($cmt->status == 1)
        <div style="display:flex;" class="list-group-item">
          <div style="width:8%">
            <img src="https://w7.pngwing.com/pngs/178/595/png-transparent-user-profile-computer-icons-login-user-avatars-thumbnail.png" alt="user-img" style="max-width: 30px;">
          </div>
          <div style="width:80%">
            <div style="display: flex; justify-content: space-between;">
              <h4 style="font-weight: 600">{{$cmt->user->name}} </h4>
              <span style="color: grey;">{{$cmt->created_at}}</span>
            </div>  
            <span class="cmt_content">{{$cmt->noidung}}</span> <br/>
            <span class="cmt_id" hidden>{{$cmt->id}}</span>
            <div href="#" style="color: red; cursor: pointer;" class="ban-cmt">Rejected</div>
          </div>
        </div>
        @endif
        @endforeach
        @foreach($movie_comment_reply as $key => $cmt)
        @if($cmt->status == 1)
        <div style="display:flex;" class="list-group-item">
          <div style="width:8%">
            <img src="https://w7.pngwing.com/pngs/178/595/png-transparent-user-profile-computer-icons-login-user-avatars-thumbnail.png" alt="user-img" style="max-width: 30px;">
          </div>
          <div style="width:80%">
            <div style="display: flex; justify-content: space-between;">
              <h4 style="font-weight: 600">{{$cmt->user_reply->name}} </h4>
              <span style="color: grey;">{{$cmt->created_at}}</span>
            </div>  
            <span class="cmt_id" hidden>{{$cmt->id}}</span>
            <span>{{$cmt->noidung}}</span> <br/>
            <div style="color: red; cursor: pointer;" class="ban-rep-cmt">Rejected</div>
          </div>
        </div>
        @endif
        @endforeach
      </div>
    </div> --}}
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