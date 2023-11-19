<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    //
    public function showProfileSetting()
    {
        $year = date('Y');
        return view('user.profileSetting',compact('year'));
    }

    public function updateProfilePic(Request $request)
    {
        $request->validate([
            'profilePic'=>'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        if($request->file('profilePic')->isValid()){
            $profilePicture = $request->file('profilePic');
            $newProfilePicture = $request->file('profilePic')->getClientOriginalName();
            $profilePicture->storeAs('public/images/users/',$newProfilePicture);

            $user->image = $newProfilePicture;
            $user->update();
        }

        return redirect()->back()->with('success','Profile Photo Changed');
    }

    public function updateProfileDetails(Request $request)
    {
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|email',
            'role'=>'required|string',
            'new_password'=>'required|string',
            'confirm_new_password'=>'required|string'
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = Hash::make($request->new_password);
        $user->update();
        return redirect()->back()->with('success','Profile Details Updated');
    }

    public function updateChurchLogo(Request $request)
    {
        $request->validate([
            'logo_church'=>'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        if($request->file('logo_church')->isValid()){
            $churchLogo = $request->file('logo_church');
            $newChurchLogo = $request->file('logo_church')->getClientOriginalName();
            $churchLogo->storeAs('public/images/users/',$newChurchLogo);

            $user->church_logo = $newChurchLogo;
            $user->update();
        }

        return redirect()->back()->with('success','Church Logo Changed');
    }

    public function updateChurchDetails(Request $request)
    {
        $request->validate([
            'church_name'=>'required|string',
            'church_address'=>'required|string',
        ]);

        $user = Auth::user();
        $user->church_name = $request->church_name;
        $user->church_address = $request->church_address;
        $user->update();
        return redirect()->back()->with('success','Church Details Updated');
    }
}
