<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//     protected function redirectTo()
// {
//     $user = $user = Auth::user();
//     $role = intval($user->role);
//     //echo $role;
//     if ($role == 0) {
//         return RouteServiceProvider::USERHOME;
//     } elseif ($role == 1) {
//         return RouteServiceProvider::HOME;
//     } else {
//         return route('login');
//     }
// }

    //protected $redirectTo = RouteServiceProvider::USERHOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
