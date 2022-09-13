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
                    <li class="breadcrumb-item active">Cart</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>

<!-- breadcrumb-area end -->

<!-- Cart Area Start -->
<div class="cart-main-area pt-100px pb-100px">
    <div class="container">
        <h3 class="cart-page-title">Your cart items</h3>
        @if(session('stockout'))
            <div class="alert alert-danger">
                {{session('stockout')}}
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="table-content table-responsive cart-table-content">
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Vendor</th>
                                    <th>Product Name</th>
                                    <th>Unit Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form action="{{route('cart.update')}}" method="POST">
                                @csrf
                                @php
                                    $cart_total = 0;
                                    $stock_problem=false;
                                    $cart_empty=false;
                                @endphp
                                @forelse (cartcheck() as $cart)
                                <tr>
                                    <td class="product-thumbnail">
                                        <a href="#"><img class="img-responsive ml-15px"
                                         src="{{asset('uploads/product_images/'.$cart->product->product_image)}}" alt="" />
                                        </a>
                                    </td>
                                    <td >{{checkvendor($cart->product_id)}}</td>
                                    <td class="product-name"><a href="#">{{$cart->product->product_name}}</a>
                                        <br>
                                        @if ($cart->quantity > availablestock($cart->product->id))
                                             @php
                                                $stock_problem=true;
                                             @endphp
                                            <span class="text-danger">status : stock out</span>
                                        @else
                                            status : stock Avaiable
                                        @endif
                                        
                                    </td>
                                    <td class="product-price-cart"><span class="amount">${{$cart->product->product_price}}</span></td>
                                    <td class="product-quantity">
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" type="text" name="qtybutton[{{$cart->id}}]"
                                                value="{{$cart->quantity}}" />
                                        </div>
                                    </td>
                                    <td class="product-subtotal">
                                        ${{$cart->quantity*$cart->product->product_price}}
                                        @php
                                            $cart_total+=($cart->quantity*$cart->product->product_price)
                                        @endphp
                                    </td>
                                    
                                    <td class="product-remove">
                                        <a href="#"><i class="fa fa-pencil"></i></a>
                                        <a href="{{route('removesinglecart',$cart->id)}}"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr> 
                                @empty
                                    <tr>
                                        {{-- @php
                                            $product_empty=true;
                                        @endphp --}}
                                        <td colspan="50" class="text-center text-danger">
                                            @php
                                                $cart_empty=true;
                                            @endphp
                                            No product in cart
                                        </td>
                                    </tr>
                                @endforelse
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-shiping-update-wrapper">
                                <div class="cart-shiping-update">
                                    <a href="#">Continue Shopping</a>
                                </div>
                                <div class="cart-clear">
                                    <button type="submit">Update Shopping Cart</button>
                                </form>
                                    <a href="{{route('cart.remove',Auth::id())}}">Clear Shopping Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 mb-lm-30px">
                        <div class="discount-code-wrapper">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gray">Use Coupon Code</h4>
                            </div>
                            <div class="discount-code">
                                <p>Enter your coupon code if you have one.</p>
                                <form>
                                    <input type="text" name="coupon_name" value="{{($coupon_name)? $coupon_name : '' }}" />
                                    <button class="cart-btn-2" type="submit">Apply Coupon</button>
                                </form>
                                @if (session('coupon_error'))
                                <div class="alert alert-danger mt-3">
                                    {{session('coupon_error')}}
                                </div>  
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mt-md-30px">
                        <div class="grand-totall">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                            </div>
                            @php
                                if($coupon_name){
                                    Session()->put('coupon_name', $coupon_name);
                                }else{
                                    Session()->put('coupon_name','');
                                }
                                
                              Session()->put('cart_total', $cart_total);
                              Session()->put('discount_total', $discount);
                              
                            @endphp
                            <h5>Total price <span>${{$cart_total}}</span></h5>
                            <h5>Discount Total ({{($coupon_name)? $coupon_name : 'N/A' }}) <span>${{$discount}}</span></h5>
                            <h5>Paymentable Price(approx) <span id="payment_price">{{round($cart_total-$discount)}}</span><span>$</span> </h5>
                            <div class="total-shipping">
                                <h5>Total shipping</h5>
                                <ul>
                                    <li><input id="shipping_btn_1" type="radio" name="s_shipping" /> Standard <span>$20.00</span></li>
                                    <li><input id="shipping_btn_2" type="radio" name="s_shipping" /> Express <span>$30.00</span></li>
                                    <li><input id="shipping_btn_3" type="radio" name="s_shipping" /> Free Shipping <span>$0</span></li>
                                </ul>
                            </div>
                            <h4 class="grand-totall-title">Grand Total <span id="grand_total">${{round($cart_total-$discount)}}</span></h4>            
                            @if ($stock_problem)
                            <div class="alert alert-danger mt-2">
                                please remove stock out products
                            </div>
                            @else
                                @if($cart_empty)
                                    <div class="alert alert-danger mt-2">
                                    No products found for proceed to checkout
                                    </div>
                                @else
                                    <a id="checkout_btn" class="d-none" href="{{route('checkout')}}">Proceed to Checkout</a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart Area End -->

@endsection

@section('footer_script')
<script>
    $('#shipping_btn_1').click(function(){
        $('#grand_total').html(parseInt($('#payment_price').html())+20)
        $('#checkout_btn').removeClass('d-none');
        @php
            Session::put('s_shipping', 20);
        @endphp
    });
    $('#shipping_btn_2').click(function(){
        $('#grand_total').html(parseInt($('#payment_price').html())+30)
        $('#checkout_btn').removeClass('d-none');
        @php
            Session::put('s_shipping', 30);
        @endphp
    });
    $('#shipping_btn_3').click(function(){
        $('#grand_total').html(parseInt($('#payment_price').html())+0)
        $('#checkout_btn').removeClass('d-none');
        @php
            Session::put('s_shipping', 60);
        @endphp
    });
</script>
@endsection
