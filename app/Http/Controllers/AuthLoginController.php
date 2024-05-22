<?php

namespace App\Http\Controllers;

use App\Mail\DataUpdateeMail;
use App\Mail\InvoiceMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthLoginController extends Controller
{
    function admin_login(){
        return view('admin.layouts.admin_login');
    }

    function student_login(){
        return view('auth.student_login');
    }

    function student_store_libery(Request $request){
        if(User::where('pro_code',$request->seckret_key)->exists()){
            if(User::where('email',$request->email)->exists()){
                if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                    // return redirect()->route('admin.dashboard');
                    return redirect()->route('student.profile');
                }
                else{
                    // return back()->with('pass_wrong',"password doesn't exists");
                    echo 'e-p wrong';
                }
            }
            else{
                echo 'e wrong';
            }
        }
        else{
            echo 'wrong';
        }
    }

    function student_register(Request $request){
        return view('auth.student_register');
    }

    function student_register_form_store(Request $request){
        User::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
            'created_at'=>Carbon::now(),
        ]);

        $user_info = $request->email.' | Password: '.$request->password;

        Mail::to($request->email)->send(new InvoiceMail($user_info));
        return redirect()->route('student.login')->with('success',"Contact admin for secret key");
    }
}
