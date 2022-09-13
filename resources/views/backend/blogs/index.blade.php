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
                     <h4>blog List <span class="badge badge-primary">{{$blogs->count()}}</span></h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>SL No</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($blogs as $blog)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>
                                <img width="100px;" src="{{ asset('uploads/blog_photos/'.$blog->image) }}">
                            </td>
                            <td>{{$blog->title}}</td>
                            <td>{!! Str::limit(strip_tags($blog->description), 100) !!}</td>              
                            {{-- <td>{!! $blog->description !!}</td>               --}}
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      action
                                    </button>
                                    <div class="dropdown-menu">
                                      <a class="dropdown-item" href="{{route ('blog.show',$blog->id) }}"><i class="fa fa-eye"></i> <span class="text-bold text-dark">VIEW</span></a>
                                      <a class="dropdown-item" href="{{route ('blog.edit',$blog->id) }}"><i class="fa fa-pencil"></i> <span class="text-bold text-dark">EDIT</span></a>
                                      <form action="{{ route ('blog.destroy',$blog->id)}}" method="POST" id="delete-blog-{{$blog->id}}">
                                        @csrf
                                        @method('DELETE')
                                      </form>
                                      <button class="dropdown-item" onclick="if(confirm('Are you sure? You want to delete this blog')){
                                        event.preventDefault();
                                        document.getElementById('delete-blog-{{$blog->id}}').submit();
                                      }"><i class="fa fa-trash-o"></i> <span class="text-bold  text-dark">DELETE</span></button>
                                    </div>
                                  </div>
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
