<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function admin_dashboard(){
        return view('admin.dashboard');
    }

    function admin_login(){
        return view('admin.layouts.admin_login');
    }

    function admin_logged(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        if(Admin::where('email',$request->email)->exists()){
            if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){
                return redirect()->route('admin.dashboard');
            }
            else{
                return back()->with('pass_wrong',"password doesn't exists");
            }
        }
        else{
            return back()->with('wrong',"Email doesn't exists");
        }
    }

    function admin_logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
