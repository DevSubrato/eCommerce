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
                            <th>Discount Percentage</th>
                            <th>Limit</th>
                            <th>Valitdity</th>
                            <th>Action</th>
                        </tr>
                        @forelse ($coupons as $coupon)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$coupon->coupon_name}}</td>
                                <td>{{$coupon->discount_percentage}}</td>
                                <td>{{$coupon->limit}}</td>
                                <td>{{$coupon->validity}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          action
                                        </button>
                                        <div class="dropdown-menu">
                                          <a class="dropdown-item" href="{{route ('coupon.edit',$coupon->id) }}"><i class="fa fa-pencil"></i> <span class="text-bold text-dark">EDIT</span></a>
                                          <form action="{{ route ('coupon.destroy',$coupon->id)}}" method="POST" id="delete-coupon-{{$coupon->id}}">
                                            @csrf
                                            @method('DELETE')
                                          </form>
                                          <button class="dropdown-item" onclick="if(confirm('Are you sure? You want to delete this coupon')){
                                            event.preventDefault();
                                            document.getElementById('delete-coupon-{{$coupon->id}}').submit();
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
