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
                     <h4>blog Details </h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <td style="width:200px">blog Image</th>
                                <td>
                                    <img width="200px;" src="{{ asset('uploads/blog_photos/'.$blog->image) }}">
                                </td>
                        </tr>
                        <tr>
                            <td style="width:200px">blog title</td>
                            <td>{{$blog->title}}</td>
                        </tr>
                        <tr>
                            <td style="width:200px">blog Description</td>
                            <td>{!! $blog->description !!}</td>
                        </tr>

                    </table>
                </div>   
            </div>
        </div>
    </div>
</div>
@endsection
