<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;



class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('profile');
    }
    public function profile_namechange(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
        ]);
        
         User::find(Auth::id())->update([
            'name' => $request->name
        ]);
        Toastr::info('your name changed successfully','Updated');
        return back();
    }

    public function profile_password_change(Request $request)
    {
        $request->validate([
            '*' => 'required|min:8',
        ]);
        if(Hash::check($request->old_password,Auth::user()->password))
        {
            if($request->new_password == $request->confirm_password)
            {
                User::find(Auth::id())->update([
                    'password' => Hash::make($request->new_password)
                ]);
                Toastr::info('your password changed successfully','Updated');
                return back();
            }else{
                Toastr::error('New password does not match to confirm password','Error');
                return back();
            }
        }else{
            Toastr::error('Oops! password does not match to our database','Error');
            return back();
        }
    }

    public function photochange(Request $request)
    {
        $request->validate([
        'profile_photo' => 'required|image'
        ]);

        if(Auth::user()->profile_photo != 'default.jpg')
        {
            unlink(base_path('public/uploads/profile_photos/'.Auth::user()->profile_photo));
        }
        $image=$request->file('profile_photo')->getClientOriginalExtension();
        $new_profile_photo_name= Auth::id().'-'.Auth::user()->name.'.'.$image;
        Image::make($request->file('profile_photo'))->resize(100,100)->save(base_path('public/uploads/profile_photos/'.$new_profile_photo_name));   
        User::find(Auth::id())->update([
            'profile_photo' => $new_profile_photo_name,
        ]);
        Toastr::info('Profile photo updated successfully','update');
        return back();
    }
}
