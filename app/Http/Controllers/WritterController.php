<?php

namespace App\Http\Controllers;

use App\Models\Writter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WritterController extends Controller
{
    function writter_list(){
        return view('writter.writter_list');
    }

    function writter_store(Request $request){
        Writter::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('success','Writter added successfull');
    }

    function writter_login(){
        return view('writter.writter_login');
    }

    function writter_logged(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        if(Writter::where('email',$request->email)->exists()){
            if(Auth::guard('writter')->attempt(['email' => $request->email, 'password' => $request->password])){
                return redirect()->route('writter.dashboard');
            }
            else{
                return back()->with('pass_wrong',"password doesn't exists");
            }
        }
        else{
            return back()->with('wrong',"Email doesn't exists");
        }
    }

    function writter_logout(){
        Auth::guard('writter')->logout();
        return redirect()->route('writter.login');
    }
}
