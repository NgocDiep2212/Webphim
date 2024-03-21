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
    </div>
    
    
    
    
    
  </div>
  

@endsection