<?php

namespace App\Http\Controllers;

use App\Models\BulkSeat;
use App\Models\Seat;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LiberyMasterController extends Controller
{
    //========== Shift controller =============//
    function shift(){
        $shifts = Shift::paginate(5);
        $sift_info = Shift::all();
        return view('admin.library.shift',[
            'shifts'=>$shifts,
            'sift_info'=>$sift_info,
        ]);
    }

    function shift_store(Request $request){
        if($request->full_day_shift == 1){
            Shift::find($request->type_shift)->update([
                'shift_start_time'=>$request->shift_start_time,
                'shift_end_time'=>$request->shift_end_time,
                'amount'=>$request->amount,
                'full_day_shift'=>$request->full_day_shift,
                'created_at'=>Carbon::now(),
            ]);
        return back()->with('success',"Shift start successfully");
        }
        else{
            Shift::find($request->type_shift)->update([
                'shift_start_time'=>$request->shift_start_time,
                'shift_end_time'=>$request->shift_end_time,
                'amount'=>$request->amount,
                'full_day_shift'=>0,
                'created_at'=>Carbon::now(),
            ]);
        return back()->with('success',"Shift start successfully");
        }
    }

    // =========== Seet Controller ==============//
    function seats(){
        $seats = Seat::paginate(10);
        $shifts = Shift::all();
        return view('admin.library.seats',[
            'seats'=>$seats,
            'shifts'=>$shifts,
        ]);
    }

    function seat_store(Request $request){
        Seat::insert([
            'shift_id'=>$request->shift_id,
            'seat_no'=>$request->seat_no,
        ]);
        return back()->with('success',"Shift start successfully");
    }

    function seat_delete($id){
        Seat::find($id)->delete();

        return back()->with('delete','Seat delete successfull');
    }

    //==================== Bulk seat =================//
    function bulk_seat(){
        $bulk_seats = BulkSeat::paginate(7);
        $shifts = Shift::all();
        return view('admin.library.bulk_seat',[
            'bulk_seats'=>$bulk_seats,
            'shifts'=>$shifts,
        ]);
    }

    function seat_bulk_store(Request $request){
        BulkSeat::insert([
            'shift_id'=>$request->shift_id,
            'seat_letter'=>$request->seat_letter,
            'form'=>$request->form,
            'to'=>$request->to,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('success',"Bulk seat store successfully");
    }

    function bulk_seat_delete($id){
        BulkSeat::find($id)->delete();

        return back()->with('delete','Seat delete successfull');
    }



}
