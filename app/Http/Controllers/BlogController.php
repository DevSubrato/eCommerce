<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
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
        $blogs = Blog::orderBy('created_at','desc')->get();
        return view('backend.blogs.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.blogs.create');
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
            'title'=>'required',
            'image'=>'required|image',
            'description'=>'required',
        ]);

        $image=$request->file('image');
        $slug=Str::slug($request->title);

        //image name create && uploads start here
        $currentdate=Carbon::now()->toDateString();
        $imagename=$slug.'-'.Auth::user()->name.$currentdate.'.'.$image->getClientOriginalExtension();
        $img = Image::make($request->file('image'))->resize(770, 520)->save(base_path('public/uploads/blog_photos/'.$imagename));
        //image uploads end


        Blog::insert([
            'user_id'=>Auth::id(),
            'title'=>$request->title,
            'slug'=>$slug,
            'image'=>$imagename,
            'description'=>$request->description,
            'created_at' => Carbon::now(),
        ]);
        Toastr::success('success','your blog updated successfully');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return view('backend.blogs.show',compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('backend.blogs.edit',compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        
        $request->validate([
            'title'=>'required',
            'image'=>'required|image',
            'description'=>'required',
        ]);

        if($blog->user_id == Auth::id())
        {
            if($request->hasFile('image'))
        {  
            unlink(base_path('public/uploads/blog_photos/'.$blog->image));

            $slug=Str::slug($request->title);
            $currentdate=Carbon::now()->toDateString();
            $imagename = $slug.'-'.Auth::user()->name.'-'.$currentdate.'.'.$request->file('image')->getClientOriginalExtension();
            Image::make($request->file('image'))->resize(770, 520)->save(base_path('public/uploads/blog_photos/'.$imagename));

            $blog->update([
                'image'=>$imagename,
            ]);
          
        }

        $blog->update([
            'title'=>$request->title,
            'slug'=>Str::slug($request->title),
            'description'=>$request->description,
            'updated_at' => Carbon::now(),
        ]);
        Toastr::info('success','your blog updated successfully');
        return back();
        }
        else{
            Toastr::error('oops! this blog is not belongs to you', 'unauthorized action');
            return back();
        }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        unlink(base_path('public/uploads/blog_photos/'.$blog->image));
        $blog->delete();
        return back();
    }
}
