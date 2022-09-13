@extends('layouts.app')

@section('breadcrumb')
<div class="page-title-box">
    <h4 class="page-title">Starter </h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item">My Orders</li>
    </ol>
</div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                        My Orders <span class="badge badge-primary">{{$all_orders->count()}}</span>
                </div>
                    
                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="thead-inverse">
                            <tr>
                                <th>Order Id</th>
                                <th>Paymentable Total</th>
                                <th>Payment Method</th>
                                <th>Payment Status</th>
                                <th>Delivery Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($all_orders as $order)   
                            <tr>
                                <td>{{$order->id}} </td>
                                <td>${{$order->paymentable_total}} </td>
                                <td>
                                    @if ($order->payment_method == 1)
                                       Cash On Delivery 
                                    @else
                                        Online Payment
                                    @endif
                                    
                                </td>
                                <td>
                                    @if ($order->payment_status == 0)
                                       <span class="badge badge-danger">Unpaid</span>
                                    @else
                                       <span class="badge badge-success">Paid</span> 
                                    @endif
                                    
                                </td>
                                <td>
                                    @if ($order->delivered == 0)
                                        <span class="badge badge-warning">pending</span>
                                    @else
                                    <span class="badge badge-success">Delivered</span>                                      
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-info" href="{{route('order.details',$order->id)}}">details</a>
                                    @if ($order->payment_status == 1 && $order->delivered == 0)
                                        <a class="btn btn-sm btn-primary" href="{{route('mark.delivered',$order->id)}}">Mark as delivered</a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                                <td colspan="50">
                                    <div class="alert alert-danger text-center">
                                      Oops! You dont have any order to display
                                    </div>      
                                </td>
                            @endforelse
                        </tbody>
                    </table>
                </div>   
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_script')
    <script>
        $(document).ready(function() {
    $('#country_dropdown').select2();
    });
    </script>
@endsection