@extends('layouts.app')

@section('breadcrumb')
<div class="page-title-box">
    <h4 class="page-title">Starter </h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item">My Orders</li>
    </ol>
</div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                        My Orders <span class="badge badge-primary">9</span>
                </div>
                    
                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="thead-inverse">
                            <tr>
                                <th>Sl no</th>
                                <th>Blog Name</th>
                                <th>Comment</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($comments as $key=>$comment)
                            <tr>
                                <td>{{$loop->index + 1}}</td>
                                <td>{{$comment->blog->title}}</td>
                                <td>{{$comment->comment}}</td>
                                <td>{{$comment->created_at->diffForHumans()}}</td>
                                <td>
                                    <form action="{{route('comment.destroy',$comment->id)}}" id="delete-form-{{$comment->id}}" method="POST">
                                        @csrf
                                    </form>
                                    <button class="btn" onclick="if(confirm('are you sure ? Do you want to delete this comment')){
                                        event.preventDefault();
                                        document.getElementById('delete-form-{{$comment->id}}').submit();}">
                                        <i class="fa fa-trash-o"></i></button>
                                </td>
                            </tr>
                            @empty
                                
                            @endforelse                              
                        </tbody>
                    </table>
                </div>   
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_script')
    <script>
        $(document).ready(function() {
    $('#country_dropdown').select2();
    });
    </script>
@endsection