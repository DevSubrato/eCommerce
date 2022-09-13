<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\City;
use App\Models\Coupon;
use App\Models\Country;
use App\Models\Product;
use App\Models\Billing_info;
use App\Models\Order_detail;
use Illuminate\Http\Request;
use App\Models\Oreder_summery;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $countries=Country::where('status','active')->get(['id','name']);
        if(strpos (url()->previous(),"cart") || strpos (url()->previous(),"/checkout")){ 
            return view('frontend.checkout',compact('countries'));
        }else{
            abort(404);
        }
    }

    public function placeorder(Request $request)
    {
        $request->validate([
            '*'=>'required',
            'message'=>'nullable',
        ]);

        $order_summery_id=Oreder_summery::insertGetId([
            'user_id'=>Auth::id(),
            'coupon_name'=>session('coupon_name'),
            'cart_total'=>session('cart_total'),
            'discount_total'=>session('discount_total'),
            'shipping'=>60,
            'sub_total'=>round(Session()->get('cart_total')-Session()->get('discount_total')),
            'paymentable_total'=>round(Session()->get('cart_total')-Session()->get('discount_total'))+60,
            'payment_method'=>$request->payment_method,
            'created_at'=>Carbon::now()
        ]);

        Billing_info::insert([
            'order_summery_id'=> $order_summery_id,
            'name'=> $request->name,
            'email'=> $request->email,
            'phone_number'=> $request->phone,
            'country_id'=> $request->country,
            'city_id'=> $request->city,
            'address'=> $request->address,
            'postcode'=> $request->postcode,
            'notes'=> $request->message,
            'created_at'=>Carbon::now()
        ]);

        foreach (cartcheck() as $cart) {
            Order_detail::insert([
                'order_summery_id'=>$order_summery_id,
                'vendor_id'=>$cart->vendor_id,
                'product_id'=>$cart->product_id,
                'quantity'=>$cart->quantity,
            ]);

            Product::find($cart->product_id)->decrement('product_stock',$cart->quantity);

            Cart::find($cart->id)->delete();
        }

        if(session('coupon_name')){
            Coupon::where('coupon_name',session('coupon_name'))->decrement('limit',1);
        }  
        if($request->payment_method == 1){
            Toastr::success('Order Placed successfully','Order');
            return redirect('home');
        }else{
            Session::put('s_order_summery_id', $order_summery_id);
            return redirect('pay');
        }
    }
    public function get_city_list(Request $request)
    {
        $string_to_show="<option ><--Select City--></option>";
         foreach(City::where('country_id',$request->country_id)->get(['id','name']) as $city){    
            $string_to_show .= "<option value='$city->id'>$city->name</option>";
        }
         echo $string_to_show;
         
    }
}
