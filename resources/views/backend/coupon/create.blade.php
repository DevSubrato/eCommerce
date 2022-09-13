@extends('layouts.app')

@section('breadcrumb')
<div class="page-title-box">
    <h4 class="page-title">Starter </h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    </ol>
</div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                        Create Coupon
                </div>
                    
                <div class="card-body">
                    <form action="{{route('coupon.store')}}" method="POST">
                      
                        @if($errors->any())
                        @foreach($errors->all() as $error)
                        <div class="alert alert-danger">
                            <li>{{ $error }}</li>
                        </div>
                        @endforeach
                        @endif
                        @csrf
                        <div class="form-group">
                          <label>Coupon Name</label>
                          <input type="text" name="coupon_name" class="form-control" placeholder="Enter coupon Name">
                        </div>
                        <div class="form-group">
                          <label>Coupon Discount Percentage</label>
                          <input type="text" name="discount_percentage" class="form-control" placeholder="Discount Percentage">
                        </div>
                        <div class="form-group">
                          <label>Coupon Validity</label>
                          <input type="date" name="validity" class="form-control" placeholder="Coupon Validity">
                        </div>
                        <div class="form-group">
                          <label>Coupon Limit</label>
                          <input type="text" name="limit" class="form-control" placeholder="Coupon Limit">
                        </div>
                        <button type="submit" class="btn btn-primary">Add New coupon</button>
                      </form>
                </div>   
            </div>
        </div>
    </div>
</div>
@endsection
