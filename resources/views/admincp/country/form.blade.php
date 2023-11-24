@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Quản lý phim thuộc quốc gia
                </div>
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{session('status')}}
                        </div>
                    @endif
                    @if(!isset($country))
                    {!! Form::open([
                        'method' => 'POST',
                        'route' =>['country.store'],
                    ]) !!}
                    @else 
                    {!! Form::open([
                        'method' => 'PUT',
                        'route' =>['country.update',$country->id],
                    ]) !!}
                    @endif

                        <div class="form-group">
                            {!! Form::label('title', 'Title', []) !!}
                            {!! Form::text('title', isset($country) ? $country->title : '', ['class'=>'form-control','placeholder' => 'Nhập vào dữ liệu...','id'=>'slug', 'onkeyup' => 'ChangeToSlug()', 'required'=>'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('slug', 'Slug', []) !!}
                            {!! Form::text('slug', isset($category) ? $category->slug : '', ['class'=>'form-control','placeholder' => 'Nhập vào dữ liệu...','id'=>'convert_slug', 'required'=>'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Description', []) !!}
                            {!! Form::textarea('description', isset($country) ? $country->description : '', ['class'=>'form-control','placeholder' => 'Nhập vào dữ liệu...','id'=>'description', 'required'=>'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Action', 'Action', []) !!}
                            {!! Form::select('status', ['1'=>'Hiển thị', '0' => 'Không'], isset($country) ? $country->status : '', ['class'=>'form-control']) !!}
                        </div>
                    @if(!isset($country))
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