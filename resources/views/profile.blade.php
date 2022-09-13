@extends('layouts.app')

@section('breadcrumb')
<div class="page-title-box">
    <h4 class="page-title">Profile </h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Profile</a></li>
    </ol>
</div>
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-primary">
                Created at : {{ Auth::user()->created_at->diffForHumans()}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Change Your name
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                    @endif
                    <form action="{{route('profile.namechange')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="mb-3">Name</label>
                            <input type="text" class="form-control" name="name" value="{{Auth::user()->name}}">
                            @error('name')
                            <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <button class="btn btn-success btn-sm">change name</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    Change Your photo
                </div>

                <div class="card-body">
                    @if(session('success_photo'))
                    <div class="alert alert-success">
                        {{session('success_photo')}}
                    </div>
                    @endif
                    <div class="row justify-content-center">
                            <img style="width:100px;" src="{{asset('uploads/profile_photos/'.Auth::user()->profile_photo)}}">
                    </div>
                    <form action="{{route('profile.photochange')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="mb-3">New Photo</label>
                            <input type="file" class="form-control" name="profile_photo">
                            @error('profile_photo')
                            <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <button class="btn btn-success btn-sm">change photo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Change Your Password
                </div>
                <div class="card-body">
                    @if($errors->any())
                    @foreach($errors->all() as $error)
                    <div class="alert alert-danger">
                        <li>{{ $error }}</li>
                    </div>
                    @endforeach
                    @endif
                    @if(session('success_p'))
                    <div class="alert alert-success">
                        {{session('success_p')}}
                    </div>
                    @endif
                    <form action="{{route('profile.password_change')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Old Password:</label>
                            <input type="password" class="form-control mb-3" name="old_password">
                            @error('old_password')
                            <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label>New Password:</label>
                            <input type="password" class="form-control mb-3" name="new_password">
                        </div>
                        <div class="form-group mt-3">
                            <label>Confirm Password:</label>
                            <input type="password" class="form-control " name="confirm_password">
                        </div>
                        <div class="form-group mt-3">
                            <button class="btn btn-success btn-sm">change password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection