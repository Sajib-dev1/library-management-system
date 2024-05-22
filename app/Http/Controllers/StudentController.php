<?php

namespace App\Http\Controllers;

use App\Models\AsignSeat;
use App\Models\City;
use App\Models\Country;
use App\Models\StudentEducation;
use App\Models\Studentmessage;
use App\Models\User;
use App\Models\UserSocile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class StudentController extends Controller
{
    function student_profile(){
        $sociles = UserSocile::where('user_id',Auth::id())->get();
        $student_education = StudentEducation::where('student_id',Auth::id())->get();
        $students = User::where('id','!=',Auth::id())->paginate(7);
        $student_messages = Studentmessage::where('student_id',Auth::id())->where('replay_id',null)->where('status',1)->get();
        $amount = AsignSeat::where('student_id',Auth::user()->id)->first();

        $discount = $amount->discount;

        return view('student.profile.student_profile',[
            'sociles'=>$sociles,
            'student_education'=>$student_education,
            'students'=>$students,
            'student_messages'=>$student_messages,
            'amount'=>$amount,
            'discount'=>$discount,
        ]);
    }

    function profile_edit(){
        $countries = Country::all();
        $cities = City::all();
        return view('student.profile.profile_edit',[
            'countries'=>$countries,
            'cities'=>$cities,
        ]);
    }

    function getusercity(Request $request){
        $str = '<option>Select City</option>';
        $cities = City::where('country_id',$request->country_id)->get();
    
        foreach ($cities as $city) {
            $str .= '<option value="'.$city->id.'">'.$city->name.'</option>';
        }
        echo $str;
    }

    function student_profile_update(Request $request){

        User::find(Auth::id())->update([
            'name'=>$request->name,
            'about_info'=>$request->about_info,
            'profetion'=>$request->profetion,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'country'=>$request->country,
            'city'=>$request->city,
            'phone'=>$request->phone,
            'webside_link'=>$request->webside_link,
            'language'=>$request->language,
            'updated_at'=>Carbon::now(),
        ]);
        return back()->with('update',"data update successfull");
    }

    function student_socile(){
        $sociles = UserSocile::where('user_id',Auth::id())->get();
        return view('student.profile.student_socile',[
            'sociles'=>$sociles,
        ]);
    }

    function student_socile_store(Request $request){
        UserSocile::insert([
            'user_id'=>Auth::id(),
            'socile_icon'=>$request->socile_icon,
            'socile_link'=>$request->socile_link,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('success','socile icon store successfully');
    }

    function studend_socile_delete($id){
        UserSocile::find($id)->delete();
        return back()->with('delete','socile icon delete successfully');
    }

    function student_education(){
        return view('student.profile.studend_education');
    }

    function student_education_update(Request $request){
        StudentEducation::insert([
            'student_id'=>Auth::id(),
            'education'=>$request->education,
            'course_start'=>$request->course_start,
            'course_end'=>$request->course_end,
            'webside_url'=>$request->webside_url,
            'short_desp'=>$request->short_desp,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('success','Education store successfully');
    }

    function student_message(Request $request){
        Studentmessage::insert([
            'auth_id'=>Auth::id(),
            'student_id'=>$request->student_id,
            'message'=>$request->message,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('success','message send successfully');
    }

    function student_message_replay(Request $request,$id){

        Studentmessage::find($id)->update([
            'status'=>0,
        ]);
        Studentmessage::insert([
            'auth_id'=>$request->auth_id,
            'student_id'=>Auth::id(),
            'replay_id'=>Auth::id(),
            'message'=>$request->message,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('success','message send successfully');
    }

    function student_photo_update(Request $request){
        if(Auth::user()->photo == null){
            $photo = $request->photo;
            $extension = $photo->extension();
            $file_name = uniqid().'.'.$extension;
            Image::make($photo)->save(public_path('uploads/user/'.$file_name));
    
            User::find(Auth::id())->update([
                'photo'=>$file_name,
                'updated_at'=>Carbon::now(),
            ]);
            return back()->with('update','profile update successfully');
        }
        else{
            $user_info = User::find(Auth::id());
            $delete_form = public_path('uploads/user/'.$user_info->photo);
            unlink($delete_form);

            $photo = $request->photo;
            $extension = $photo->extension();
            $file_name = uniqid().'.'.$extension;
            Image::make($photo)->save(public_path('uploads/user/'.$file_name));
    
            User::find(Auth::id())->update([
                'photo'=>$file_name,
                'updated_at'=>Carbon::now(),
            ]);
            return back()->with('update','profile update successfully');
        }
    }

    function student_password(){
        return view('student.profile.student_password');
    }

    function student_password_update(Request $request){
        $user = User::find(Auth::id());
        if(Hash::check($request->old_password,$user->password)){
            User::find(Auth::id())->update([
                'password'=>bcrypt($request->password),
            ]);
            return back()->with('update','Password Update Successfull'); 
        }
        else{
            return back()->with('wrong','Password is wrong'); 
        }
    }
}
