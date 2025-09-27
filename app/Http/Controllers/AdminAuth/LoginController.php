<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Permission;
use App\Models\RolePermission;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Hesto\MultiAuth\Traits\LogsoutGuard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    use AuthenticatesUsers, LogsoutGuard {
        LogsoutGuard::logout insteadof AuthenticatesUsers;
    }


    public $redirectTo = '/admin/home';


    public function __construct()
    {
        $this->middleware('admin.guest', ['except' => 'logout']);
    }


    public function showLoginForm()
    {
        return view('admin.auth.login');
    }


    protected function guard()
    {
        return Auth::guard('admin');
    }



    public function login(Request $request){

        $password =  bcrypt($request->get('password'));


        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }


        Auth::guard('admin')->attempt(['email' => request('email'), 'password' => request('password')], $request->remember);

        if (Auth::guard('admin')->check()) {
            return redirect('/admin/home');
        }
        else{
            $msg = __('translate.pleaseEnterTrueData');
            return redirect()->route('admin.login.form')->with('status', $msg);

        }
    }



    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect('admin/login');
    }


}
