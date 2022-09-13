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
                     <h4>product List <span class="badge badge-primary">{{$products->count()}}</span></h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>SL No</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>product Price</th>
                            <th>Product Code</th>
                            <th>Action</th>
                        </tr>
                        @forelse ($products as $product)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>
                                <img width="50px;" src="{{ asset('uploads/product_images/'.$product->product_image) }}">
                            </td>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->product_price}}</td>
                            <td>{{$product->product_code}}</td>
            
                            <td class="d-flex">
                                <a href="{{ route('product.edit',$product->id) }}" class="btn btn-info mr-1"><i class="fa fa-pencil"></i></a>
                                <a href="{{ route('product.show',$product->id) }}"class="btn btn-primary mr-1"><i class="fa fa-eye"></i></a>
                                <button class="btn btn-danger" type="submit" onclick="if(confirm('Are you sure? to delete this product'))
                                {
                                    event.preventDefault();
                                    document.getElementById('delete-form-{{$product->id}}').submit();
                                }">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <form action="{{ route('product.destroy',$product->id) }}" method="post" id="delete-form-{{$product->id}}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                            
                        @empty
                            <tr>
                                <td colspan="50">No Records Found</td>
                            </tr>
                            
                        @endforelse
                        
                    </table>
                </div>   
            </div>
        </div>
    </div>
</div>
@endsection
