<?php

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnValue;

function allwishlist()
{
    return Wishlist::where('user_id',Auth::id())->get();
}
function wishlistcheck($product_id)
{
    return Wishlist::where('user_id',Auth::id())->where('product_id',$product_id)->exists();
}
function cartcheck()
{
    return Cart::where('user_id',Auth::id())->get();
}
function checkvendor($product_id)
{
    return User::find(Product::find($product_id)->user_id)->name;
}
function availablestock($product_id)
{
    return Product::find($product_id)->product_stock;
}
function number_of_review($product_id)
{
    if(Rating::where('product_id',$product_id)->count() >=2)
    {
        return Rating::where('product_id',$product_id)->count().' reviews';
    }else{
        return Rating::where('product_id',$product_id)->count().' review';
    }
}

function rating_percentage($product_id)
{
    return Rating::where('product_id',$product_id)->avg('rating')*20;
}
function total_rating($product_id)
{
    return round(Rating::where('product_id',$product_id)->avg('rating'));
}







