<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Product_Sample_Image;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkvendor');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('user_id',Auth::id())->get();
        return view('backend.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories= Category::where('status','show')->get();
        return view('backend.product.create',compact('categories'));
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

           'category_id'=> 'required',          
           'product_name' => 'required',
           'product_price' => 'required',
           'product_image'=> 'required|image',
           'product_code'=> 'required',
           'product_stock'=> 'required',
           'product_short_description' => 'required',
           'product_long_description' => 'required',

        ]);
       
        $product = $request->product_name;
        $product_image_name= $product.'-'.Auth::user()->name.'.'.$request->file('product_image')->getClientOriginalExtension();
        Image::make($request->file('product_image'))->resize(270,310)->save(base_path('public/uploads/product_images/'.$product_image_name));

       $product_id = Product::insertGetId([
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
            'product_image'=> $product_image_name,
            'product_slug'=> Str::slug($request->product_name).'-'.Str::random(4).'-'.Auth::id(),
            'product_stock'=> $request->product_stock,
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_code' => $request->product_code,
            'short_description' => $request->product_short_description,
            'long_description' => $request->product_long_description,
            'created_at' => Carbon::now(),
        ]);

        foreach($request->file('product_sample_images') as $product_sample_image){
            $product_sample_image_name = $product_id.'-'.time().Str::random(6).'.'.$product_sample_image->getClientOriginalExtension();
            Image::make($product_sample_image)->resize(800,800)->save(base_path('public/uploads/product_sample_images/'.$product_sample_image_name));

            Product_Sample_Image::insert([
                'product_id' => $product_id,
                'product_sample_images_name' => $product_sample_image_name,
                'created_at' => Carbon::now(),
            ]);
        }
        Toastr::success('Product Created successfully','Success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
         unlink(base_path('public/uploads/product_images/'.$product->product_image));
         $product->delete();
         Toastr::error('Product Deleted successfully','Deleted');
         return back();
    }
}
