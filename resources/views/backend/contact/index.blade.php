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
                     <h4>contact List <span class="badge badge-primary">{{$contacts->count()}}</span></h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>SL No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{$contact->name}}</td>
                            <td>{{$contact->email}}</td>
                            <td>{{$contact->message}}</td>
                            <td>
                                <button type="submit" class="btn " onclick="if(confirm('Are you sure? Do you want to delete this message')){
                                    event.preventDefault();
                                    document.getElementById('delete-form-{{$contact->id}}').submit();
                                }"><i class="fa fa-trash-o"></i></button>
                                <form action="{{route('contacts.destroy',$contact->id)}}" method="POST" id="delete-form-{{$contact->id}}"> 
                                    @csrf
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
