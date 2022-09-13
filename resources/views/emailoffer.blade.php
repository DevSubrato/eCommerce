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
                @if(Auth::user()->role == 2)
                    <div class="card-header">
                        Dashboard
                    </div>
                    
                    <div class="card-body">
                        <table class="table table-bordered table-sm">
                            <tr>
                                <th class="text-center">Check</th>
                                <th>Sl NO</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                            <form action="{{route('checkemailoffer')}}" method="POST">
                                @csrf
                                @foreach ($customers as $customer)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="check[]" class="form-control" value="{{$customer->id}}">
                                    </td>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$customer->email}}</td>
                                    <td>
                                        <a href="{{route('singlemailoffer',$customer->id)}}" class="btn btn-success">send</a>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td class="text-center">
                                        <button class="btn btn-primary btn-sm ">check send</button>
                                    </td>
                                </tr>
                            </form>
                        </table>
                    </div>
                @endif      
            </div>
        </div>
    </div>
</div>
@endsection
