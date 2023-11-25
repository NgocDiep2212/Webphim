@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Quản lý link phim
                </div>
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{session('status')}}
                        </div>
                    @endif
                    @if(!isset($linkmovie))
                    {!! Form::open([
                        'method' => 'POST',
                        'route' =>['linkmovie.store'],
                    ]) !!}
                    @else 
                    {!! Form::open([
                        'method' => 'PUT',
                        'route' =>['linkmovie.update',$linkmovie->id],
                    ]) !!}
                    @endif

                        <div class="form-group">
                            {!! Form::label('title', 'Title', []) !!}
                            {!! Form::text('title', isset($linkmovie) ? $linkmovie->title : '', ['class'=>'form-control','placeholder' => 'Nhập vào dữ liệu...','required'=>'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Description', []) !!}
                            {!! Form::textarea('description', isset($linkmovie) ? $linkmovie->description : '', ['class'=>'form-control','placeholder' => 'Nhập vào dữ liệu...','id'=>'description', 'required'=>'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('action', 'Action', []) !!}
                            {!! Form::select('status', ['1'=>'Hiển thị', '0' => 'Không'], isset($linkmovie) ? $linkmovie->status : '', ['class'=>'form-control']) !!}
                        </div>
                    @if(!isset($linkmovie))
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