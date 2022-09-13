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
                     <h4>Category List <span class="badge badge-primary">{{$categories->count()}}</span></h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>SL No</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category Tagline</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>
                                <img width="100px;" src="{{ asset('uploads/category_images/'.$category->category_image) }}">
                            </td>
                            <td>{{$category->category_name}}</td>
                            <td>{{$category->category_tagline}}</td>
                            <td>{{$category->status}}</td>
                            <td class="d-flex">
                                <a href="{{ route('category.edit',$category->id) }}" class="btn btn-info mr-1"><i class="fa fa-pencil"></i></a>
                                <a href="{{ route('category.show',$category->id) }}"class="btn btn-primary mr-1"><i class="fa fa-eye"></i></a>
                                <button class="btn btn-danger" type="submit" onclick="if(confirm('Are you sure? to delete this category'))
                                {
                                    event.preventDefault();
                                    document.getElementById('delete-form-{{$category->id}}').submit();
                                }">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <form action="{{ route('category.destroy',$category->id) }}" method="post" id="delete-form-{{$category->id}}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>   
            </div>
        </div>
    </div>
</div>
@endsection
