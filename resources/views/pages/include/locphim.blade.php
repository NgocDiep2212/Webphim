
<form action="{{route('locphim')}}" method="GET">
    <style>
       .stylish_filter{
          border: 0;
          background: #12171b;
          color: #fff;
       }
       .btn-filter{
          border: 0 #b2b7bb;
          background: #12171b;
          color: #fff;
          padding: 9px;
       }
    </style>
    <div class="col-md-2">
       <div class="form-group">
          <select class="form-control stylish_filter" name="order" id="exampleFormControlSelect1">
            <option value="">Sắp xếp</option>
            <option value="date">Ngày đăng</option>
            <option value="year_release">Năm sản xuất</option>
            <option value="name_a_z">Tên phim</option>
            <option value="watch_view">Lượt xem</option>
          </select>
        </div>
    </div>
    <div class="col-md-2">
       <div class="form-group">
          <select class="form-control stylish_filter" name="genre" id="exampleFormControlSelect1">
             <option value="">--Thể loại--</option>
             @foreach ($genre as $key => $gen_filter)
             <option {{ (isset($_GET['genre']) && $_GET['genre'] == $gen_filter->id) ? 'selected' : '' }} value="{{$gen_filter->id}}">{{$gen_filter->title}}</option>
            @endforeach
          </select>
        </div>
    </div>
    <div class="col-md-2">
       <div class="form-group">
          <select class="form-control stylish_filter" name="country" id="exampleFormControlSelect1">
             <option value="">--Quốc gia--</option>
             @foreach ($country as $key => $con_filter)
             <option {{ (isset($_GET['country']) && $_GET['country'] == $con_filter->id) ? 'selected' : '' }}  value="{{$con_filter->id}}">{{$con_filter->title}}</option>
            @endforeach
          </select>
        </div>
    </div>
    <div class="col-md-3">
       <div class="form-group">
           @php 
               if(isset($_GET['year_locphim'])){
                $year = $_GET['year_locphim'];
               }else{
                $year = null;
               }
           @endphp
          
          {!! Form::selectYear('year_locphim', 2010,2023,$year,['class' => 'form-control stylish_filter','placeholder' => '--Năm Phim--']) !!}
          
        </div>
    </div>
    
    <input type="submit" value="Lọc phim" class="btn btn-sm btn-filter">
 </form>