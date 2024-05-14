<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Writter;
use App\Models\WritterSocile;
use App\Models\WritterSummary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WritterProfileController extends Controller
{
    function writter_dashboard(){
        return view('writter.dashboard');
    }

    function writter_profile(){
        return view('writter.profile.writter_profile');
    }

    function writter_update(){
        $countries = Country::all();
        $cities = City::all();
        return view('writter.profile.writter_update',[
            'countries'=>$countries,
            'cities'=>$cities,
        ]);
    }

    function getwrittercity(Request $request){
        $str = '<option>Select City</option>';
        $cities = City::where('country_id',$request->country_id)->get();
    
        foreach ($cities as $city) {
            $str .= '<option value="'.$city->id.'">'.$city->name.'</option>';
        }
        echo $str;
    }

    function writter_profile_update(Request $request){
        Writter::find(Auth::guard('writter')->id())->update([
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

    function writter_socile(){
        $sociles = WritterSocile::where('writter_id',Auth::guard('writter')->id())->get();
        return view('writter.profile.writter_socile',[
            'sociles'=>$sociles,
        ]);
    }

    function writter_socile_store(Request $request){
        WritterSocile::insert([
            'writter_id'=>Auth::guard('writter')->id(),
            'socile_icon'=>$request->socile_icon,
            'socile_link'=>$request->socile_link,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('success','socile icon store successfully');
    }

    function writter_socile_delete($id){
        WritterSocile::find($id)->delete();
        return back()->with('delete','socile icon delete successfully');
    }

    function writter_wikipedia(Request $request){
        return view('writter.profile.writter_wikipedia');
    }

    function writter_summary_store(Request $request){
        WritterSummary::insert([
            'writter_id'=>Auth::guard('writter')->id(),
            'summary'=>$request->summary,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('success','Sumary added Successfull');
    }
}
