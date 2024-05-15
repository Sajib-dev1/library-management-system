<?php

namespace App\Http\Controllers;

use App\Models\AsignSeat;
use Illuminate\Http\Request;

class AssinShiftController extends Controller
{
    function morning_shift_student(){
        $morning_shifts = AsignSeat::all();
        return view('admin.assin_seat.morning_shift_student',[
            'morning_shifts'=>$morning_shifts,
        ]);
    }
}
