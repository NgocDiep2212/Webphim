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
                    @if(!isset($country_form))
                    {!! Form::open([
                        'method' => 'POST',
                        'route' =>['country.store'],
                    ]) !!}
                    @else 
                    {!! Form::open([
                        'method' => 'PUT',
                        'route' =>['country.update',$country_form->id],
                    ]) !!}
                    @endif

                        <div class="form-group">
                            {!! Form::label('title', 'Title', []) !!}
                            {!! Form::text('title', isset($country_form) ? $country_form->title : '', ['class'=>'form-control','placeholder' => 'Nhập vào dữ liệu...','id'=>'slug', 'onkeyup' => 'ChangeToSlug()', 'required'=>'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('slug', 'Slug', []) !!}
                            {!! Form::text('slug', isset($country_form) ? $country_form->slug : '', ['class'=>'form-control','placeholder' => 'Nhập vào dữ liệu...','id'=>'convert_slug', 'required'=>'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Description', []) !!}
                            {!! Form::textarea('description', isset($country_form) ? $country_form->description : '', ['class'=>'form-control','placeholder' => 'Nhập vào dữ liệu...','id'=>'description', 'required'=>'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Action', 'Action', []) !!}
                            {!! Form::select('status', ['1'=>'Hiển thị', '0' => 'Không'], isset($country_form) ? $country_form->status : '', ['class'=>'form-control']) !!}
                        </div>
                    @if(!isset($country_form))
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