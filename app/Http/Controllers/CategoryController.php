<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
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
        $categories = Category::all();
        return view('backend.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.create');
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
            'category_name'=> 'required',
            'category_tagline'=> 'required',
            'category_image'=> 'required|image',
        ]);
        //photo uploads start here
        $category = $request->category_name;
        $category_image_name= $category.'-'.Auth::user()->name.'.'.$request->file('category_image')->getClientOriginalExtension();
        Image::make($request->file('category_image'))->resize(600,328)->save(base_path('public/uploads/category_images/'.$category_image_name));
        //photo uploads end here

        //inert data into database 
        Category::insert([
            'category_name' => $request->category_name,
            'category_tagline' => $request->category_tagline,
            'category_image' => $category_image_name,
            'created_at' => Carbon::now(),
        ]);
        Toastr::success('Category Created successfully','Success');
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category=Category::find($id);
        return view('backend.category.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('backend.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name'=> 'required',
            'category_tagline'=> 'required',
            'status'=> 'required'
        ]);

        if($request->hasFile('category_image'))
        {  
            $category_image_name=Category::find($id)->category_name.'-'.Auth::user()->name.'.'.$request->file('category_image')->getClientOriginalExtension();

            unlink(base_path('public/uploads/category_images/'.Category::find($id)->category_image));
            
            Image::make($request->file('category_image'))->resize(600,328)->save(base_path('public/uploads/category_images/'.$category_image_name));

            //photo uploads start here 
            Category::find($id)->update([
                'category_image' => $category_image_name,
            ]);
             //photo uploads end here
        }

            
        //update data into database 
        Category::find($id)->update([
            'category_name' => $request->category_name,
            'category_tagline' => $request->category_tagline,
            'status' => $request->status,
            'updated_at' => Carbon::now(),
        ]);   
        Toastr::info('Category updated successfully','Updated');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        unlink(base_path('public/uploads/category_images/'.$category->category_image));
        $category->delete();
        Toastr::error('Category Deleted successfully','Deleted');
        return back();
    }
}
