<?php

namespace App\Http\Controllers;

use App\Models\AsignSeat;
use Illuminate\Http\Request;

class AssinShiftController extends Controller
{
    function morning_shift_student(){
        $morning_shifts = AsignSeat::where('shift_id',1)->get();
        return view('admin.assin_seat.morning_shift_student',[
            'morning_shifts'=>$morning_shifts,
        ]);
    }
}
