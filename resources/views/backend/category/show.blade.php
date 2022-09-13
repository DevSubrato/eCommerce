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
                     <h4>Category Details </h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <td style="width:200px">Category Name</td>
                            <td>{{$category->category_name}}</td>
                        </tr>
                        <tr>
                            <td style="width:200px">Category Tagline</td>
                            <td>{{$category->category_tagline}}</td>
                        </tr>
                        <tr>
                            <td style="width:200px">Category Image</th>
                                <td>
                                    <img width="200px;" src="{{ asset('uploads/category_images/'.$category->category_image) }}">
                                </td>
                        </tr>

                    </table>
                </div>   
            </div>
        </div>
    </div>
</div>
@endsection
