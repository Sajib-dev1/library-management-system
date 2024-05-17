<?php

namespace App\Http\Controllers;

use App\Models\AsignSeat;
use App\Models\Expenses;
use Illuminate\Http\Request;

class RepotrController extends Controller
{
    function report_amount(){
        $expenses_listes = Expenses::paginate(10); 
        $total_tk = Expenses::all();

        //========== total amount check in pagination table function-01 =============//
        // $total_amounts = 0;
        // foreach ($total_tk as $post1) {
        //     $total_amounts += $post1['amount'];
        // }
        // return $total_amounts;

        //============ total amount check in pagination table function-02 ============//
        // $total = Expenses::all();

        $total_amount = $total_tk->sum('amount');
        $income_listes = AsignSeat::paginate(10);
        $total_income = AsignSeat::all();
        $total_inco = $total_income->sum('amount');

        return view('admin.report.report_amount',[
            'expenses_listes'=>$expenses_listes,
            'total_amount'=>$total_amount,
            'income_listes'=>$income_listes,
            'total_inco'=>$total_inco,
        ]);
    }
}
