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
                        <li class="breadcrumb-item active">Shop</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>

    <!-- breadcrumb-area end -->

    <div class="shop-category-area pt-100px pb-100px">
        <div class="container">
            <form action="">
            <div class="row">
                    <div class="col-lg-4 mb-3">
                        <input type="text" name="min_value" value="{{$min_value}}" class="form-control" placeholder="min">
                    </div>
                    <div class="col-lg-4 mb-3">
                        <input type="text" name="max_value" value="{{$max_value}}" class="form-control" placeholder="max">
                    </div>
                    <div class="col-lg-4 mb-3">
                        <input type="submit" class="btn btn-success" value="filter price">
                    </form>
                </div>
                
            </div>
            <div class="row">
                @forelse($products as $product)
                    @include('parts.product_thumbnail')
                @empty
                    <div class="alert alert-danger text-center">
                        No Products found in this price range
                    </div>
                @endforelse
            </div>
        </div>
    </div>

@endsection