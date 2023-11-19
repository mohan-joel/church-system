<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fellowship;

class FellowshipController extends Controller
{
    //
    public function show()
    {
        $fellowships = Fellowship::all();
        $a = 1;
        $year = date('Y');
        return view('user.fellowship',compact('fellowships','a','year'));
    }

    public function add(Request $req)
    {
        $req->validate([
            'fellowship_name'=>'required|string'
        ]);

        $fellowship = new Fellowship();
        $fellowship->fellowship_name = $req->fellowship_name;
        $fellowship->save();
        $req->session()->flash('success','Fellowship Added Successfully');
        return redirect('/show-fellowships');
    }

    public function delete(Request $req,$id)
    {
        $fellowship = Fellowship::find($id);
        $fellowship->delete();
        $req->session()->flash('success','Fellowship Deleted Successfully');
        return redirect('/show-fellowships');  
    }

    public function update(Request $req)
    {
        $id = $req->fellowship_id;
        $fellowship = Fellowship::find($id);
        $fellowship->fellowship_name = $req->fellowship_name;
        $fellowship->update();
        $req->session()->flash('success','Fellowship Updated Successfully');
        return redirect('/show-fellowships');   
    }

    public function fellowshipPrintPreview()
    {
        $b=1;
        $fellowships = Fellowship::all();
        return view('user.fellowshipPrintPreview',compact('fellowships','b'));
    }

    public function SearchFellowship(Request $request)
    {
        $a=1;
        $year = date('Y');
        $searchFellowship = $request->fellowships;
        $fellowships = Fellowship::where('fellowship_name','like','%'.$searchFellowship.'%')->get();
        return view('user.fellowship',compact('a','year','fellowships'));
    }
}
