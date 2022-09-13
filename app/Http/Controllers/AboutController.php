<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\About;
use App\Models\Cart;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkadmin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abouts = About::orderBy('created_at','desc')->get();
        return view('backend.about.index',compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.about.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'designation'=>'required',
            'image'=>'required',
            'facebook'=>'nullable|unique:abouts,facebook',
            'instagram'=>'nullable|unique:abouts,instagram',
            'twitter'=>'nullable|unique:abouts,twitter',
            'google'=>'nullable|unique:abouts,google',
        ]);

        
        $currentdate=Carbon::now()->toDateString();
        $imagename=$request->name.'-'.$currentdate.'-'.Str::random(5).'.'.$request->file('image')->getClientOriginalExtension();
        Image::make($request->file('image'))->resize(370,380)->save(base_path('public/uploads/about_photos/'.$imagename));

        About::insert([
            'name'=>$request->name,
            'designation'=>$request->designation,
            'image'=>$imagename,
            'facebook'=>$request->facebook,
            'instagram'=>$request->instagram,
            'twitter'=>$request->twitter,
            'google'=>$request->google,
            'created_at'=>Carbon::now(),
        ]);

        Toastr::success('Team added successfully','success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        return view('backend.about.edit',compact('about'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
    {
        
        $request->validate([
            'name'=>'required',
            'designation'=>'required',
            'image'=>'required',
            'facebook'=>'nullable',
            'instagram'=>'nullable',
            'twitter'=>'nullable',
            'google'=>'nullable',  
        ]);

        if($request->hasFile('image')){
            unlink(base_path('public/uploads/about_photos/'.$about->image));

            $currentdate=Carbon::now()->toDateString();
            $imagename=$request->name.'-'.$currentdate.'-'.Str::random(5).'.'.$request->file('image')->getClientOriginalExtension();
            Image::make($request->file('image'))->resize(370,380)->save(base_path('public/uploads/about_photos/'.$imagename));

            $about->update([
                'image'=>$imagename
            ]);
        }

            $about->update([
            'name'=>$request->name,
            'designation'=>$request->designation,
            'image'=>$imagename,
            'facebook'=>$request->facebook,
            'instagram'=>$request->instagram,
            'twitter'=>$request->twitter,
            'google'=>$request->google,
            'updated_at'=>Carbon::now(),
            ]);
            Toastr::info('Team info updated successfully','updated');
            return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        unlink(base_path('public/uploads/about_photos/'.$about->image));
        Toastr::error('about deleted successfully','success');
        $about->delete();

        return back();
    }
}
