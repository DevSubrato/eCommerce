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
                     <h4>Category List <span class="badge badge-primary">4</span></h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>SL No</th>
                            <th>Name</th>
                            <th>Vendor Email</th>
                            <th>Vendor Phone Number</th>
                            <th>Vendor Address</th>
                            <th>Action</th>
                        </tr>
                        @forelse ($vendors as $vendor)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$vendor->name}}</td>
                                <td>{{$vendor->email}}</td>
                                <td>{{$vendor->phone_number}}</td>
                                <td>{{$vendor->created_at->diffForHumans()}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          action
                                        </button>
                                        <div class="dropdown-menu">
                                          <form action="{{ route ('vendor.destroy',$vendor->id)}}" method="POST" id="delete-vendor-{{$vendor->id}}">
                                            @csrf
                                            @method('DELETE')
                                          </form>
                                          <button class="dropdown-item" onclick="if(confirm('Are you sure? You want to delete this vendor')){
                                            event.preventDefault();
                                            document.getElementById('delete-vendor-{{$vendor->id}}').submit();
                                          }"><i class="fa fa-trash-o"></i> <span class="text-bold  text-dark">DELETE</span></button>
                                        </div>
                                      </div>
                                </td>
                            </tr>
                        @empty
                            
                        @endforelse
                    </table>
                </div>   
            </div>
        </div>
    </div>
</div>
@endsection
