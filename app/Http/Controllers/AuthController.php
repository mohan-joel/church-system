<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Youth;
use App\Models\Fellowship;
use App\Models\Notice;
use App\Models\Income;
use App\Models\Expenditure;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{
    public function login_view()
    {
        if(Auth::user()){
            return redirect('/user/dashboard');
        }
        return view('auth.login');
    }

    public function register_view()
    {
        return view('auth.register');
    }

    public function register(Request $req)
    {
        $validate = $req->validate([
            'name'=>'required|string',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8',
            'confirm_password'=>'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role'=>'required|string',
            'church_name'=>'required|string',
            'church_address'=>'required|string',
            'church_logo'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);


        if($req->file('image')->isValid()){
            $profilePic = $req->file('image');
            $newProfilePic = $req->file('image')->getClientOriginalName();
            $profilePic->move(public_path('uploads/profile_image/'),$newProfilePic);
            // $user->image = $newProfilePic;
        }
    

        if($req->file('church_logo')->isValid()){
            $churchLogo = $req->file('church_logo');
            $newChurchLogo = $req->file('church_logo')->getClientOriginalName();
            $churchLogo->move(public_path('uploads/church_logo/'),$newChurchLogo);
            // $user->church_logo = $newChurchLogo;
        }

       


        $user = new User();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->image = $newProfilePic;
        $user->role = $req->role;
        $user->church_name = $req->church_name;
        $user->church_address = $req->church_address;
        $user->church_logo = $newChurchLogo;
        $user->save();

       

        $req->session()->flash('success','User Created Successfully');

        return redirect('/login');
    }

    public function login(Request $req)
    {
        $req->validate([
            'email'=>'required|string|email',
            'password'=>'required|string'
        ]);

        $UserCredentials = $req->only('email','password');
        if(Auth::attempt($UserCredentials)){
            return redirect('/user/dashboard');
        }else{
            $req->session()->flash('error','Invalidate Credentials');
            return redirect('/auth/login');
        }
    }

    public function dashboard()
    {
        $year = date('Y');
        $totalYouth = Youth::count();
        $totalFellowship = Fellowship::count();
        $totalNotice = Notice::count();
        $totalIncome = Income::sum('amount');
        $totalExpenditure = Expenditure::sum('amount');
        return view('user.dashboard',compact('year','totalYouth','totalFellowship','totalNotice','totalIncome','totalExpenditure'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
