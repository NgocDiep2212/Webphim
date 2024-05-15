@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Quản lý Khách Hàng
                </div>
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{session('status')}}
                        </div>
                    @endif
                    @if(!isset($khachhang))
                    {!! Form::open([
                        'method' => 'POST',
                        'route' =>['khachhang.store'],
                    ]) !!}
                    @else 
                    {!! Form::open([
                        'method' => 'PUT',
                        'route' =>['khachhang.update',$khachhang->id],
                    ]) !!}
                    @endif

                        <div class="form-group">
                            {!! Form::label('name', 'Tên', []) !!}
                            {!! Form::text('name', isset($khachhang) ? $khachhang->name : '', ['class'=>'form-control','placeholder' => 'Nhập vào dữ liệu...', 'required'=>'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('email', 'Email', []) !!}
            {{-- <input id="email" type="email" class="form-control " name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> --}}

                            {!! Form::email('email', isset($khachhang) ? $khachhang->email : '', ['class'=>'form-control ','placeholder' => 'Nhập vào dữ liệu...', 'required'=>'required']) !!}
                        </div>
                        @if(!isset($khachhang))
                            <div class="form-group">
                                {!! Form::label('password', 'Mật khẩu', []) !!}
                                {!! Form::text('password', isset($khachhang) ? $khachhang->password : '', ['class'=>'form-control','placeholder' => 'Nhập vào dữ liệu...', 'required'=>'required', 'pattern'=>"(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}", 'title'=>"Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"]) !!}
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
                                {!! Form::label('Status', 'Status', []) !!}
                                {!! Form::select('status', ['1'=>'Hiển thị', '0' => 'Không'], isset($khachhang) ? $khachhang->status : '', ['class'=>'form-control']) !!}
                            </div>
                    @if(!isset($khachhang))
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