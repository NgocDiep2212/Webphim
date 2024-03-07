<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Role;
use App\Models\Chitiet_PQ;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;

class NhanVienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function lichsu(){
        $list = Chitiet_PQ::orderBy('id','DESC')->get();
        return view('admincp.admin.nhanvien.lichsu',compact('list'));
    }

    public function xoa_nv(){
        $list = Chitiet_PQ::where('status',2)->orderBy('id','DESC')->get()->unique('id_nhanvien');
        return view('admincp.admin.nhanvien.xoa_nv',compact('list'));
    }

    public function khoiphuc_nv($id){
        $nhanvien = Admin::find($id);
        $nhanvien->status = 1;
        $nhanvien->save();

        //them vao chi tiet phan quyen
        $ct = new chitiet_PQ();
        $ct->id_nhanvien = $id;
        $ct->cv_nhanvien = $nhanvien->id_role;
        $ct->name_nhanvien = $nhanvien->name;
        $ct->email_nhanvien = $nhanvien->email;
        $user = Auth::guard('admin')->user();
        $ct->id_admin = $user->id;
        $ct->name_admin = $user->name;
        $ct->status = 3;
        $ct->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $ct->save();
        return redirect()->back();
    }

    public function index()
    {
        //asc: số 0 đi đầu, desc: cuối đi đầu
        $list = Admin::where('status', 1)->orderBy('id','ASC')->get();
        return view('admincp.admin.nhanvien.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_chucvu = Role::where('status', 1)->orderBy('id','ASC')->get();
        return view('admincp.admin.nhanvien.form',compact('list_chucvu'));
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
        $nhanvien = new Admin();
        $nhanvien->name = $data['name'];
        $nhanvien->email = $data['email'];
        $nhanvien->id_role = $data['chucvu'];
        $nhanvien->password = bcrypt($data['password']);
        $nhanvien->status = 1;
        $nhanvien->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $nhanvien->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $exist = Admin::where('email', $nhanvien->email)->where('status',1)->orderBy('id','ASC')->get();
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
            $nhanvien->save();

            //them vao chi tiet phan quyen
            $id_nv = DB::connection()->getPdo()->lastInsertId();
            $ct = new chitiet_PQ();
            $user = Auth::guard('admin')->user();
            $ct->id_nhanvien = $id_nv;
            $ct->name_nhanvien = $nhanvien->name;
            $ct->cv_nhanvien = $nhanvien->id_role;
            $ct->email_nhanvien = $nhanvien->email;
            $ct->id_admin = $user->id;
            $ct->name_admin = $user->name;
            $ct->status = 0;
            $ct->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $ct->save();
            return redirect()->route('nhanvien.index');
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
        $nhanvien = Admin::find($id);
        $list_chucvu = Role::where('status',1)->orderBy('id','ASC')->get();
        return view('admincp.admin.nhanvien.form',compact('list_chucvu','nhanvien'));
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
        $nhanvien = Admin::find($id);
        $nhanvien->name = $data['name'];
        $nhanvien->email = $data['email'];
        $nhanvien->id_role = $data['chucvu'];
        $nhanvien->status = 1;
        $nhanvien->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $exist = Admin::where('email', $nhanvien->email)->where('status',1)->orderBy('id','ASC')->get();
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
            $nhanvien->save();

            //them vao chi tiet phan quyen
            $ct = new chitiet_PQ();
            $ct->id_nhanvien = $id;
            $ct->cv_nhanvien = $nhanvien->id_role;
            $ct->name_nhanvien = $nhanvien->name;
            $ct->email_nhanvien = $nhanvien->email;
            $user = Auth::guard('admin')->user();
            $ct->id_admin = $user->id;
            $ct->name_admin = $user->name;
            $ct->status = 1;
            $ct->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $ct->save();
            return redirect()->route('nhanvien.index');
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
        $nhanvien = Admin::find($id);
        $nhanvien->status = 0;
        $nhanvien->save();
        $ct = new chitiet_PQ();
        $ct->id_nhanvien = $id;
        $ct->cv_nhanvien = $nhanvien->id_role;
        $ct->name_nhanvien = $nhanvien->name;
        $ct->email_nhanvien = $nhanvien->email;
        $user = Auth::guard('admin')->user();
        $ct->id_admin = $user->id;
        $ct->name_admin = $user->name;
        $ct->status = 2;
        $ct->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $ct->save();
        return redirect()->back();
    }
}
