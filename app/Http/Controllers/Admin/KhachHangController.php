<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Chitiet_PQ;
use App\Models\HoaDon;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;

class KhachHangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        //asc: số 0 đi đầu, desc: cuối đi đầu
        $c = Carbon::now()->format('Y-m-d');
        $list = User::orderBy('id','ASC')->get();
        return view('admincp.admin.khachhang.index',compact('list','c'));
    }

    public function khachvip()
    {
        $date_now = Carbon::now()->format('Y-m-d');
        $list = HoaDon::get();
        return view('admincp.admin.khachhang.khachvip',compact('list','date_now'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.admin.khachhang.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $khachhang = new User();
        $khachhang->name = $data['name'];
        $khachhang->email = $data['email'];
        $khachhang->password = bcrypt($data['password']);
        $khachhang->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $khachhang->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $exist = User::where('email', $khachhang->email)->where('status',1)->orderBy('id','ASC')->get();
        // Lấy ra cột id
        $ids = $exist->pluck('id');
        // Đếm số lượng bản ghi
        $count = count($ids);
        // Xử lý kết quả
        if ($count > 0) {
            // Email đã trùng
            echo "Email đã tồn tại. Vui lòng nhập lại.";
        } else {
            // Email chưa trùng
            // Lưu dữ liệu vào database
            $khachhang->save();
            return redirect()->route('khachhang.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $khachhang = User::find($id);
        $list_chucvu = Role::where('status',1)->orderBy('id','ASC')->get();
        return view('admincp.admin.khachhang.form',compact('list_chucvu','khachhang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $khachhang = User::find($id);
        $khachhang->name = $data['name'];
        $khachhang->email = $data['email'];
        $khachhang->status = $data['status'];
        $khachhang->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $exist = User::where('email', $khachhang->email)->where('status',1)->orderBy('id','ASC')->get();
        // Lấy ra cột id
        $ids = $exist->pluck('id');
        // Đếm số lượng bản ghi
        $count = count($ids);
        // Xử lý kết quả
        if ($count > 1) {
            // Email đã trùng
            echo "Email đã tồn tại. Vui lòng nhập lại.";
        } else {
            // Email chưa trùng
            // Lưu dữ liệu vào database
            $khachhang->save();

            //them vao chi tiet phan quyen
            return redirect()->route('khachhang.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $khachhang = User::find($id);
        $khachhang->status = 0;
        $khachhang->save();
        return redirect()->back();
    }
}
