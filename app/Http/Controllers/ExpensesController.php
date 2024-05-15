<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    function expenses_list(){
        $espensess = Expenses::paginate(10);
        return view('admin.expensess.expenses_list',[
            'espensess'=>$espensess,
        ]);
    }

    function expensess_store(Request $request){
        Expenses::insert([
            'amount'=>$request->amount,
            'name'=>$request->name,
            'created_at'=>Carbon::now(),
        ]);

        return back()->with('success','Expensess added successfull');
    }

    function expensess_delete($id){
        Expenses::find($id)->delete();

        return back()->with('delete','Expensess delete successfull');
    }
}
