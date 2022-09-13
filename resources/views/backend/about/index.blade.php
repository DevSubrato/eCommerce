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
                     <h4>about List <span class="badge badge-primary">{{$abouts->count()}}</span></h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>SL No</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Facebook</th>
                            <th>Google</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($abouts as $about)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>
                                <img width="50px;" src="{{ asset('uploads/about_photos/'.$about->image) }}">
                            </td>
                            <td>{{$about->name}}</td>
                            <td>{{$about->designation}}</td>              
                            <td>{{$about->facebook}}</td>              
                            <td>{{$about->google}}</td>              
                            {{-- <td>{!! $about->description !!}</td>               --}}
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      action
                                    </button>
                                    <div class="dropdown-menu">
                                      <a class="dropdown-item" href="{{route ('about.show',$about->id) }}"><i class="fa fa-eye"></i> <span class="text-bold text-dark">VIEW</span></a>
                                      <a class="dropdown-item" href="{{route ('about.edit',$about->id) }}"><i class="fa fa-pencil"></i> <span class="text-bold text-dark">EDIT</span></a>
                                      <form action="{{ route ('about.destroy',$about->id)}}" method="POST" id="delete-about-{{$about->id}}">
                                        @csrf
                                        @method('DELETE')
                                      </form>
                                      <button class="dropdown-item" onclick="if(confirm('Are you sure? You want to delete this about')){
                                        event.preventDefault();
                                        document.getElementById('delete-about-{{$about->id}}').submit();
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
