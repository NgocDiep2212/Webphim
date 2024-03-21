@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Đang online : {{ \Tracker::onlineUsers()->count() }} 
    </div>
    <div class="card-body">
        <table class="table" id="tablephim">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">ID người dùng</th>
                <th scope="col">Tên người dùng</th>
                <th scope="col">Trình duyệt</th>
                <th scope="col">Loại trình duyệt</th>
                <th scope="col">Loại thiết bị</th>
                <th scope="col">Hệ điều hành/Version</th>
                <th scope="col">IP Adress</th>
                <th scope="col">Bằng điện thoại</th>
                <th scope="col">Preference</th>
                <th scope="col ">Log</th>
                <th scope="col">Truy cập</th>
                <th scope="col">Tổng truy cập trang</th>
              </tr>
            </thead>
            <tbody class="order_position">
                @foreach($sessions as $key => $session)
              <tr id="{{$session->id}}">
                <th scope="row">{{$key}}</th>
                <td>@if(isset($session->user_id)) {{$session->user_id}} @else 44 @endif</td>
                <td>@if(isset($session->user->name)) {{$session->user->name}} @else Guest @endif</td>
                <td>{{$session->agent->browser}}</td>
                <td>{{$session->agent->name}}</td>
                <td>{{$session->device->kind}}</td>
                <td>{{$session->device->platform}}/{{$session->device->platform_version}}</td>
                <td>{{$session->client_ip}}</td>
                <td>@if($session->device->is_mobile == 1) Có @else Không @endif </td>
                <td>{{$session->language->preference}}</td>
               <td class="three-line-paragraph">
                <div class="text-three-line">
                  @foreach ($session->log->reverse()->slice(-5) as $key => $log)
                    {{$log->path->path}} <br/>
                  @endforeach
                </div>
               </td>
               <td>{{$session->created_at->diffForHumans()}}</td>
               <td>{{$session->pageViews}}</td>
              </tr>
                @endforeach 
            </tbody>
        </table>
    </div>
</div>
@endsection