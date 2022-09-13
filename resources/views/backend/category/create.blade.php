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
                        Add Category
                </div>
                    
                <div class="card-body">
                    <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="category_name" class="form-control" placeholder="Enter Category Name">
                        </div>
                        <div class="form-group">
                          <label>Category Tagline</label>
                          <input type="text" name="category_tagline" class="form-control" placeholder="Enter Category Tagline">
                        </div>
                        <div class="form-group">
                          <label>Category Image</label>
                          <input type="file" name="category_image" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                      </form>
                </div>   
            </div>
        </div>
    </div>
</div>
@endsection
