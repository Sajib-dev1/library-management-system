<?php

namespace App\Http\Controllers;

use App\Mail\DataUpdateeMail;
use App\Models\City;
use App\Models\Country;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentRegister;
use App\Mail\RegesterMail;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Auth;

class AdminStudentController extends Controller
{
    function student_list(){
        // $users = User::where('status','!=',1)->latest()->paginate(10);
        $users = User::whereNot('status',1)->paginate(10);
        return view('admin.student.student',[
            'users'=>$users,
        ]);
    }

    function admin_student_delete($id){
        $user_info = User::find($id);
        if( $user_info->photo != null){
            $delete_form = public_path('uploads/user/'.$user_info->photo);
            unlink($delete_form);
        }
        User::find($id)->delete();

        return back()->with('delete','Student delete successfull');
    }

    function getstudentcity(Request $request){
                $str = '<option>Select City</option>';
        $cities = City::where('country_id',$request->country_id)->get();
    
        foreach ($cities as $city) {
            $str .= '<option value="'.$city->id.'">'.$city->name.'</option>';
        }
        echo $str;
    }

    function admin_student_store(Request $request){
        $photo = $request->photo;
        $extension = $photo->extension();
        $file_name = uniqid().'.'.$extension;
        Image::make($photo)->save(public_path('uploads/user/'.$file_name));

       User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'whatsapp'=>$request->whatsapp,
            'password'=>bcrypt($request->password),
            'address'=>$request->address,
            'status'=>$request->status,
            'photo'=>$file_name,
            'created_at'=>Carbon::now(),
        ]);

        $user_info = $request->email.' | Password: '.$request->password;

        Mail::to($request->email)->send(new InvoiceMail($user_info));

        return back()->with('success','Student added Successfully');
    }

    function getstudentstatus(Request $request){
        User::find($request->id)->update([
            'status'=>$request->status,
        ]);
    }

    function student_list_active(){
        $users = User::where('status',1)->latest()->paginate(10);
        return view('admin.student.student_list_active',[
            'users'=>$users,
        ]);
    }

    function admin_student_update(Request $request,$id){
        User::find($id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'whatsapp'=>$request->whatsapp,
            'status'=>$request->status,
            'updated_at'=>Carbon::now(),
        ]);

        Mail::to($request->email)->send(new DataUpdateeMail());
        return back()->with('update','Student updated Successfully');
    }
}
