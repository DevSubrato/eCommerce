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
                        Update Coupon
                </div>
                    
                <div class="card-body">
                    <form action="{{route('coupon.update',$coupon->id)}}" method="POST">
                        @if($errors->any())
                        @foreach($errors->all() as $error)
                        <div class="alert alert-danger">
                            <li>{{ $error }}</li>
                        </div>
                        @endforeach
                        @endif
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                          <label>Coupon Name</label>
                          <input type="text" name="coupon_name" class="form-control" value="{{$coupon->coupon_name}}">
                        </div>
                        <div class="form-group">
                          <label>Coupon Discount Percentage</label>
                          <input type="text" name="discount_percentage" class="form-control" value="{{$coupon->discount_percentage}}">
                        </div>
                        <div class="form-group">
                          <label>Coupon Validity</label>
                          <input type="date" name="validity" class="form-control" value="{{$coupon->validity}}">
                        </div>
                        <div class="form-group">
                          <label>Coupon Limit</label>
                          <input type="text" name="limit" class="form-control" value="{{$coupon->limit}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Update coupon</button>
                      </form>
                </div>   
            </div>
        </div>
    </div>
</div>
@endsection
