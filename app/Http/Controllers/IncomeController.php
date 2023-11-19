<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;

class IncomeController extends Controller
{
    //
    public function show()
    {
        $p = 1;
        $incomes = Income::all();
        $year = date('Y');
        return view('user.income',compact('incomes','p','year'));
    }

    public function add(Request $req)
    {
        $req->validate([
            'date'=>'required|date',
            'title'=>'required|string',
            'amount'=>'required|string'
        ]);

        $income = new Income();
        $income->date = $req->date;
        $income->title = $req->title;
        $income->amount = $req->amount;
        $income->save();

        $req->session()->flash('success','Income Added Successfully');
        return redirect('/show-incomes');
    }

    public function delete($id)
    {
        $income = Income::find($id);
        $income->delete();
        return redirect()->back()->with('success','Income Deleted Successfully');
    }

    public function getIncomeDetail($id)
    {
        $income = Income::where('id',$id)->get();
        return response()->json(['data'=>$income]);
    }

    public function update(Request $req)
    {
        $req->validate([
            'date'=>'required|date',
            'title'=>'required|string',
            'amount'=>'required|string'
        ]);

        $id = $req->income_id;
        $income = Income::find($id);
        $income->date = $req->date;
        $income->title = $req->title;
        $income->amount = $req->amount;
        $income->update();
        $req->session()->flash('success','Income Updated Successfully');
        return redirect('/show-incomes');
    }


    public function incomePrintPreview()
    {
        $b=1;
        $incomes = Income::all();
        $total = Income::sum('amount');
        return view('user.incomePrintPreview',compact('incomes','b','total'));
    }

    public function SearchIncome(Request $request)
    {
        $p=1;
        $year = date('Y');
        $searchIncome = $request->incomes;
        $incomes = Income::where('title','like','%'.$searchIncome.'%')->get();
        return view('user.income',compact('p','year','incomes'));
    }
}
