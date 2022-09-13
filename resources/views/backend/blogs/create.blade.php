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
                        Add Blog
                </div>
                    
                <div class="card-body">
                    <form action="{{route('blog.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label>Blog Title</label>
                          <input type="text" name="title" class="form-control" placeholder="Enter Blog Name">
                        </div>
                        <div class="form-group">
                          <label>Blog Image</label>
                          <input type="file" name="image" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="">Blog Description</label>
                          <textarea name="description" id="description" rows="6" class="form-control" placeholder="Enter Blog Description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                      </form>
                </div>   
            </div>
        </div>
    </div>
</div>
@endsection

@push('summernote_css')

<link rel="stylesheet" href="{{asset('backend/css/summernote-bs4.min.css')}}">

@endpush

@push('summernote_js')
<script src="{{asset('backend/js/summernote-bs4.min.js')}}"></script>
<script>
    $('#description').summernote({
        placeholder: 'Hello Bootstrap 4',
        tabsize: 2,
        height: 200
    });
</script>
@endpush


