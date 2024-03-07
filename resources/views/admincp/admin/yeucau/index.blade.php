@extends('layouts.app')

@section('content')
<table class="table" id="tablephim">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Tên</th>
        <th scope="col">Email</th>
        <th scope="col">Tạo vào lúc</th>
        <th scope="col">Trạng thái</th>
        <th scope="col">Manage</th>
      </tr>
    </thead>
    <tbody class="order_position">
        @foreach($list as $key => $cate)
      <tr id="{{$cate->id}}">
        <th scope="row">{{$key}}</th>
        <td>{{$cate->user->name}}</td>
        <td>{{$cate->user->email}}</td>
        <td>{{$cate->created_at}}</td>
        <td>
          @if($cate->status == 0)
            Chưa duyệt
          @elseif($cate->status == 1) Đã duyệt
          @else Đã từ chối
          @endif
        </td>
        <td>
            <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Chấp nhận</button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chọn chức vụ của nhân viên</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="{{route('yeucau-accept')}}" method="post">
                      @csrf
                      <input type="text" name="user_id" value="{{$cate->user_id}}" hidden>
                      <select name="role_id">
                        <option value="">-------Chọn một chức vụ-------</option>
                          @foreach($list_role as $key => $role) 
                          <option value="{{$role->id}}">{{$role->name}}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <form action="{{route('yeucau-deny')}}" method="post">
              @csrf
              <input type="text" name="user_id" value="{{$cate->user_id}}" hidden>
              <button type="submit" class="btn btn-danger">Loại bỏ</button>
            </form>
        </td>
      </tr>
        @endforeach 
    </tbody>
  </table>
@endsection