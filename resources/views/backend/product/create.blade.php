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
                        Add Product
                </div>
                    
                <div class="card-body">
                    @if($errors->any())
                    @foreach($errors->all() as $error)
                    <div class="alert alert-danger">
                        <li>{{ $error }}</li>
                    </div>
                    @endforeach
                    @endif
                    <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label>Category Name</label>
                          <select name="category_id" class="form-control">
                            <option style="display: none;" value="" checked><--select one--></option>
                            @foreach ($categories as $category)   
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Product Name</label>
                          <input type="text" name="product_name" class="form-control" placeholder="Enter product Name">
                        </div>
                        <div class="form-group">
                          <label>Product Price</label>
                          <input type="number" name="product_price" class="form-control" placeholder="Enter product Price">
                        </div>
                        <div class="form-group">
                          <label>Product Stock</label>
                          <input type="number" name="product_stock" class="form-control" placeholder="Enter product Price">
                        </div>
                        <div class="form-group">
                          <label>Product Code</label>
                          <input type="text" name="product_code" class="form-control" placeholder="Enter product Code">
                        </div>
                        <div class="form-group">
                          <label>Product Short Description</label>
                          <textarea class="form-control" name="product_short_description" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                          <label>Product Long Description</label>
                          <textarea class="form-control" name="product_long_description" rows="4"></textarea>
                          
                        </div>
                        <div class="form-group">
                          <label>Product Image</label>
                          <input type="file" name="product_image" class="form-control">
                        </div>
                        <div class="form-group">
                          <label>Product Sample Images</label>
                          <input type="file" name="product_sample_images[]" class="form-control" multiple>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                      </form>
                </div>   
            </div>
        </div>
    </div>
</div>
@endsection
