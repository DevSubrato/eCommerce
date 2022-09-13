@extends('layouts.app')

@section('breadcrumb')
<div class="page-title-box">
    <h4 class="page-title">Starter </h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('my.order')}}">My Orders</a></li>
        <li class="breadcrumb-item">Order Summery</li>
    </ol>
</div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Order Summery
                </div>
                    
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th>Order Id</th>
                                <td>{{$order_summery->id}}</td>
                            </tr>
                            <tr>
                                <th>User Name</th>
                                <td>{{$order_summery->user->name}}</td>
                            </tr>
                            <tr>
                                <th>Coupon Name</th>
                                <td>
                                    @if ($order_summery->coupon_name)
                                    {{$order_summery->coupon_name}}  
                                    @else
                                    No Coupon used 
                                    @endif
                                </td>
                                
                            </tr>
                            <tr>
                                <th>Cart Total</th>
                                <td>{{$order_summery->cart_total}}</td>
                            </tr>
                            <tr>
                                <th>Discount Total</th>
                                <td>{{$order_summery->discount_total}}</td>
                            </tr>
                            <tr>
                                <th>Sub Total</th>
                                <td>{{$order_summery->sub_total}}</td>
                            </tr>

                            <tr>
                                <th>Shipping</th>
                                <td>{{$order_summery->shipping}}</td>
                            </tr>
                            <tr>
                                <th>Paymentable Total</th>
                                <td>{{$order_summery->shipping}} <small>(approx)</small> </td>
                            </tr>
                            <tr>
                                <th>payment_method</th>
                                <td>
                                    @if ($order_summery->payment_method == 1)
                                        Cash On Delivery 
                                    @else
                                        Online Payment
                                    @endif
                                </td>
                            </tr>
                            
                            <tr>
                                <th>Payment Status</th>
                                <td>
                                    @if ($order_summery->payment_status == 1)
                                        Paid 
                                    @else
                                        Unpaid
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Ordered At</th>
                                <td>{{$order_summery->created_at->diffForHumans()}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    @foreach ($order_details as $order_detail)
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered table-inverse">
                                    <tbody>
                                        <tr>
                                            <td style="width:400px">Product Name</td>
                                            <td>{{$order_detail->product->product_name}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width:400px">Product Name</td>
                                            <td>
                                                <img width="100px;" src="{{ asset('uploads/product_images/'.$order_detail->product->product_image) }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Vendor Name </td>
                                            <td>{{$order_detail->vendor->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Quantity</td>
                                            <td>{{$order_detail->quantity}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>   
            </div>
        </div>
    </div>
</div>
@endsection

