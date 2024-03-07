@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Thêm Gói VIP
                </div>
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{session('status')}}
                        </div>
                    @endif
                    @if(!isset($goivip))
                    {!! Form::open([
                        'method' => 'POST',
                        'route' =>['goivip.store'],
                    ]) !!}
                    @else 
                    {!! Form::open([
                        'method' => 'PUT',
                        'route' =>['goivip.update',$goivip->id],
                    ]) !!}
                    @endif

                        <div class="form-group">
                            {!! Form::label('name', 'Tên', []) !!}
                            {!! Form::text('name', isset($goivip) ? $goivip->name : '', ['class'=>'form-control','placeholder' => 'Nhập vào dữ liệu...', 'required'=>'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('price', 'Giá', []) !!}
                            {!! Form::text('price', isset($goivip) ? $goivip->price : '', ['class'=>'form-control','placeholder' => 'Nhập vào dữ liệu...', 'required'=>'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('duration', 'Thời hạn', []) !!}
                            {!! Form::text('duration', isset($goivip) ? $goivip->duration : '', ['class'=>'form-control','placeholder' => 'Nhập vào dữ liệu...', 'required'=>'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('status', 'Trạng thái', []) !!}
                            {!! Form::select('status', ['1'=>'Hiển thị', '0' => 'Không'], isset($goivip) ? $goivip->status : '', ['class'=>'form-control']) !!}
                        </div>
                       
                        
                    @if(!isset($goivip))
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