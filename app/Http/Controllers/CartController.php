<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    
    public function cart()
    {
        if(isset($_GET['coupon_name'])){
            if($_GET['coupon_name']){
                $coupon_name=$_GET['coupon_name'];
                if(Coupon::where('coupon_name',$coupon_name)->exists()){
                     $coupon = Coupon::where('coupon_name',$coupon_name)->first();
                     if($coupon->limit!=0){
                        if( $coupon->validity < Carbon::today()->format('Y-m-d') ){
                            return redirect('cart')->with('coupon_error','Opps! ' .$coupon_name.'  coupon date is over');
                        }else{  
                           $discount=session('cart_total')*$coupon->discount_percentage/100;
                        }
                     }else{
                        return redirect('cart')->with('coupon_error','Opps! ' .$coupon_name.' coupon limit is over');
                     }
                }else{
                    return redirect('cart')->with('coupon_error','Sorry! we dont have any ' .$coupon_name.' named coupon in our records');
                }

            }else{
                $coupon_name="";
                $discount=0;
            }
        }
        else{
            $coupon_name="";
            $discount=0;
        }
        
        return view ('frontend.cart',compact('discount','coupon_name'));
    }

    public function addfromwishlist($wishlist_id)
    {
       $vendor_id=Product::find(Wishlist::find($wishlist_id)->product_id)->user_id;
       if(Cart::where('user_id',Auth::id())->where('product_id',Wishlist::find($wishlist_id)->product_id)->exists()){
         Cart::where('user_id',Auth::id())->where('product_id',Wishlist::find($wishlist_id)->product_id)->increment('quantity',1); 
       }else{
           Cart::insert([
               'user_id' => Auth::id(),
               'product_id' =>Wishlist::find($wishlist_id)->product_id,
               'vendor_id' =>$vendor_id,
               'created_at' =>Carbon::now(),
           ]);
       }
        Wishlist::find($wishlist_id)->delete();

        return back();
    }

    public function addtocart(Request $request, $product_id)
    {
        $vendor_id=Product::find($product_id)->user_id;
        $product_stock=Product::find($product_id)->product_stock;

        if($request->qtybutton>$product_stock){
            Toastr::error('Opps! we dont have enough stock for your request','Error');
            return back();
        }else{
            if(Cart::where('user_id',Auth::id())->where('product_id',$product_id)->exists()){
                if($product_stock < Cart::where('user_id',Auth::id())->where('product_id',$product_id)->first()->quantity+$request->qtybutton){
                    Toastr::error('Opps! product already in the cart','Error');
                   return back();
                }else{
                    Cart::where('user_id',Auth::id())->where('product_id',$product_id)->increment('quantity',$request->qtybutton);
                }             
            }else{
                    Cart::insert([
                        'user_id'=>Auth::id(),
                        'product_id'=>$product_id,
                        'vendor_id'=>$vendor_id,
                        'quantity'=> $request->qtybutton
                    ]);      
                } 
                Toastr::success('your product added to cart go and check!','success');  
            return back();
        }        
    }
  
    public function cartupdate(Request $request)
    {      
        foreach($request->qtybutton as $cart_id=>$qtybutton){
            $product_stock=Product::find(Cart::find($cart_id)->product_id)->product_stock;
            
            if($qtybutton > $product_stock){
                Toastr::error('Opps! we dont have enough stock for your request','Error');
                return back();
            }else{
                Cart::find($cart_id)->update([
                    'quantity'=> $qtybutton,
                ]); 
            }
        }
        Toastr::info('Cart Upadated successfully','updated');
        return back();
    }

    public function remove($id)
    {
      Cart::where('user_id',$id)->delete();
      Toastr::error('Cart deleted successfully','success');
      return back();
    }
    
    public function removesinglecart($cart_id)
    {       
        Cart::find($cart_id)->delete();
        Toastr::error('Cart deleted successfully','success');
        return back();
    }
}
