@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Quản lý Nhân Viên
                </div>
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{session('status')}}
                        </div>
                    @endif
                    @if(!isset($nhanvien))
                    {!! Form::open([
                        'method' => 'POST',
                        'route' =>['nhanvien.store'],
                    ]) !!}
                    @else 
                    {!! Form::open([
                        'method' => 'PUT',
                        'route' =>['nhanvien.update',$nhanvien->id],
                    ]) !!}
                    @endif

                        <div class="form-group">
                            {!! Form::label('name', 'Tên', []) !!}
                            {!! Form::text('name', isset($nhanvien) ? $nhanvien->name : '', ['class'=>'form-control','placeholder' => 'Nhập vào dữ liệu...', 'required'=>'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('email', 'Email', []) !!}
            {{-- <input id="email" type="email" class="form-control " name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> --}}

                            {!! Form::email('email', isset($nhanvien) ? $nhanvien->email : '', ['class'=>'form-control ','placeholder' => 'Nhập vào dữ liệu...', 'required'=>'required']) !!}
                        </div>
                        @if(!isset($nhanvien))
                            <div class="form-group">
                                {!! Form::label('password', 'Mật khẩu', []) !!}
                                {!! Form::text('password', isset($nhanvien) ? $nhanvien->password : '', ['class'=>'form-control','placeholder' => 'Nhập vào dữ liệu...', 'required'=>'required', 'pattern'=>"(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}", 'title'=>"Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"]) !!}
                                <div id="message">
                                    <h3>Password must contain the following:</h3>
                                    <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                                    <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                                    <p id="number" class="invalid">A <b>number</b></p>
                                    <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                                </div>
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="chucvu">Chức vụ:</label>
                                <select name="chucvu" id="chucvu" class="form-control" required>
                                    @if(!isset($nhanvien))
                                        {{-- <option value="{{$nhanvien->role['role']}}">{{$nhanvien->role['name']}}</option> --}}
                                        <option value="">Chọn chức vụ nhân viên</option>
                                    @endif
                                        @foreach($list_chucvu as $cv)
                                            <option 
                                                @if(isset($nhanvien) && $nhanvien['id_role'] == $cv['role']) selected 
                                                @endif 
                                                value="{{$cv['role']}}" >{{$cv['name']}}
                                            </option>
                                        @endforeach
                                    
                                </select>
                            </div>
                        
                    @if(!isset($nhanvien))
                        {!! Form::submit('Thêm dữ liệu', ['class'=>'btn btn-success']) !!}
                    @else
                        {!! Form::submit('Cập nhật', ['class'=>'btn btn-success']) !!}
                    @endif
                        {!! Form::close () !!}

                </div> 
            </div>
            

        </div>
    </div>
</div>
@endsection