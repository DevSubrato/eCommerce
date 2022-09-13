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
                        Edit Category
                </div>
                    
                <div class="card-body">
                    <form action="{{ route('category.update',$category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="category_name" value="{{ $category->category_name }}" class="form-control">
                        </div>
                        <div class="form-group">
                          <label>Status</label>
                          <select name="status" class="form-control">
                            <option value="show"{{ ($category->status == 'show')? 'selected' : '' }}>Show</option>
                            <option value="hide"{{ ($category->status == 'hide')? 'selected' : '' }}>Hide</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Category Tagline</label>
                          <input type="text" name="category_tagline" value="{{ $category->category_tagline }}" class="form-control" >
                        </div>
                        <div class="form-group">
                            <img width="200px;" src="{{ asset('uploads/category_images/'.$category->category_image) }}">
                        </div>
                        <div class="form-group">
                          <label>Category Image</label>
                          <input type="file" name="category_image" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Edit</button>
                      </form>
                </div>   
            </div>
        </div>
    </div>
</div>
@endsection
