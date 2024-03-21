@extends('layouts.ad_add')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <a href="{{route('movie.index')}}" class="btn btn-primary">Liệt kê phim</a>
                <div class="card-header">
                    Quản lý phim
                </div>
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{session('status')}}
                        </div>
                    @endif
                    @if(!isset($movie))
                    {!! Form::open([
                        'method' => 'POST',
                        'route' =>['movie.store'],
                        'enctype' => 'multipart/form-data'
                    ]) !!}
                    @else 
                    {!! Form::open([
                        'method' => 'PUT',
                        'route' =>['movie.update',$movie->id],
                        'enctype' => 'multipart/form-data'
                    ]) !!}
                    @endif

                        <div class="form-group">
                            {!! Form::label('title', 'Title', []) !!}
                            {!! Form::text('title', isset($movie) ? $movie->title : '', ['class'=>'form-control','placeholder' => 'Nhập vào dữ liệu...','id'=>'slug', 'onkeyup' => 'ChangeToSlug()', 'required'=>'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('sotap', 'Số tập phim', []) !!}
                            {!! Form::text('sotap', isset($movie) ? $movie->sotap : '', ['class'=>'form-control','placeholder' => 'Nhập vào dữ liệu...', 'required'=>'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('duration', 'Thời lượng phim', []) !!}
                            {!! Form::text('duration', isset($movie) ? $movie->duration : '', ['class'=>'form-control','placeholder' => 'Nhập vào dữ liệu...', 'required'=>'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Trailer', 'Trailer', []) !!}
                            {!! Form::text('trailer', isset($movie) ? $movie->trailer : '', ['class'=>'form-control','placeholder' => 'Nhập vào dữ liệu...']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Tên tiếng Anh', 'Tên tiếng Anh', []) !!}
                            {!! Form::text('name_eng', isset($movie) ? $movie->name_eng : '',['class'=>'form-control','placeholder' => 'Nhập vào dữ liệu...', 'required'=>'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('year', 'Năm sản xuất', []) !!}
                            {!! Form::selectYear('year', 2023,2000,isset($movie->year) ? $movie->year : '',['class' => 'form-control',  'placeholder'=>"--Năm phim--"]) !!}

                        </div>
                        <div class="form-group">
                            {!! Form::label('slug', 'Slug', []) !!}
                            {!! Form::text('slug', isset($movie) ? $movie->slug : '', ['class'=>'form-control','placeholder' => 'Nhập vào dữ liệu...','id'=>'convert_slug', 'required'=>'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('resolution', 'Định dạng', []) !!}
                            {!! Form::select('resolution', ['0' => 'HD','1'=>'SD', '2' => 'HDCam','3' => 'Cam', '4' => 'FullHD','5' => 'Trailer'], isset($movie) ? $movie->resolution : '', ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('vietsub', 'Phụ đề', []) !!}
                            {!! Form::select('vietsub', ['0' => 'Phụ đề','1'=>'Thuyết minh'], isset($movie) ? $movie->vietsub : '', ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Mô tả phim', []) !!}
                            {!! Form::textarea('description', isset($movie) ? $movie->description : '', ['class'=>'form-control','placeholder' => 'Nhập vào dữ liệu...','id'=>'description', 'required'=>'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('actors', 'Diễn viên', []) !!}
                            {!! Form::textarea('actors', isset($movie) ? $movie->actors : '',['class'=>'form-control','placeholder' => 'Nhập vào dữ liệu...', 'required'=>'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('tags', 'Từ khóa phim', []) !!}
                            {!! Form::textarea('tags', isset($movie) ? $movie->tags : '', ['class'=>'form-control','placeholder' => 'Nhập vào dữ liệu...', 'required'=>'required']) !!}
                        </div>
                        
                        <div class="form-group">
                            {!! Form::label('country', 'Quốc gia', []) !!}
                            {!! Form::select('country_id', $country, isset($movie) ? $movie->country_id : '', ['class'=>'form-control', 'required'=>'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('thuocphim', 'Thuộc phim:', []) !!}
                            {!! Form::select('thuocphim', ['phimle' => 'Phim lẻ','phimbo'=>'Phim bộ'], isset($movie) ? $movie->thuocphim : '', ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('genre', 'Thể loại', []) !!} <br>
                            {{-- {!! Form::select('genre_id', $genre, isset($movie) ? $movie->genre_id : '', ['class'=>'form-control']) !!} --}}
                            @foreach($list_genre as $key => $gen)
                                @if(isset($movie))
                            {!! Form::checkbox('genre[]', $gen->id,isset($movie_genre) && $movie_genre->contains($gen->id) ? true : false) !!}
                                @else
                            {!! Form::checkbox('genre[]', $gen->id, '') !!}
                                @endif
                            {!! Form::label('genre', $gen->title) !!}
                            @endforeach
                        </div>
                        <div class="form-group">
                            {!! Form::label('category', 'Danh mục', []) !!} <br>
                            {{-- {!! Form::select('category_id', $category, isset($movie) ? $movie->category_id : '', ['class'=>'form-control']) !!} --}}
                            @foreach($list_category as $key => $gen)
                                @if(isset($movie))
                            {!! Form::checkbox('category[]', $gen->id,isset($movie_category) && $movie_category->contains($gen->id) ? true : false) !!}
                                @else
                            {!! Form::checkbox('category[]', $gen->id, '') !!}
                                @endif
                            {!! Form::label('category', $gen->title) !!}
                            @endforeach
                        </div>
                        <div class="form-group">
                            {!! Form::label('Hot', 'Hot', []) !!}
                            {!! Form::select('phim_hot', ['1'=>'Có', '0' => 'Không'], isset($movie) ? $movie->phim_hot : '', ['class'=>'form-control']) !!}
                        </div>
                        {{-- <div class="form-group">
                            {!! Form::label('image', 'Image', []) !!}
                            {!! Form::text('image', isset($movie) ? $movie->image : '',['class'=>'form-control','placeholder' => 'Nhập vào dữ liệu...', 'required'=>'required']) !!}
                            
                        </div>
                       --}}
                       <div class="form-group">
                        {!! Form::label('image', 'Image', []) !!}
                        {!! Form::file('image',['class'=>'form-control-file']) !!}
                        @if(isset($movie))
                            <img width="20%" src="{{asset('uploads/movie/'.$movie->image)}}" alt="">
                        @endif
                    </div>
                        <div class="form-group">
                            {!! Form::label('status', 'Trạng thái', []) !!}
                            {!! Form::select('status', ['1'=>'Hiển thị', '0' => 'Không'], isset($movie) ? $movie->status : '', ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('vip', 'VIP', []) !!}
                            {!! Form::select('vip', ['0' => 'Không','1'=>'VIP'], isset($movie) ? $movie->vip : '', ['class'=>'form-control']) !!}
                        </div>
                    @if(!isset($movie))
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