<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
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
        $coupons = Coupon::all();
        return view('backend.coupon.index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.coupon.create');
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
           'coupon_name'=>'required|unique:coupons,coupon_name',
           'discount_percentage'=>'required|numeric|min:1|max:99',
           'validity'=>'required|date|after:today',
           'limit'=>'required|numeric|min:1',
        ]);

        Coupon::insert([
            'coupon_name'=>$request->coupon_name,
            'discount_percentage'=>$request->discount_percentage,
            'validity'=>$request->validity,
            'limit'=>$request->limit,
            'created_at'=>Carbon::now(),
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        return view('backend.coupon.edit',compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'coupon_name'=>'required|unique:coupons,coupon_name',
            'discount_percentage'=>'required|numeric|min:1|max:99',
            'validity'=>'required|date|after:today',
            'limit'=>'required|numeric|min:1',
        ]);

        $coupon->update([
            'coupon_name' => $request->coupon_name,
            'discount_percentage' => $request->discount_percentage,
            'validity' => $request->validity,
            'limit' => $request->limit,
            'updated_at'=> Carbon::now(),
        ]);

        return redirect()->route('coupon.index');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        Coupon::find($coupon)->first()->delete();
        return back();
    }
}
