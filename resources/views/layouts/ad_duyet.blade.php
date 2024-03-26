
<!DOCTYPE html>
<html>
  <head>
    <title>
      Admin Web Phim
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta
      name="keywords"
      content="Admin Web Phim"
    />
    <script type="application/x-javascript">
      addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);

                      function hideURLbar() { window.scrollTo(0, 1); }
    </script>
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('backends/css/bootstrap.css')}}" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link href="{{asset('backends/css/style.css')}}" rel="stylesheet" type="text/css" />
    <!-- font-awesome icons CSS -->
    <link href="{{asset('backends/css/font-awesome.css')}}" rel="stylesheet" />
    <!-- //font-awesome icons CSS-->
    <!-- side nav css file -->
    <link
      href="{{asset('backends/css/SidebarNav.min.css')}}"
      media="all"
      rel="stylesheet"
      type="text/css"
    />
    {{-- datatables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
     
      <link rel='dns-prefetch' href='//s.w.org' />
      
      
      <link rel='stylesheet' id='style-css' href='{{asset('css/style.css?ver=5.7.2')}}' media='all' />
      <style type="text/css" id="wp-custom-css">
         .textwidget p a img {
         width: 100%;
         }
      </style>
    
    <!-- //side nav css file -->
    <!-- js-->
    <script src="{{asset('backends/js/jquery-1.11.1.min.js')}}"></script>
    <script src="{{asset('backends/js/modernizr.custom.js')}}"></script>
    <!--webfonts-->
    <link
      href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext"
      rel="stylesheet"
    />
    <!--//webfonts-->
    <!-- chart -->
    <script src="{{asset('backends/js/Chart.js')}}"></script>
    <!-- //chart -->
    <!-- Metis Menu -->
    <script src="{{asset('backends/js/metisMenu.min.js')}}"></script>
    <script src="{{asset('backends/js/custom.js')}}"></script>
    <link href="{{asset('backends/css/custom.css')}}" rel="stylesheet" />
    
  </head>

  <body class="cbp-spmenu-push">
    {{-- Kiem tra co dang dang nhap khong --}}
    @if(Auth::check())
    <div class="main-content">
      <div
        class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left"
        id="cbp-spmenu-s1"
      >
        <!--left-fixed -navigation-->
        <aside class="sidebar-left">
          <nav class="navbar navbar-inverse">
            <div class="navbar-header">
              <button
                type="button"
                class="navbar-toggle collapsed"
                data-toggle="collapse"
                data-target=".collapse"
                aria-expanded="false"
              >
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <h1>
                <a class="navbar-brand" href="{{url('/home')}}"
                  ><span class="fa fa-area-chart"></span> QUẢN LÝ <span
                    class="dashboard_text"
                    >Web Phim</span
                  ></a
                >
              </h1>
            </div>
            <div
              class="collapse navbar-collapse"
              id="bs-example-navbar-collapse-1"
            >
              <ul class="sidebar-menu">
                <li class="header">Quản lý webphim</li>
                <li class="treeview">
                  <a href="{{url('/home')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                  </a>
                </li>
                @php
                  //127.0.0.1:8000/segment1/segment2/.../segmentn
                  $segment = Request::segment(2);
                @endphp

                
                
              </ul>
            </div>
            <!-- /.navbar-collapse -->
          </nav>
        </aside>
      </div>
      <!--left-fixed -navigation-->
      <!-- header-starts -->
      <div class="sticky-header header-section">
        <div class="header-left">
          <!--toggle button start-->
          <button id="showLeftPush"><i class="fa fa-bars"></i></button>
          <!--toggle button end-->
          <div class="profile_details_left">
            <!--notifications of menu start -->
            <ul class="nofitications-dropdown">
              <li class="dropdown head-dpdn">
                <a
                  href="#"
                  class="dropdown-toggle"
                  data-toggle="dropdown"
                  aria-expanded="false"
                  ><i class="fa fa-envelope"></i><span class="badge">4</span></a
                >
                <ul class="dropdown-menu">
                  <li>
                    <div class="notification_header">
                      <h3>You have 3 new messages</h3>
                    </div>
                  </li>
                  <li>
                    <a href="#">
                      <div class="user_img">
                        <img src="images/1.jpg" alt="" />
                      </div>
                      <div class="notification_desc">
                        <p>Lorem ipsum dolor amet</p>
                        <p><span>1 hour ago</span></p>
                      </div>
                      <div class="clearfix"></div>
                    </a>
                  </li>
                  <li class="odd">
                    <a href="#">
                      <div class="user_img">
                        <img src="images/4.jpg" alt="" />
                      </div>
                      <div class="notification_desc">
                        <p>Lorem ipsum dolor amet</p>
                        <p><span>1 hour ago</span></p>
                      </div>
                      <div class="clearfix"></div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="user_img">
                        <img src="images/3.jpg" alt="" />
                      </div>
                      <div class="notification_desc">
                        <p>Lorem ipsum dolor amet</p>
                        <p><span>1 hour ago</span></p>
                      </div>
                      <div class="clearfix"></div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="user_img">
                        <img src="images/2.jpg" alt="" />
                      </div>
                      <div class="notification_desc">
                        <p>Lorem ipsum dolor amet</p>
                        <p><span>1 hour ago</span></p>
                      </div>
                      <div class="clearfix"></div>
                    </a>
                  </li>
                  <li>
                    <div class="notification_bottom">
                      <a href="#">See all messages</a>
                    </div>
                  </li>
                </ul>
              </li>
              <li class="dropdown head-dpdn">
                <a
                  href="#"
                  class="dropdown-toggle"
                  data-toggle="dropdown"
                  aria-expanded="false"
                  ><i class="fa fa-bell"></i
                  ><span class="badge blue">4</span></a
                >
                <ul class="dropdown-menu">
                  <li>
                    <div class="notification_header">
                      <h3>You have 3 new notification</h3>
                    </div>
                  </li>
                  <li>
                    <a href="#">
                      <div class="user_img">
                        <img src="images/4.jpg" alt="" />
                      </div>
                      <div class="notification_desc">
                        <p>Lorem ipsum dolor amet</p>
                        <p><span>1 hour ago</span></p>
                      </div>
                      <div class="clearfix"></div>
                    </a>
                  </li>
                  <li class="odd">
                    <a href="#">
                      <div class="user_img">
                        <img src="images/1.jpg" alt="" />
                      </div>
                      <div class="notification_desc">
                        <p>Lorem ipsum dolor amet</p>
                        <p><span>1 hour ago</span></p>
                      </div>
                      <div class="clearfix"></div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="user_img">
                        <img src="images/3.jpg" alt="" />
                      </div>
                      <div class="notification_desc">
                        <p>Lorem ipsum dolor amet</p>
                        <p><span>1 hour ago</span></p>
                      </div>
                      <div class="clearfix"></div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="user_img">
                        <img src="images/2.jpg" alt="" />
                      </div>
                      <div class="notification_desc">
                        <p>Lorem ipsum dolor amet</p>
                        <p><span>1 hour ago</span></p>
                      </div>
                      <div class="clearfix"></div>
                    </a>
                  </li>
                  <li>
                    <div class="notification_bottom">
                      <a href="#">See all notifications</a>
                    </div>
                  </li>
                </ul>
              </li>
              <li class="dropdown head-dpdn">
                <a
                  href="#"
                  class="dropdown-toggle"
                  data-toggle="dropdown"
                  aria-expanded="false"
                  ><i class="fa fa-tasks"></i
                  ><span class="badge blue1">8</span></a
                >
                <ul class="dropdown-menu">
                  <li>
                    <div class="notification_header">
                      <h3>You have 8 pending task</h3>
                    </div>
                  </li>
                  <li>
                    <a href="#">
                      <div class="task-info">
                        <span class="task-desc">Database update</span
                        ><span class="percentage">40%</span>
                        <div class="clearfix"></div>
                      </div>
                      <div class="progress progress-striped active">
                        <div class="bar yellow" style="width: 40%"></div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="task-info">
                        <span class="task-desc">Dashboard done</span
                        ><span class="percentage">90%</span>
                        <div class="clearfix"></div>
                      </div>
                      <div class="progress progress-striped active">
                        <div class="bar green" style="width: 90%"></div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="task-info">
                        <span class="task-desc">Mobile App</span
                        ><span class="percentage">33%</span>
                        <div class="clearfix"></div>
                      </div>
                      <div class="progress progress-striped active">
                        <div class="bar red" style="width: 33%"></div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="task-info">
                        <span class="task-desc">Issues fixed</span
                        ><span class="percentage">80%</span>
                        <div class="clearfix"></div>
                      </div>
                      <div class="progress progress-striped active">
                        <div class="bar blue" style="width: 80%"></div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <div class="notification_bottom">
                      <a href="#">See all pending tasks</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <!--notification menu end -->
          <div class="clearfix"></div>
        </div>
        <div class="header-right">
          <!--search-box-->
          <div class="search-box">
            <form class="input">
              <input
                class="sb-search-input input__field--madoka"
                placeholder="Search..."
                type="search"
                id="input-31"
              />
              <label class="input__label" for="input-31">
                <svg
                  class="graphic"
                  width="100%"
                  height="100%"
                  viewBox="0 0 404 77"
                  preserveAspectRatio="none"
                >
                  <path d="m0,0l404,0l0,77l-404,0l0,-77z" />
                </svg>
              </label>
            </form>
          </div>
          <!--//end-search-box-->
          <div class="profile_details">
            <ul>
              <li class="dropdown profile_details_drop">
                <a
                  href="#"
                  class="dropdown-toggle"
                  data-toggle="dropdown"
                  aria-expanded="false"
                >
                  <div class="profile_img">
                    <span class="prfil-img"
                      ><img src="images/2.jpg" alt="" />
                    </span>
                    <div class="user-name">
                      @php $user = Auth::guard('admin')->user(); 
                        echo '<p>'.$user->name.'</p>
                        <span>'.$user->role['name'].'</span>';
                      @endphp
                    </div>
                    <i class="fa fa-angle-down lnr"></i>
                    <i class="fa fa-angle-up lnr"></i>
                    <div class="clearfix"></div>
                  </div>
                </a>
                <ul class="dropdown-menu drp-mnu">
                  <li>
                    <a href="#"><i class="fa fa-cog"></i> Settings</a>
                  </li>
                  <li>
                    <a href="#"><i class="fa fa-user"></i> My Account</a>
                  </li>
                  <li>
                    <a href="#"><i class="fa fa-suitcase"></i> Profile</a>
                  </li>
                  <li>
                    {{-- <a href="#"><i class="fa fa-sign-out"></i> Logout</a> --}}
                    <form action="{{route('logout')}}" method="post">
                      @csrf
                      <i class="fa fa-sign-out"></i><input type="submit" class="btn btn-danger btn-sm" value="Logout"/>
                    </form>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
      </div>
      <!-- //header-ends -->
      <!-- main content start-->
      <div id="page-wrapper">
        <div class="main-page">
          <div class="col_4">
            <div class="col-md-3 widget widget1">
              <div class="r3_counter_box">
                <i class="fa fa-folder-open pull-left icon-rounded"></i>
                <div class="stats">
                  <h5><strong>{{$category_total}}</strong></h5>
                  <span>Danh mục</span>
                </div>
              </div>
            </div>
            <div class="col-md-3 widget widget1">
              <div class="r3_counter_box">
                <i class="fa fa-folder-o user1 pull-left icon-rounded"></i>
                <div class="stats">
                  <h5><strong>{{$genre_total}}</strong></h5>
                  <span>Thể loại</span>
                </div>
              </div>
            </div>
            <div class="col-md-3 widget widget1">
              <div class="r3_counter_box">
                <i class="pull-left fa fa-globe user2 icon-rounded"></i>
                <div class="stats">
                  <h5><strong>{{$country_total}}</strong></h5>
                  <span>Quốc gia</span>
                </div>
              </div>
            </div>
            <div class="col-md-3 widget widget1">
              <div class="r3_counter_box">
                <i class="pull-left fa fa-film dollar1 icon-rounded"></i>
                <div class="stats">
                  <h5><strong>{{$movie_total}}</strong></h5>
                  <span>Phim</span>
                </div>
              </div>
            </div>
            {{-- <div class="col-md-3 widget">
              <div class="r3_counter_box">
                <i class="pull-left fa fa-users dollar2 icon-rounded"></i>
                <div class="stats">
                  <span>Dang online: {{\Tracker::onlineUsers()->count()}}<br/></span>
                  <span>Total Users truy cap: {{$total_users}}<br/></span>
                  <span>Total Users truy cap tuan: {{$total_users_week}}<br/></span>
                  <span>1 thang: {{$total_users_month}}<br/></span>
                  <span>3 thang: {{$total_users_3months}}<br/></span>
                  <span>1 nam: {{$total_users_year}}<br/></span>
                </div>
              </div>
            </div> --}}
            <div class="clearfix"></div>
          </div>
          <div class="row-one widgettable">
           
          </div>

          {{-- main content --}}
          <div class="container-fluild" style="box-sizing: unset; overflow-x: auto;">
            @yield('content')
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
      <!--footer-->
      <div class="footer">
        <p>
          &copy; 2018 Glance Design Dashboard. All Rights Reserved | Design by
          <a href="https://w3layouts.com/" target="_blank">w3layouts</a>
        </p>
      </div>
      <!--//footer-->
    </div>
    @else
    @yield('content_login')
    @endif
    <!-- new added graphs chart js-->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script>
      $(document).ready(function(){
        $('#tablephim').DataTable();
      });
    </script>
   
    <script src="{{asset('backends/js/jquery.nicescroll.js')}}"></script>
    <script src="{{asset('backends/js/scripts.js')}}"></script>
    <!--//scrolling js-->
    <!-- side nav js -->
    <script src="{{asset('backends/js/SidebarNav.min.js')}}" type="text/javascript"></script>
    <script>
      $('.sidebar-menu').SidebarNav();
    </script>
    
    <script src="{{asset('backends/js/bootstrap.js')}}"></script>
    <!-- //Bootstrap Core JavaScript -->
    <script type="text/javascript">
      $('.select-year').change(function(){
          var year = $(this).find(':selected').val();
          var id_phim = $(this).attr('id');
          $.ajax({
              url:"{{url('/update-year-phim')}}",
              method:"GET",
              data:{year:year,id_phim:id_phim},
              success:function(){
                  alert('Thay đổi năm phim '+year+' thành công!');
              }
          });
      })
  </script>
  <script type="text/javascript">
      $('.select-season').change(function(){
          var season = $(this).find(':selected').val();
          var id_phim = $(this).attr('id');
          $.ajax({
              url:"{{url('/update-season-phim')}}",
              method:"GET",
              data:{season:season,id_phim:id_phim},
              success:function(){
                  alert('Thay đổi thành season '+season+' thành công!');
              }
          });
      })
  </script>
  <script type="text/javascript">
      $('.select-topview').change(function(){
          var topview = $(this).find(':selected').val();
          var id_phim = $(this).attr('id');
          if(topview == 1){
              var text = 'Ngày';
          }else if(topview == 2){
              var text = 'Tuần';
          }else if(topview == 3){
              var text = 'Tháng';
          }
          $.ajax({
              url:"{{url('/update-topview-phim')}}",
              method:"GET",
              data:{topview:topview,id_phim:id_phim},
              success:function(){
                  alert('Thay đổi phim theo topview '+text+' thành công!');
              }
          });
      })
  </script>
  <script type="text/javascript">
      $(document).ready(function (){
          let table = new DataTable('#tablephim');
      });
      function ChangeToSlug()
          {
  
              var slug;
           
              //Lấy text từ thẻ input title 
              slug = document.getElementById("slug").value;
              slug = slug.toLowerCase();
              //Đổi ký tự có dấu thành không dấu
                  slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                  slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                  slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                  slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                  slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                  slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                  slug = slug.replace(/đ/gi, 'd');
                  //Xóa các ký tự đặt biệt
                  slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                  //Đổi khoảng trắng thành ký tự gạch ngang
                  slug = slug.replace(/ /gi, "-");
                  //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                  //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                  slug = slug.replace(/\-\-\-\-\-/gi, '-');
                  slug = slug.replace(/\-\-\-\-/gi, '-');
                  slug = slug.replace(/\-\-\-/gi, '-');
                  slug = slug.replace(/\-\-/gi, '-');
                  //Xóa các ký tự gạch ngang ở đầu và cuối
                  slug = '@' + slug + '@';
                  slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                  //In slug ra textbox có id “slug”
              document.getElementById('convert_slug').value = slug;
          }
  
      </script>
      <script type="text/javascript">
          $('.order_position').sortable({
              placeholder: 'ui-state-highlight',
              update: function(event,ui){
                  var array_id = [];
                  $('.order_position tr').each(function(){
                      array_id.push($(this).attr('id'));
                  })
                  $.ajax({
                      headers:{ //lay token, dinh danh du lieu 
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      url: "{{route('resorting')}}",
                      method:"POST",
                      data:{array_id:array_id},
                      success: function(data){
                          alert('Sắp xếp thứ tự thành công');
                      }
                  })
              }
          })    
      </script>

      {{-- chon tap phim trong them tap phim --}}
      <script type="text/javascript">
          $('.select-movie').change(function(){
              var id = $(this).val();
              $.ajax({
                      url: "{{route('select-movie')}}",
                      method:"GET",
                      data:{id:id},
                      success: function(data){
                          $('#show_movie').html(data);
                      }
                  })
          })
      </script>
  </body>
</html>
