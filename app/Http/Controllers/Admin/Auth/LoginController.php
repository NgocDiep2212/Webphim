<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if ($request->getMethod() == 'GET') {
            return view('admincp.auth.login');
        }
    
        $credentials = $request->only(['email', 'password']);
        if (Auth::guard('admin')->attempt($credentials)) {
            $user = Auth::guard('admin')->user();
            $role = Role::where('role',$user->id_role)->where('status', 1)->first();
            //echo (int)$role['id'];
            if(isset($role['role']) && $user->status == 1){
                if ((int)$role['role'] == 0) {
                    return redirect()->route('dashboard');
                } elseif ((int)$role['role'] == 1) {
                    return redirect()->route('addHomepage');
                } elseif ((int)$role['role'] == 2) {
                    return redirect()->route('duyetHomepage');
                } 
            }
            else if($user->status == 0) echo "Tài khoản của bạn đã bị khóa";
        } else {
            return redirect()->back();
        }
    }
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
