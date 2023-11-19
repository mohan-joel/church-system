<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Youth;
use Illuminate\Support\Facades\Session;

class YouthController extends Controller
{
    //
    public function show()
    {
        $youths = Youth::all();
        $a=1;
        $year = date('Y');
        return view('user.youths',compact('youths','a','year'));
    }

    public function add(Request $req)
    {
        $validate = $req->validate([
            'name'=>'required|string',
            'gender'=>'required|string',
            'address'=>'required|string',
            'contact'=>'required|string',
            'email'=>'required|email',
            'dob'=>'required|date',
            'jobStudy'=>'required|string',
            'photo'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

            if($req->file('photo')->isValid()){
                $photo = $req->file('photo');
                $photoPath = $photo->storeAs('photos', $req->file('photo')->getClientOriginalName(), 'public');
            }
            $youth = new Youth();
            $youth->name = $req->name;
            $youth->gender = $req->gender;
            $youth->address = $req->address;
            $youth->contact = $req->contact;
            $youth->email = $req->email;
            $youth->dob = $req->dob;
            $youth->jobStudy = $req->jobStudy;
            $originalName = $req->file('photo')->getclientOriginalName();
            $youth->photo = $originalName;
            $youth->save();
            $req->session()->flash('success','Youth Added Successfully');
            return redirect('/show-youths');       
    }

    public function delete(Request $req,$id)
    {
        $youth = Youth::find($id);
        $youth->delete();
        $req->session()->flash('success','Youth Deleted Successfully');
        return redirect('/show-youths');
    }

    public function getData($id)
    {
        $youth = Youth::where('id',$id)->get();
        return response()->json(['response'=>$youth]);
    }

    public function update(Request $req)
    {

        if($req->file('photo')->isValid()){
            $photo = $req->file('photo');
            $photoPath = $photo->storeAs('photos', $req->file('photo')->getClientOriginalName(), 'public');
        }
        $id = $req->youth_id;
        $youth = Youth::find($id);
        $youth->name = $req->name;
        $youth->gender = $req->gender;
        $youth->address = $req->address;
        $youth->contact = $req->contact;
        $youth->email = $req->email;
        $youth->dob = $req->dob;
        $youth->jobStudy = $req->jobStudy;
        $image = $req->file('photo')->getClientOriginalName();
        $youth->photo = $image;
        $youth->update();

        $req->session()->flash('success','Youth Updated Successfully');
        return redirect('/show-youths');   
    }

    public function youthPrintPreview()
    {
        $b = 1;
        $youths = Youth::all();
        return view('user.youthPrintPreview',compact('youths','b'));
    }

    public function searchYouth(Request $request)
    {
        $a=1;
        $year = date('Y');
        $searchYouths = $request->youths;
        $youths = Youth::where('name','like','%'.$searchYouths.'%')->get();
        return view('user.youths',compact('youths','a','year'));
    }
}
