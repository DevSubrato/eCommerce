@extends('layouts.app_auth')

@section('content')

<div class="card">
    <div class="card-block">

        <div class="account-box">

            <div class="card-box p-5">
                <h2 class="text-uppercase text-center pb-4">
                    <a href="index.html" class="text-success">
                        <span><img src="{{asset('backend/images/logo.png')}}" alt="" height="26"></span>
                    </a>
                </h2>

                <div class="col-12">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </div>
                    @endif
                <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group row m-b-20">
                            <label>Full Name<span class="text-danger">*</span></label>
                            <input name="name" class="form-control" type="name"  placeholder="Michael Zenaty">
                        </div>
                    </div>

                    <div class="form-group row m-b-20">
                        <div class="col-12">
                            <label>Email address<span class="text-danger">*</span> </label>
                            <input name="email" class="form-control" type="email"  placeholder="john@deo.com">
                        </div>
                    </div>
                    <div class="form-group row m-b-20">
                        <div class="col-12">
                            <label>Phone Number</label>
                            <input name="phone_number" class="form-control" type="text"  placeholder="017########">
                        </div>
                    </div>

                    <div class="form-group row m-b-20">
                        <div class="col-12">
                            <label>Password<span class="text-danger">*</span> </label>
                            <input name="password" class="form-control" type="password"  placeholder="Enter your password">
                        </div>
                    </div>
                    <div class="form-group row m-b-20">
                        <div class="col-12">
                            <label>Confirm Password<span class="text-danger">*</span> </label>
                            <input name="password_confirmation" class="form-control" type="password"  placeholder="Enter your password">
                        </div>
                    </div>
                    <div class="form-group row text-center m-t-10">
                        <div class="col-12">
                            <button class="btn btn-block btn-custom waves-effect waves-light" type="submit">Register</button>
                        </div>
                    </div>

                </form>

                <div class="row m-t-50">
                    <div class="col-sm-12 text-center">
                        <p class="text-muted">Already have an account?  <a href="{{route('login')}}" class="text-dark m-l-5"><b>Sign In</b></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection