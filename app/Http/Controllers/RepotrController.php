<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use Illuminate\Http\Request;

class RepotrController extends Controller
{
    function report_amount(){
        $expenses_listes = Expenses::paginate(2); 
        $popular_posts = Expenses::all();

        //========== total amount check in pagination table function-01 =============//
        // $total_amounts = 0;
        // foreach ($popular_posts as $post1) {
        //     $total_amounts += $post1['amount'];
        // }
        // return $total_amounts;

        //============ total amount check in pagination table function-02 ============//
        // $total = Expenses::all();
        $total_amount = $popular_posts->sum('amount');

        return view('admin.report.report_amount',[
            'expenses_listes'=>$expenses_listes,
            'total_amount'=>$total_amount,
        ]);
    }
}
