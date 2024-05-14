<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Country;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;


class AdminProfileController extends Controller
{
    function admin_profile(){
        return view('admin.profile.admin_profile');
    }

    function admin_profile_update(Request $request){
        // Admin::find(Auth::guard('admin')->id())->update([

        // ]);
        if(Auth::guard('admin')->user()->photo == null){
            if($request->photo == ''){
                Admin::find(Auth::guard('admin')->id())->update([
                    'about_info'=>$request->about_info,
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'updated_at'=>Carbon::now(),
                ]);
                return back()->with('update','Update information');
            }
            else{
                $photo = $request->photo;
                $extension = $photo->extension();
                $file_name = uniqid().'.'.$extension;
                Image::make($photo)->save(public_path('uploads/admin/'.$file_name));

                Admin::find(Auth::guard('admin')->id())->update([
                    'about_info'=>$request->about_info,
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'photo'=>$file_name,
                    'updated_at'=>Carbon::now(),
                ]);
                return back()->with('update','Update information');
            }
        }
        else{
            if($request->photo == ''){
                Admin::find(Auth::guard('admin')->id())->update([
                    'about_info'=>$request->about_info,
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'updated_at'=>Carbon::now(),
                ]);
                return back()->with('update','Update information');
            }
            else{
                $admin_info = Admin::find(Auth::guard('admin')->id());
                $delete_form = public_path('uploads/admin/'.$admin_info->photo);
                unlink($delete_form);

                $photo = $request->photo;
                $extension = $photo->extension();
                $file_name = uniqid().'.'.$extension;
                Image::make($photo)->save(public_path('uploads/admin/'.$file_name));

                Admin::find(Auth::guard('admin')->id())->update([
                    'about_info'=>$request->about_info,
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'photo'=>$file_name,
                    'updated_at'=>Carbon::now(),
                ]);
                return back()->with('update','Update information');
            }
        }
    }

    function admin_password(){
        return view('admin.profile.admin_password');
    }

    function admin_password_update(Request $request){
        $admin = Admin::find(Auth::guard('admin')->id());
        if(Hash::check($request->old_password,$admin->password)){
            Admin::find(Auth::guard('admin')->id())->update([
                'password'=>bcrypt($request->password),
            ]);
            return back()->with('update','Password Update Successfull'); 
        }
        else{
            return back()->with('wrong','Password is wrong'); 
        }
    }
}
