@extends('layouts.app_frontend')

@section('content')

<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">Shop</h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Wishlist</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>

<!-- breadcrumb-area end -->


<!-- Wishlist Area Start -->
<div class="cart-main-area pt-100px pb-100px">
    <div class="container">
        <h3 class="cart-page-title">Your cart items</h3>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <form action="#">
                    <div class="table-content table-responsive cart-table-content">
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Unit Price</th>
                                    <th>Add To Cart</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($wishlists as $wishlist)
                                <tr>
                                    <td class="product-thumbnail">
                                        <a href="{{route('productdetails',$wishlist->product->product_slug)}}"><img style="width:100px" class="img-responsive ml-15px" src="{{asset('uploads/product_images/'.$wishlist->product->product_image)}}" alt="" /></a>
                                    </td>
                                    <td class="product-name"><a href="{{route('productdetails',$wishlist->product->product_slug)}}">{{$wishlist->product->product_name}}</a></td>
                                    <td class="product-price-cart"><span class="amount">${{$wishlist->product->product_price}}</span></td>                       
                                    <td class="product-wishlist-cart">
                                        <a href="{{route('addfromwishlist',$wishlist->id)}}">add to cart</a>
                                    </td>
                                    @empty
                                       <td colspan="50" class="text-center text-danger">No product in Wishlist</td>
                                    @endforelse
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Wishlist Area End -->

@endsection