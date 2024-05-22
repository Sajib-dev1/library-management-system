<?php

namespace App\Http\Controllers;

use App\Mail\StudentInfoMail;
use App\Models\AsignSeat;
use App\Models\AttendaseStudent;
use App\Models\Seat;
use App\Models\Shift;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use function Symfony\Component\String\b;

class SeatLocationController extends Controller
{
    function assign_seat(){
        $seaft_time = Shift::all();
        $mornung_seat = Seat::where('shift_id',1)->get();
        $after_noon_seat = Seat::where('shift_id',2)->get();
        $full_shift_seat = Seat::where('shift_id',3)->get();
        $assign_seats = AsignSeat::all();
        $students = User::where('seat_book',0)->where('status',1)->get();
        $shifts = Shift::all();
        return view('admin.seat_location.assign_seat',[
            'seaft_time'=>$seaft_time,
            'mornung_seat'=>$mornung_seat,
            'students'=>$students,
            'shifts'=>$shifts,
            'assign_seats'=>$assign_seats,
            'after_noon_seat'=>$after_noon_seat,
            'full_shift_seat'=>$full_shift_seat,
        ]);
    }

    function getshiftamount(Request $request){
        echo $request->amount;
    }

    function asign_seat_store(Request $request){
        $asign_id = AsignSeat::insertGetId([
            'student_id'=>$request->student_id,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'shift_id'=>$request->shift_id,
            'pament_status'=>$request->pament_status,
            'pament_mode'=>$request->pament_mode,
            'paid_amount'=>$request->paid_amount,
            'discount'=>$request->discount,
            'amount'=>$request->paid_amount - $request->discount,
            'seat_id'=>$request->seat_id,
            'created_at'=>Carbon::now(),
        ]);
        User::find($request->student_id)->update([
            'seat_book'=>1,
            'pro_code'=>rand(),
        ]);
        Seat::find($request->seat_id)->update([
            'seat_book'=>1,
            'student_id'=>$request->student_id,
            'asign_id'=>$asign_id,
        ]);

        $user_info = User::find($request->student_id);

        Mail::to($user_info->email)->send(new StudentInfoMail($user_info));
        return back()->with('success',"Student Added Successfully");
    }

    function assign_all_student(){
        $assign_students = AsignSeat::paginate(7);
        return view('admin.seat_location.assign_all_student',[
            'assign_students'=>$assign_students,
        ]);
    }

    function shift_wise_seat(){
        $shift_info = Shift::all();
        return view('admin.seat_location.shift_wise_seat',[
            'shift_info'=>$shift_info,
        ]);
    }

    function getassinstatus(Request $request){

        AsignSeat::find($request->assin_id)->update([
            'status'=>$request->status,
        ]);

        if($request->status == 1){
            AttendaseStudent::insert([
                'assin_id'=>$request->assin_id,
                'student_id'=>$request->student_id,
                'status'=>1,
                'created_at'=>Carbon::now(),
            ]);
        }
        return back();
    }

    function attendase_student_status(){
        $asign_seats = AsignSeat::all();
        foreach ($asign_seats as $asign_seat ) {
            if ($asign_seat->status == 1) {
                AsignSeat::find($asign_seat->id)->update([
                    'status'=>0,
                    'updated_at'=>Carbon::now(),
                ]);
            }
            else{
                return view('admin.seat_location.attendase_submit');
            }
        }
    }

    //============= Attendace =================

    function morning_shift_attendace(){
        $morning_shifts = AsignSeat::where('shift_id',1)->get();
        return view('admin.seat_location.morning_shift_attendace',[
            'morning_shifts'=>$morning_shifts,
        ]);
    }

    function after_noon_shift_attendace(){
        $after_shifts = AsignSeat::where('shift_id',2)->get();
        return view('admin.seat_location.after_noon_shift_attendace',[
            'after_shifts'=>$after_shifts,
        ]);
    }

    function full_attendace_shift(){
        $full_shifts = AsignSeat::where('shift_id',3)->get();
        return view('admin.seat_location.full_attendace_shift',[
            'full_shifts'=>$full_shifts,
        ]);
    }

}
