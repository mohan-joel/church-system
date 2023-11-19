<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expenditure;

class ExpenditureController extends Controller
{
    //
    public function show()
    {
        $p = 1;
        $expenditures = Expenditure::all();
        $year = date('Y');
        return view('user.expenditure',compact('expenditures','p','year'));
    }

    public function add(Request $req)
    {
        $req->validate([
            'date'=>'required|date',
            'title'=>'required|string',
            'amount'=>'required|string'
        ]);

        $expenditure = new Expenditure();
        $expenditure->date = $req->date;
        $expenditure->title = $req->title;
        $expenditure->amount = $req->amount;
        $expenditure->save();

        $req->session()->flash('success','Expenditure Added Successfully');
        return redirect('/show-expenditures');
    }

    public function delete($id)
    {
        $expenditure = Expenditure::find($id);
        $expenditure->delete();
        return redirect()->back()->with('success','Expenditure deleted Successfully');
    }

    public function getExpenditureDetail($id)
    {
        $expenditure = Expenditure::find($id);
        return response()->json(['data'=>$expenditure]);
    }


    public function update(Request $req)
    {
        $req->validate([
            'date'=>'required|date',
            'title'=>'required|string',
            'amount'=>'required|string'
        ]);

        $id = $req->expenditure_id;
        $expenditure = Expenditure::find($id);
        $expenditure->date = $req->date;
        $expenditure->title = $req->title;
        $expenditure->amount = $req->amount;
        $expenditure->update();
        $req->session()->flash('success','Expenditure Updated Successfully');
        return redirect('/show-expenditures');
    }

    public function expenditurePrintPreview()
    {
        $b=1;
        $expenditures = Expenditure::all();
        $total = Expenditure::sum('amount');
        return view('user.expenditurePrintPreview',compact('expenditures','b','total'));
    }

    public function SearchExpenditure(Request $request)
    {
        $p = 1;
        $year = date('Y');
        $searchExpenditures = $request->expenditures;
        $expenditures = Expenditure::where('title','like','%'.$searchExpenditures.'%')->get();
        return view('user.expenditure',compact('p','year','expenditures'));
    }

}
