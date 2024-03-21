<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\YeuCau;
use App\Models\Chitiet_PQ;
use App\Models\Admin;
use App\Models\User;
use App\Models\Role;
use Carbon\Carbon;
use Mail;

class YeuCauController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //asc: số 0 đi đầu, desc: cuối đi đầu
        $list = YeuCau::where('status',0)->get();
        $list_role = Role::get();
        return view('admincp.admin.yeucau.index',compact('list','list_role'));
    }

    public function accept(Request $request){
        $data = $request->all();
        $admin = new Admin();
        $user = User::where('id', $data['user_id'])->first();
        
        $admin->name = $user->name;
        $admin->email = $user->email;
        $admin->password = $user->password;
        $admin->id_role = $data['role'];
        $admin->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $admin->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        

        $ct = new Chitiet_PQ();
        $user_admin = Auth::guard('admin')->user();
        $ct->id_admin= $user_admin->id;
        $ct->name_admin = $user_admin->name;
        $ct->id_nhanvien = $user->id;
        $ct->name_nhanvien = $user->name;
        $ct->email_nhanvien = $user->email;
        $ct->cv_nhanvien = $data['role'];
        $ct->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $ct->status = 0;

        $yc = YeuCau::where('user_id', $data['user_id'])->first();
        $yc->status = 1;

        $admin->save();
        $ct->save();
        $yc->save();
        //return $admin->id_role;
        $this->testEmail($admin->name, $admin->role->name, $admin->email);
        return redirect()->back();
    }

    
    public function testEmail($name, $role, $e){
        Mail::send('pages.email', compact('name', 'role'), function ($email) use ($e) {
            $email->to($e)->subject('Thư thông báo');
        });
        
    }

    public function deny(Request $request){
        $data = $request->all();
        $yc = YeuCau::where('user_id', $data['user_id'])->first();
        $yc->status = 2;
        $yc->update();
        return redirect()->back();
    }
}
